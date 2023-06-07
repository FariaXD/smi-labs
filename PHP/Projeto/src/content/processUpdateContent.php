<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
require_once("../lib/db.php");
require_once("../lib/db_upload_media.php");
require_once("../lib/lib.php");

$idContent = $_POST['idContent'];
$displayName = $_POST['displayName'];
$newSeries = $_POST['newSeries'];
$oldSeries = $_POST['oldSeries'];
$private = ($_POST['private'] == "true") ? "1" : "0";
$newEpisodeNumber = $_POST['newEpisodeNumber'];
$oldEpisodeNumber = $_POST['oldEpisodeNumber'];
$submitAction = $_POST['submitAction'];

if($submitAction == "Update"){
    $result = updateContent($idContent, $displayName, $newSeries, $private);
    if($result){
        if($newSeries == $oldSeries){
            $updates = updateEpisodeNumber($idContent, $newSeries, $newEpisodeNumber, $oldEpisodeNumber);
            var_dump($updates);
        }
        else{
            updateEpisodeNumberChangedSeries($idContent, $newSeries);
        }
    }
}
else{
    deleteContent($idContent);
    reorderEpisodeNumbers($newSeries);
}
