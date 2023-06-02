<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("../lib/db.php");
require_once("../lib/lib.php");
require_once("../lib/db_admin_options.php");
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

$idUser = $_GET['idUser'];

DeleteUser($idUser);
?>

