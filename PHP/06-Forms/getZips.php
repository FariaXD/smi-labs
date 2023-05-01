<?php
header('Content-Type: text/html; charset=utf-8');
require_once("../Lib/db.php");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
  $_args = $_POST;
} elseif ($method == 'GET') {
  $_args = $_GET;
} else {
  exit(-1);
}

$district = $_args["district"];
$county = $_args["county"];


dbConnect(ConfigFile);
$dataBaseName = $GLOBALS['configDataBase']->db;
mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
$queryString =
  "SELECT `postalCode`, `postalCodeExtension` FROM `$dataBaseName`.`forms-zips` " .
  "WHERE `idDistrict`=$district AND `idCounty`=$county";
$queryResult = mysqli_query($GLOBALS['ligacao'], $queryString);
$currentID = 0;
if ($queryResult) {
  $result[] = array('id' => 0, 'postalCode' => "");

  while ($registo = mysqli_fetch_array($queryResult)) {
    $postalCodeString = $registo['postalCode']."-".$registo['postalCodeExtension'];
    $result[] = array(
      'id' => $currentID,
      'postalCode' => $postalCodeString
    );
    $currentID++;
  }
} else {
  $errDesc = mysqli_error($GLOBALS['ligacao']);
  $errNumber = mysqli_errno($GLOBALS['ligacao']);

  $result[] = array(
    'id' => -1,
    'postalCode' => "No Zips Available"
  );
  $result[] = array(
    'id' => -$errNumber,
    'postalCode' => $errDesc
  );
}
dbDisconnect();
echo json_encode( $result );
?>