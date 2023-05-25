
<?php
require_once("../../Lib/lib.php");
require_once("../../Lib/db.php");
require_once("../../Lib/lib-mail-v2.php");


$flags[] = FILTER_NULL_ON_FAILURE;

$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING, $flags);

if ($method == 'POST') {
    $_INPUT_METHOD = INPUT_POST;
} elseif ($method == 'GET') {
    $_INPUT_METHOD = INPUT_GET;
} else {
    echo "Invalid HTTP method (" . $method . ")";
    exit();
}
$flags[] = FILTER_NULL_ON_FAILURE;

$username = filter_input($_INPUT_METHOD, 'username', FILTER_SANITIZE_STRING, $flags);
$email = filter_input($_INPUT_METHOD, 'email', FILTER_SANITIZE_STRING, $flags);
$password = filter_input($_INPUT_METHOD, 'password', FILTER_SANITIZE_STRING, $flags);
$confirmPassword = filter_input($_INPUT_METHOD, 'confirmPassword', FILTER_SANITIZE_STRING, $flags);
$captcha = filter_input($_INPUT_METHOD, 'captcha', FILTER_SANITIZE_STRING, $flags);
$captchaVerify = false;

session_start();

header('Content-Type: text/html; charset=utf-8');

if ($_SESSION['captcha'] == $captcha) {
    $captchaVerify = true;
}
$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);

$serverPort = 81;

$name = webAppName();

$baseUrl = "http://" . $serverName . ":" . $serverPort;

$baseNextUrl = $baseUrl . $name;

function insertUserIntoDB(string $username, string $password, string $email)
{
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "INSERT INTO `$dataBaseName`.`auth-basic`" .
        "(`name`, `password`, `email`, `active`) values " .
        "('$username', '$password', '$email', '0')";
    if (mysqli_query($GLOBALS['ligacao'], $query) == false) {
        echo "User could not be added to database. Details: " . dbGetLastError();
        return false;
    } else {
        echo "User was added to the database.";
        return true;
    }
    dbDisconnect();
}

function insertChallengeIntoDB(string $challengecode, string $idUser)
{
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $curdate = date("Y-m-d H:i:s");
    $query = "INSERT INTO `$dataBaseName`.`auth-challenge`" .
        "(`idUser`, `challenge`, `registerDate`) values " .
        "('$idUser', '$challengecode', '$curdate')";
    if (mysqli_query($GLOBALS['ligacao'], $query) == false) {
        echo "Information about file could not be inserted into the data base. Details : " . dbGetLastError();
    } else {
        echo "Information about file was inserted into data base.";
    }
    dbDisconnect();
}

function insertSecurityOptionIntoDB(string $idUser){
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "INSERT INTO `$dataBaseName`.`auth-permissions`" .
    "(`idRole`, `idUser`) values " .
    "('2', '$idUser')";
    if (mysqli_query($GLOBALS['ligacao'], $query) == false) {
        echo "Information about file could not be inserted into the data base. Details : " . dbGetLastError();
    } else {
        echo "Information about file was inserted into data base.";
    }
    dbDisconnect();
}

function getIDUserViaEmail(string $email){
    echo "gag";
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $queryString = "SELECT * FROM `$dataBaseName`.`auth-basic` WHERE `email`='$email'";
    $queryResult = mysqli_query($GLOBALS['ligacao'], $queryString);
    $record = mysqli_fetch_array($queryResult);
    echo $record['idUser'];
    return $record['idUser'];
}

function sendConfirmationEmail(string $baseUrl, string $email, string $username)
{
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    
    $queryString = "SELECT * FROM `$dataBaseName`.`email-accounts` WHERE `id`='1'";
    $queryResult = mysqli_query($GLOBALS['ligacao'], $queryString);
    $record = mysqli_fetch_array($queryResult);

    $smtpServer = $record['smtpServer'];
    $port = intval($record['port']);
    $useSSL = boolval($record['useSSL']);
    $timeout = intval($record['timeout']);
    $loginName = $record['loginName'];
    $password = $record['password'];
    $fromEmail = $record['email'];
    $fromName = $record['displayName'];

    mysqli_free_result($queryResult);

    dbDisconnect();
    $activation_code = bin2hex(random_bytes(16));
    // create the activation link
    $activation_link = $baseUrl . "/examples-smi/07-Auth/Ver3/activate.php?email=$email&activation_code=$activation_code";

    // set email subject & body
    $subject = 'Please activate your account';
    $message = <<<MESSAGE
                    Hi,
                    Please click the following link to activate your account:
                    $activation_link
                    MESSAGE;
    sendAuthEmail(
        $smtpServer,
        $useSSL,
        $port,
        $timeout,
        $loginName,
        $password,
        $fromEmail,
        $fromName,
        $username . " <" . $email . ">",
        NULL,
        NULL,
        $subject,
        $message,
        FALSE,
        NULL
    );
    return $activation_code;
}

if ($password == $confirmPassword && $captchaVerify) {
    if(insertUserIntoDB($username, $password, $email)){
        $challengecode = sendConfirmationEmail($baseUrl, $email, $username);
        insertChallengeIntoDB($challengecode, getIDUserViaEmail($email));
        insertSecurityOptionIntoDB(getIDUserViaEmail($email));
        $nextUrl = "confirmation.php";
    }
    else{
        $nextUrl = "formRegister.php";
    }
} else {
    $nextUrl = "formRegister.php";
}

header("Location: " . $baseNextUrl . $nextUrl);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <title>Process Form Register</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" typr="text/css" href="../../Styles/GlobalStyle.css">
</head>

<body>
</body>

</html>