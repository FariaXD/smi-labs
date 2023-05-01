<!DOCTYPE html>
<?php
require_once("../../Lib/lib.php");

$flags[] = FILTER_NULL_ON_FAILURE;

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);

$serverPortSSL = 443;
$serverPort = 80;

$name = webAppName();

$nextUrl = "https://" . $serverName . ":" . $serverPortSSL . $name . "processFormRegister.php";
include_once("configDebug.php");

if ($debug == true) {
    $value = "value=\"" . $captchaValue . "\"";
    echo "<p>Debug is active</p>";
} else {
    $value = "value=\"\"";
}
?>
<html>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <title>Authentication Using PHP</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" typr="text/css" href="../../Styles/GlobalStyle.css">
</head>
<?php

?>

<body>
    <form action="<?php echo $nextUrl ?>" method="POST">
        <table>
            <tr>
                <td>User Name</td>
                <td><input type="text" name="username" pattern="^[a-zA-Z0-9]+$" placeholder="Type your name" value="test21" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" placeholder="Type your email" value="fariafactor2@gmail.com" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" value="fariafaria21" placeholder="Type your password" required></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td><input type="password" name="confirmPassword" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" value="fariafaria21" placeholder="Confirm your password" required></td>
            </tr>
            <tr>
                <td>Verify Captcha</td>
                <td><img src="captchaImage.php" /></td>
            </tr>
            <tr>
                <td>Digit Code</td>
                <td><input type="text" name="captcha" id="captcha" <?php echo $value; ?> required></td>
            </tr>
        </table>
        <input type="submit" value="Register"> <input type="reset" value="Clear">
    </form>
</body>

</html>