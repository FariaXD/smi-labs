<?php
require_once("../lib/lib.php");
require_once("../lib/db.php");
require_once("../lib/lib-mail-v2.php");

$email = $_GET['email'];
$activation_code = $_GET['activation_code'];
session_start();
$flags[] = FILTER_NULL_ON_FAILURE;
header('Content-Type: text/html; charset=utf-8');
$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);

$serverPort = $_SERVER['SERVER_PORT'];
;

$name = webAppName();

$baseUrl = "http://" . $serverName . ":" . $serverPort;

$baseNextUrl = $baseUrl . $name;

dbConnect(ConfigFile);
$dataBaseName = $GLOBALS['configDataBase']->db;
mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
$queryString = "SELECT * FROM `$dataBaseName`.`auth-user` WHERE `email`='$email'";
$queryResult = mysqli_query($GLOBALS['ligacao'], $queryString);
$record = mysqli_fetch_array($queryResult);
$active = intval($record['active']);

if ($active == 0) {
    $query = "UPDATE `$dataBaseName`.`auth-user` SET active=1 WHERE email='$email'";
    if (mysqli_query($GLOBALS['ligacao'], $query) == false) {
        echo "Information about file could not be inserted into the data base. Details : " . dbGetLastError();
    } else {
        echo "Information about file was inserted into data base.";
    }
}
$nextUrl = "loginForm.php";
header("Location: " . $baseNextUrl . $nextUrl);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <title>Process Form Register</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" typr="text/css" href="../../Styles/GlobalStyle.css">
</head>

<body>
</body>

</html>