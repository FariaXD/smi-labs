<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("../lib/db.php");
require_once("../lib/lib.php");
require_once("../lib/db_admin_options.php");

// Retrieve form data
$idUser = $_GET['idUser'];

// Assuming you are using FormData and sending it via POST
$username = $_POST['username'];
$email = $_POST['email'];
$role = $_POST['roleName'];

// Echo the received data for debugging
echo $idUser . " " . $username . " " . $email . " " . $role;

// Update user
UpdateUser($idUser, $username, $email, $role);

// Rest of your code...
