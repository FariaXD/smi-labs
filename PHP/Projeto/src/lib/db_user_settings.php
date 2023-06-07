<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
function GetUserInfo($idUser){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "SELECT * FROM `auth-user` WHERE `idUser`=$idUser";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    $user = [];
    $record = mysqli_fetch_array($result);
    array_push($user, [$record["username"], $record["email"], $record["password"]]);
    return $user[0];
}

function userIsValid($idUser, $password){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "SELECT * FROM `auth-user` WHERE `idUser`='$idUser' AND `password`='$password'";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }

}

function updateUser($idUser, $username, $newPassword){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "UPDATE `auth-user` SET `username`='$username', `password`='$newPassword' WHERE `idUser`='$idUser'";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    return $result;
}