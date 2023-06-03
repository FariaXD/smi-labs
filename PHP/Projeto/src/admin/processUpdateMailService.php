<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("../lib/db.php");
require_once("../lib/lib.php");
require_once("../lib/db_admin_options.php");

$acc_name = $_POST['acc_name'];
$login_name = $_POST['login_name'];
$password = $_POST['password'];
$email = $_POST['email'];
$disp_name = $_POST['disp_name'];

UpdateMailService($acc_name, $login_name, $password, $email, $disp_name);