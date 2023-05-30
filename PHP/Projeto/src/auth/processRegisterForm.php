<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("../lib/db.php");
require_once("../lib/lib.php");
require_once("../lib/lib-mail-v2.php");
require_once("../lib/auth-methods.php");

$flags[] = FILTER_NULL_ON_FAILURE;

$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_UNSAFE_RAW, $flags);

if ($method == 'POST') {
    $_INPUT_METHOD = INPUT_POST;
} elseif ($method == 'GET') {
    $_INPUT_METHOD = INPUT_GET;
} else {
    echo "Invalid HTTP method (" . $method . ")";
    exit();
}
$flags[] = FILTER_NULL_ON_FAILURE;

$username = filter_input($_INPUT_METHOD, 'username', FILTER_UNSAFE_RAW, $flags);
$email = filter_input($_INPUT_METHOD, 'email', FILTER_UNSAFE_RAW, $flags);
$cemail = filter_input($_INPUT_METHOD, 'cemail', FILTER_UNSAFE_RAW, $flags);
$password = filter_input($_INPUT_METHOD, 'password', FILTER_UNSAFE_RAW, $flags);
$cpassword = filter_input($_INPUT_METHOD, 'cpassword', FILTER_UNSAFE_RAW, $flags);

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);

$serverPort = 81;

$name = webAppName();
$baseUrl = "http://" . $serverName . ":" . $serverPort;
$failUrl = $baseUrl . "/examples-smi/Projeto/src/auth/registerForm.php";
$successUrl = $baseUrl . "/examples-smi/Projeto/src/auth/confirmation.php";
$isSuccess = false;
$nextUrl = $failUrl;

session_start();
echo $username . " " . $email . " " . $cemail . " " . $password . " " . $cpassword;
header('Content-Type: text/html; charset=utf-8');
if($username != "" && $email != "" && $password != "" && $password == $cpassword && $email == $cemail){
    echo "agaga";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        "secret" => "6Lf9EE4mAAAAAN-RnUEHdyn9ihZ8GMF1cYXymXqj",
        "response" => filter_input(INPUT_POST, "g-recaptcha-response")
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = json_decode(curl_exec($ch), true);
    if ($result['success'] == 1) {
        dbConnect(ConfigFile);
        if(insertUserIntoDB($username, $password, $email)){
            $challengecode = sendConfirmationEmail($baseUrl, $email, $username);
            insertChallengeIntoDB($challengecode, getIDUserViaEmail($email));
            insertSecurityOptionIntoDB(getIDUserViaEmail($email));
            $isSuccess = true;
        }
        if($isSuccess){
            $nextUrl = $successUrl;
        }
    }
}
header("Location: " . $nextUrl);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Test</h3>
</body>
</html>