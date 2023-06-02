<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("../lib/db.php");
require_once("../lib/lib.php");
require_once("../lib/db_admin_options.php");

$delete = $_GET['delete'];
$idCat = $_POST['idCat'];
if($delete == 0){
    $categoryName = $_POST['categoryName'];
    UpdateCategory($idCat, $categoryName);
}
else{
    DeleteCategory($idCat);
}


//DeleteUser($idUser);
