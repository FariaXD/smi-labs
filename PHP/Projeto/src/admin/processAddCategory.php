<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("../lib/db.php");
require_once("../lib/lib.php");

$flags[] = FILTER_NULL_ON_FAILURE;

$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_UNSAFE_RAW, $flags);

if ($method == 'POST') {
    $_INPUT_METHOD = INPUT_POST;
} elseif ($method == 'GET') {
    $_INPUT_METHOD = INPUT_GET;
} else {
    echo "Invalid HTTP method (" . $method . ")";
    exit();
}
$flags[] = FILTER_NULL_ON_FAILURE;

$categoryName = filter_input($_INPUT_METHOD, 'categoryName', FILTER_UNSAFE_RAW, $flags);

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);

$serverPort = $_SERVER['SERVER_PORT'];
;

$name = webAppName();
$baseUrl = "http://" . $serverName . ":" . $serverPort;
$nextUrl = $baseUrl . "/examples-smi/Projeto/src/admin/dashboard.php";

$query = "INSERT INTO `media-category` (`categoryName`) VALUES ('$categoryName')";
dbConnect(ConfigFile);
$dataBaseName = $GLOBALS['configDataBase']->db;
mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
$update_user_result = mysqli_query($GLOBALS['ligacao'], $query);


header('Content-Type: text/html; charset=utf-8');

header("Location: " . $nextUrl);


