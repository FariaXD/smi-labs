<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/lib-mail-v2.php';

function insertUserIntoDB(string $username, string $password, string $email)
{
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "INSERT INTO `$dataBaseName`.`auth-user`" .
        "(`username`, `password`, `email`, `active`) values " .
        "('$username', '$password', '$email', '0')";
    try {
        $result = mysqli_query($GLOBALS['ligacao'], $query);
        if ($result == false) {
            echo "User could not be added to database. Details: " . dbGetLastError();
            dbDisconnect();
            return false;
        } else {
            echo "User was added to the database.";
            dbDisconnect();
            return true;
        }
    } catch (mysqli_sql_exception $exception) {
        
        $errorMessage = $exception->getMessage();
        return false;
        
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
        "('3', '$idUser')";
    if (mysqli_query($GLOBALS['ligacao'], $query) == false) {
        echo "Information about file could not be inserted into the data base. Details : " . dbGetLastError();
    } else {
        echo "Information about file was inserted into data base.";
    }
    dbDisconnect();
}

function getIDUserViaEmail(string $email)
{
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $queryString = "SELECT * FROM `$dataBaseName`.`auth-user` WHERE `email`='$email'";
    $queryResult = mysqli_query($GLOBALS['ligacao'], $queryString);
    $record = mysqli_fetch_array($queryResult);
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

function getRole($userId)
{
    if ($userId === 0) {
        return "guest";
    }

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT `roleName` " .
    "FROM `$dataBaseName`.`auth-user` u " .
    "JOIN `$dataBaseName`.`auth-permissions` p ON u.`idUser`=p.`idUser` " .
    "JOIN `$dataBaseName`.`auth-roles` r on p.`idRole`=r.`idRole` WHERE u.`active`=1 AND u.`idUser`='$userId'";

    $result = mysqli_query($GLOBALS['ligacao'], $query);
    $userData = mysqli_fetch_array($result);
    $userRole = $userData['roleName'];
    
    mysqli_free_result($result);

    dbDisconnect();

    return $userRole;
}

function getEmail($idUser, $authType)
{
    $userEmail = -1;

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT `email` FROM `$dataBaseName`.`auth-$authType` WHERE `idUser`='$idUser'";

    $result = mysqli_query($GLOBALS['ligacao'], $query);

    if ($result != false) {
        $userData = mysqli_fetch_array($result);
        $userEmail = $userData['email'];
    }
    mysqli_free_result($result);

    dbDisconnect();

    return $userEmail;
}

function tryLoginUser($userName, $password, $authType)
{
    $userOk = -1;

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query =
        "SELECT * FROM `$dataBaseName`.`auth-$authType` " .
        "WHERE `username`='$userName' AND `password`='$password' AND `active`='1'";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    if (mysqli_num_rows($result) != 0) {
        $record = mysqli_fetch_array($result);
        $userOk = $record['idUser'];
    }
    mysqli_free_result($result);

    dbDisconnect();

    return $userOk;
}


?>