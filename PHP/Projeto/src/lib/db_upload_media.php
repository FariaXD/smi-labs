<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
function UploadMediaInfo($idUser, $name, $private, $fileName, $idSeries){
    $episodeNumb = 1;
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $curdate = date("Y-m-d H:i:s");
    if ($idSeries == "") {
        $idSeries = intval(GetNextIdSeries())+1;
    }
    else{
        $episodeNumb = intval(GetEpisodeNumb($idSeries))+1;
    }
    $add_query = "INSERT INTO `media-content`" .
    "(`idUser`, `idSeries`, `displayName`, `episodeNumber`, `private`, `publishDate`, `name`) values " .
    "('$idUser', '$idSeries', '$name', '$episodeNumb', '$private', '$curdate', '$fileName')";
    $result = mysqli_query($GLOBALS['ligacao'], $add_query);
    return $result;
}

function UploadContentToLocation($content, $selectedCategories){
    $location = '/examples-php/Projeto/media/';
    $idContent =  mysqli_insert_id($GLOBALS['ligacao']);
    echo "Media was added to the database.";
    $destination = $location . $content['name'];
    move_uploaded_file($content['tmp_name'], $destination);
    $thumbNailLocation = $location . $idContent . ".jpg";
    // Execute FFmpeg command to generate thumbnail
    $ffmpegCommand = 'ffmpeg -i "' . $destination . '" -ss 00:00:05 -vframes 1 -f image2 "' . $thumbNailLocation . '"';
    $output = array();
    exec($ffmpegCommand, $output, $returnCode);

    if ($returnCode === 0) {
        echo "Thumbnail generated successfully.";
    } else {
        echo "Thumbnail generation failed. Error: " . implode("\n", $output);

    }
    foreach ($selectedCategories as $cat) {
        $cat_query = "INSERT INTO `media-content-categories`" .
        "(`idCategory`, `idContent`) values " .
        "('$cat', '$idContent')";
        if (mysqli_query($GLOBALS['ligacao'], $cat_query) == true) {
            echo "Associated new category to added content.";
        } else {
            echo "Failed to associate new category to content.";
        }
    }
}

function GetContentWithMostViews()
{
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT * FROM `media-content` WHERE `private` = 0 ORDER BY `views` DESC LIMIT 1";
    $result = mysqli_query($GLOBALS['ligacao'], $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        return null;
    }
}

function GetVideoInfo($idContent){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT * FROM `media-content` WHERE `idContent`='$idContent'";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    return mysqli_fetch_array($result);
}

function GetAllCommentsToMedia($idContent){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $comments = [];

    $query = "SELECT `media-comment`.`idUser`, `media-comment`.`idComment`, `media-comment`.`idContent`, `media-comment`.`comment`, `auth-user`.`username`
          FROM `media-comment`
          INNER JOIN `auth-user` ON `media-comment`.`idUser` = `auth-user`.`IdUser`
          WHERE `media-comment`.`idContent` = $idContent";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    while (($record = mysqli_fetch_array($result))) {
        array_push($comments, [$record["idComment"], $record["idUser"], $record['comment'], $record['username']]);
    }
    return $comments;
}

function AddViewToContent($content){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $newViews = intval($content['views'])+1;
    $id = $content['idContent'];

    $query = "UPDATE `media-content` SET `views` = '$newViews' WHERE `idContent` = $id";
    $update_result = mysqli_query($GLOBALS['ligacao'], $query);
    if ($update_result) {
        return $newViews;
    } else {
        return $newViews - 1;
    }
}

/**
 * 0 - idContent
 * 1 - idSeries
 * 2 - displayName
 * 3 - name
 * 4 - episodeNumber
 * 5 - private
 * 6 - views
 */
function GetAllContent($idUser){
    $allContent = [];
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT * FROM `media-content` WHERE `idUser`='$idUser'";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    while (($record = mysqli_fetch_array($result))) {
        array_push($allContent, [$record["idContent"],$record["idSeries"], $record["displayName"],$record["name"], $record["episodeNumber"], $record["private"], $record["views"],]);
    }
    return $allContent;
}

function OrderContent($allContent)
{
    // Create an associative array to hold the ordered content
    $orderedContent = array();

    // Iterate through all the content
    foreach ($allContent as $content) {
        $seriesID = $content[1]; // Assuming series ID is at index 1

        // Check if the series already exists in the orderedContent array
        if (isset($orderedContent[$seriesID])) {
            // If the series exists, add the episode to the series
            $orderedContent[$seriesID][] = $content;
        } else {
            // If the series doesn't exist, create a new series and add the episode
            $orderedContent[$seriesID] = array($content);
        }
    }

    // Return the ordered content
    return $orderedContent;
}

function GetNextIdSeries(){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "SELECT * FROM `media-content` ORDER BY `idSeries` DESC LIMIT 1";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    $table = mysqli_fetch_array($result);
    return $table['idSeries'];
}


function GetEpisodeNumb($idSeries){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "SELECT `episodeNumber` FROM `media-content` WHERE `idSeries`='$idSeries'";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    $table = mysqli_num_rows($result);
    return $table;
}
function GetAllSeriesNames($idUser)
{
    $series = [];
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $select_query = "SELECT DISTINCT `idSeries`, `displayName` FROM `media-content` WHERE `episodeNumber` = 1 AND `idUser`=$idUser";
    $update_user_result = mysqli_query($GLOBALS['ligacao'], $select_query);
    while (($record = mysqli_fetch_array($update_user_result))) {
        array_push($series, [$record["idSeries"], $record["displayName"]]);
    }
    return $series;
}

function updateEpisodeNumber($idContent, $idSeries, $newEpisodeNumber, $oldEpisodeNumber)
{
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    // Retrieve the series and episodes with the same $idSeries
    $query = "SELECT `idContent`, `episodeNumber` FROM `media-content` WHERE `idSeries` = $idSeries ORDER BY `episodeNumber`";
    $result = mysqli_query($GLOBALS['ligacao'], $query);

    $updates = []; // Array to store the updates

    // Iterate over the episodes and determine the necessary updates
    while ($row = mysqli_fetch_assoc($result)) {
        $currentIdContent = $row['idContent'];
        $currentEpisodeNumber = $row['episodeNumber'];

        if ($currentIdContent == $idContent) {
            // Update the episode number of the specified episode
            $updates[] = "UPDATE `media-content` SET `episodeNumber` = $newEpisodeNumber WHERE `idContent` = $currentIdContent";
        } elseif ($currentEpisodeNumber >= $newEpisodeNumber && $currentEpisodeNumber < $oldEpisodeNumber) {
            // Shift the episode numbers forward for episodes that come after the updated episode
            $newEpisode = $currentEpisodeNumber + 1;
            $updates[] = "UPDATE `media-content` SET `episodeNumber` = $newEpisode WHERE `idContent` = $currentIdContent";
        } elseif ($currentEpisodeNumber > $oldEpisodeNumber && $currentEpisodeNumber <= $newEpisodeNumber) {
            // Shift the episode numbers backward for episodes that come between the updated episode and the original episode number
            $newEpisode = $currentEpisodeNumber - 1;
            $updates[] = "UPDATE `media-content` SET `episodeNumber` = $newEpisode WHERE `idContent` = $currentIdContent";
        }
    }

    // Execute all the update queries
    foreach ($updates as $updateQuery) {
        mysqli_query($GLOBALS['ligacao'], $updateQuery);
    }

    // Return the updates array for debugging
    return $updates;
}

function updateEpisodeNumberChangedSeries($idContent, $idSeries){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    // Retrieve the series and episodes with the same $idSeries
    $query = "SELECT `idContent`, `episodeNumber` FROM `media-content` WHERE `idSeries` = $idSeries ORDER BY `episodeNumber`";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    $numRows = mysqli_num_rows($result);
    $update = "UPDATE `media-content` SET `episodeNumber` = $numRows WHERE `idContent` = $idContent";
    $result_update = mysqli_query($GLOBALS['ligacao'], $update);
    return $result_update;
}


function updateContent($idContent, $displayName, $series, $private){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "UPDATE `media-content` SET `displayName` = '$displayName', `idSeries` = $series, `private` = $private WHERE `idContent` = $idContent";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    return $result;
}

function getNameWithIdContent($idContent){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "SELECT `name` FROM `media-content` WHERE `idContent`=$idContent";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    $record = mysqli_fetch_array($result);
    return $record['name'];
}

function deleteContent($idContent){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $nameFile = getNameWithIdContent($idContent);
    $query = "DELETE FROM `media-content` WHERE `idContent` = $idContent";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    $location = '/examples-php/Projeto/media/';
    if($result){
        unlink($location . $idContent . ".jpg");
        unlink($location . $nameFile);
    }
    return $result;
}

function reorderEpisodeNumbers($idSeries)
{
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    // Retrieve the rows of the series ordered by episodeNumber
    $query = "SELECT `idContent`, `episodeNumber` FROM `media-content` WHERE `idSeries` = $idSeries ORDER BY `episodeNumber`";
    $result = mysqli_query($GLOBALS['ligacao'], $query);

    $updates = []; // Array to store the updates

    // Iterate over the rows and update the episode numbers accordingly
    $newEpisodeNumber = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $currentIdContent = $row['idContent'];
        $currentEpisodeNumber = $row['episodeNumber'];

        // Update the episode number if it is different from the new episode number
        if ($currentEpisodeNumber != $newEpisodeNumber) {
            $updates[] = "UPDATE `media-content` SET `episodeNumber` = $newEpisodeNumber WHERE `idContent` = $currentIdContent";
        }

        $newEpisodeNumber++; // Increment the new episode number
    }

    // Execute all the update queries
    foreach ($updates as $updateQuery) {
        mysqli_query($GLOBALS['ligacao'], $updateQuery);
    }

    // Return the updates array for debugging or further use if needed
    return $updates;
}
function GetAllCats()
{
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $select_cats_query = "SELECT * FROM `media-category`";
    $select_cats_query_result = mysqli_query($GLOBALS['ligacao'], $select_cats_query);
    $cats = [];
    while (($record = mysqli_fetch_array($select_cats_query_result))) {
        array_push($cats, [$record["idCategory"], $record['categoryName']]);
    }
    return $cats;
}

function GetContentWithCat($count, $idCategory, $self, $idContent){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $content = [];
    $query = "SELECT `media-content`.*, `media-content-categories`.*
          FROM `media-content`
          LEFT JOIN `media-content-categories` ON `media-content-categories`.`idContent` = `media-content`.`idContent`
          WHERE `media-content-categories`.`idCategory` = '$idCategory' AND `private` = 0
          LIMIT $count"; 
    if($count == 0){
        $query = "SELECT `media-content`.*, `media-content-categories`.*
          FROM `media-content`
          LEFT JOIN `media-content-categories` ON `media-content-categories`.`idContent` = `media-content`.`idContent`
          WHERE `media-content-categories`.`idCategory` = '$idCategory' AND `private` = 0"; 
    }
    if($self){
        $query = "SELECT `media-content`.*, `media-content-categories`.*
        FROM `media-content`
        LEFT JOIN `media-content-categories` ON `media-content-categories`.`idContent` = `media-content`.`idContent`
        WHERE `media-content-categories`.`idCategory` = '$idCategory' AND `private` = 0
        AND `media-content`.`idContent` <> $idContent LIMIT $count"; 
    }
    $query_contents = mysqli_query($GLOBALS['ligacao'], $query);
    while (($record = mysqli_fetch_array($query_contents))) {
        array_push($content, [$record['idContent'], $record['displayName']]);
    }
    return $content;
}

function GetRandomContent($count){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "SELECT * FROM `media-content` WHERE `private` = 0 ORDER BY RAND() LIMIT $count";
    $content = [];
    $query_contents = mysqli_query($GLOBALS['ligacao'], $query);
    while (($record = mysqli_fetch_array($query_contents))) {
        array_push($content, [$record['idContent'], $record['displayName']]);
    }
    return $content;
}

function GetCatViaVideo($idContent){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT `idCategory` FROM `media-content-categories` WHERE `idContent`=$idContent";

    $query_contents = mysqli_query($GLOBALS['ligacao'], $query);
    $cats = [];
    while (($record = mysqli_fetch_array($query_contents))) {
        array_push($cats, $record['idCategory']);
    }

    return $cats;
}