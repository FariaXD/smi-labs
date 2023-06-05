﻿<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
function UploadMediaInfo($idUser, $name, $episodeNumb, $type, $private, $fileName){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $curdate = date("Y-m-d H:i:s");
    $add_query = "INSERT INTO `media-content`" .
    "(`idUser`, `displayName`, `episodeNumber`, `type`, `private`, `publishDate`, `name`) values " .
    "('$idUser', '$name', '$episodeNumb', '$type', '$private', '$curdate', '$fileName')";
    $result = mysqli_query($GLOBALS['ligacao'], $add_query);
    return $result;
}

function UploadContentToLocation($content, $selectedCategories){
    $idContent =  mysqli_insert_id($GLOBALS['ligacao']);
    echo "Media was added to the database.";
    $location = '/examples-php/Projeto/media/';
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

    $query = "SELECT * FROM `media-content` ORDER BY `views` DESC LIMIT 1";
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