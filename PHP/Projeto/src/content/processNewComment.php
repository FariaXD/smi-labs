<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
require_once("../lib/db.php");
require_once("../lib/db_upload_media.php");
require_once("../lib/lib.php");
session_start();
$comment = $_POST['comment'];
$idContent = $_POST['idContent'];
$idUser= $_SESSION['id'];
dbConnect(ConfigFile);
$dataBaseName = $GLOBALS['configDataBase']->db;
mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
$query = "INSERT INTO `media-comment` (`idUser`, `idContent`, `comment`) values ('$idUser', '$idContent', '$comment')";
$result = mysqli_query($GLOBALS['ligacao'], $query);