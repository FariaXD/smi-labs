<?php

use PSpell\Config;

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/lib.php';

function GetAllUsers(){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $all_users_query = "SELECT `auth-user`.`username`, `auth-user`.`email`, `auth-permissions`.`idRole`, `auth-roles`.`roleName`, `auth-user`.`idUser`
                        FROM `auth-roles`
                        INNER JOIN `auth-permissions` ON `auth-permissions`.`idRole` = `auth-roles`.`idRole`
                        INNER JOIN `auth-user` ON `auth-permissions`.`idUser` = `auth-user`.`idUser`";
    $all_users_query_result = mysqli_query($GLOBALS['ligacao'], $all_users_query);
    $users = [];
    while (($record = mysqli_fetch_array($all_users_query_result))) {
        array_push($users, [$record["idUser"], $record['username'], $record['email'], $record['roleName'], $record['idRole']]);
    }
    return $users;

}

function DeleteUser($idUser){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    if($idUser > 1){
        $delete_query = "DELETE FROM `auth-user` WHERE `idUser` = $idUser";
        $all_users_query_result = mysqli_query($GLOBALS['ligacao'], $delete_query);
        echo $all_users_query_result;
    }
    else{
        echo "Can't delete admin user.";
    } 
}

function UpdateUser($idUser, $username, $email, $roleName){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $update_query_user = "UPDATE `auth-user` SET `username` = '$username', `email` = '$email' WHERE `idUser` = $idUser";
    $update_user_result = mysqli_query($GLOBALS['ligacao'], $update_query_user);
    if ($update_user_result) {
        echo "The user was updated successfully.";
    } else {
        echo "Error updating user: " . mysqli_error($GLOBALS['ligacao']);
    }

    $idRole_query = "SELECT `idRole` FROM `auth-roles` WHERE `roleName` = '$roleName'";
    $result = mysqli_query($GLOBALS['ligacao'], $idRole_query);
    $idRole = 0;
    if ($result) {
        $roles = mysqli_fetch_array($result);
        $idRole = $roles['idRole'];
    }

    $update_role = "UPDATE `auth-permissions` SET `idRole` = $idRole WHERE `idUser` = $idUser";
    $update_role_result = mysqli_query($GLOBALS['ligacao'], $update_role);
    if ($update_role_result) {
        echo "The user role was updated successfully.";
    } else {
        echo "Error updating user role: " . mysqli_error($GLOBALS['ligacao']);
    }
}

function GetAllCats(){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $select_cats_query = "SELECT * FROM `media-category`";
    $select_cats_query_result = mysqli_query($GLOBALS['ligacao'], $select_cats_query);
    $cats = [];
    while (($record = mysqli_fetch_array($select_cats_query_result))) {
        array_push($cats, [$record["idCategory"], $record['categoryName']]);
    }
    return $cats;
}

function UpdateCategory($idCat, $categoryName){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $update_query_user = "UPDATE `media-category` SET `categoryName` = '$categoryName' WHERE `idCategory` = $idCat";
    $update_query_user_result = mysqli_query($GLOBALS['ligacao'], $update_query_user);
    if ($update_query_user_result) {
        echo "The category was updated succesfully.";
    } else {
        echo "Error updating user role: " . mysqli_error($GLOBALS['ligacao']);
    }
}

function DeleteCategory($idCat){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $delete_query = "DELETE FROM `media-category` WHERE `idCategory` = $idCat";
    $delete_query_result = mysqli_query($GLOBALS['ligacao'], $delete_query);
    echo "correctly deleted category " . $delete_query_result;
}

function GetEmailService(){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $email_query = "SELECT * FROM `email-accounts` WHERE `id` = 1";
    $email_query_result = mysqli_query($GLOBALS['ligacao'], $email_query);
    $email = [];
    while (($record = mysqli_fetch_array($email_query_result))) {
        array_push($email, [$record["accountName"], $record['loginName'], $record['password'], $record['email'], $record['displayName']]);
    }
    return $email;
}

function UpdateMailService($accName, $loginName, $password, $email, $displayName){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $update_query_user = "UPDATE `email-accounts` SET `accountName` = '$accName',
     `loginName` = '$loginName',
      `password` = '$password',
      `email` = '$email',
      `displayName` = '$displayName' WHERE `id` = 1";
    $update_user_result = mysqli_query($GLOBALS['ligacao'], $update_query_user);
    if ($update_user_result) {
        echo "The mail was updated succesfully.";
    } else {
        echo "Error updating mail: " . mysqli_error($GLOBALS['ligacao']);
    }
}

?>