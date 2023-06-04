<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
require_once("../lib/db.php");
require_once("../lib/db_upload_media.php");
require_once("../lib/lib.php");
session_start();
$type = $_POST['type'];
$name = $_POST['name'];
$episodeNumb = $_POST['episodeNumb'];
$selectedCategories = $_POST['selectedCategories'];
$private = isset($_POST['private']) ? "1" : "0";
$content = $_FILES['content'];


echo "Type: " . $type . "<br>";
echo "Name: " . $name . "<br>";
echo "Episode Number: " . $episodeNumb . "<br>";

echo "Selected Categories: ";
foreach ($selectedCategories as $category) {
    echo $category . ", ";
}
echo "<br>";

echo "Private: " . $private . "<br>";

$fileName = $content['name'];
$fileType = $content['type'];
$fileSize = $content['size'];
$fileTmpPath = $content['tmp_name'];
$location = '/examples-php/Projeto/media/';
$destination = $location . $content['name'];
// Echo the file details
echo "File Name: " . $fileName . "<br>";
echo "File Type: " . $fileType . "<br>";
$hasRole = ($_SESSION['roleName'] == "Admin" || $_SESSION['roleName'] == "Publisher") ? true : false;
$idUser = $_SESSION['id'];
if(!file_exists($destination) && $hasRole && $name != "" && $content != null && count($selectedCategories) > 0){
    $result = UploadMediaInfo($idUser, $name, $episodeNumb, $type, $private, $fileName);
    if ($result == false) {
        echo "Couldnt add media to database. Details : " . dbGetLastError();
    } else {
        UploadContentToLocation($content, $selectedCategories);
    }
    dbDisconnect();
}
