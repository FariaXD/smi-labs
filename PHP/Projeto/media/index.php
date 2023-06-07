<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

$flags[] = FILTER_NULL_ON_FAILURE;
$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);
$serverPort = $_SERVER['SERVER_PORT'];
$baseUrl = "http://" . $serverName . ":" . $serverPort;
$nextUrl = $baseUrl . "/examples-smi/Projeto/src/";
header('Content-Type: text/html; charset=utf-8');
header("Location: " . $nextUrl);
