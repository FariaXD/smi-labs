<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
require_once("../lib/db.php");
require_once("../lib/db_upload_media.php");
require_once("../lib/lib.php");

session_start();

$type = $_POST['type'];
$name = $_POST['name'];
$selectedCategories = $_POST['selectedCategories'];
$private = ($_POST['private'] == "true") ? "1" : "0";
$content = $_FILES['content'];
$idSeries = $_POST['idSeries'];


echo "Type: " . $type . "<br>";
echo "Name: " . $name . "<br>";

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
    $result = UploadMediaInfo($idUser, $name, $type, $private, $fileName, $idSeries);
    if ($result == false) {
        echo "Couldnt add media to database. Details : " . dbGetLastError();
    } else {
        UploadContentToLocation($content, $selectedCategories);
    }
    dbDisconnect();
}
