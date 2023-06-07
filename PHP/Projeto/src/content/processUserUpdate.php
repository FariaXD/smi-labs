<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
require_once("../lib/db.php");
require_once("../lib/db_user_settings.php");
require_once("../lib/lib.php");
session_start();
$idUser = $_SESSION['id'];
$username = $_POST['username'];
$currentPwd = $_POST['currentPassword'];
$newPwd = $_POST['newPassword'];
$cNewPwd = $_POST['cNewPassword'];

if($newPwd != "" && $newPwd == $cNewPwd && userIsValid($idUser, $currentPwd)){
    updateUser($idUser,  $username, $newPwd);

}
if(userIsValid($idUser, $currentPwd)){
    updateUser($idUser,  $username, $currentPwd);
}

