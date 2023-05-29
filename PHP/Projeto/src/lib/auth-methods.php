<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/lib-mail-v2.php';

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
        dbDisconnect();
        return false;
    } else {
        echo "User was added to the database.";
        dbDisconnect();
        return true;
    }
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

function insertSecurityOptionIntoDB(string $idUser)
{
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

function getIDUserViaEmail(string $email)
{
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
    $activation_link = $baseUrl . "/examples-smi/Projeto/src/auth/activate.php?email=$email&activation_code=$activation_code";

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

?>