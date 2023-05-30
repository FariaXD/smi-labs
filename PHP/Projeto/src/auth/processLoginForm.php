<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("../lib/db.php");
require_once("../lib/lib.php");
require_once("../lib/auth-methods.php");

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

$username = filter_input($_INPUT_METHOD, 'username', FILTER_UNSAFE_RAW, $flags);
$password = filter_input($_INPUT_METHOD, 'password', FILTER_UNSAFE_RAW, $flags);

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);

$serverPort = 81;

$name = webAppName();
$baseUrl = "http://" . $serverName . ":" . $serverPort;
$failUrl = $baseUrl . "/examples-smi/Projeto/src/auth/loginForm.php";
$successUrl = $baseUrl . "/examples-smi/Projeto/src/auth/confirmation.php";
$nextUrl = $failUrl;

$idUser = tryLoginUser($username, $password, "user");
if ($idUser > 0) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $idUser;
    $_SESSION['roleName'] = getRole($idUser);
    $nextUrl = $baseUrl . "/examples-smi/Projeto/src";
} 
header("Location: " . $nextUrl);
?>