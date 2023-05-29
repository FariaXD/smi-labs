﻿<html lang="en">
<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once("../Lib/lib.php");
$flags[] = FILTER_NULL_ON_FAILURE;

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);

$serverPort = 81;

$name = webAppName();

$NextUrL = "http://" . $serverName . ":" . $serverPort . $name . "processLoginForm.php";

#$nextUrl = "http://" . $serverName . ":" . $serverPort . $name . "processFormLogin.php";

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <?php include '../lib/dependenciesLinks.php' ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include '../sidebarmenus/sidebar.php' ?>
            <div class="col-md-10 bg-lightest-gray">
                <div class="row mb-5">
                    <h3 class="col-12 mx-5 mt-5">Login</h3>
                    <div class="">
                        <form class="mx-5" action="<?php echo $nextUrl ?>" method="POST">
                            <table>
                                <tr>
                                    <td>User Name</td>
                                    <td><input type="text" name="username" placeholder="Type your name"></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td><input type="password" name="password" placeholder="Type your password"></td>
                                </tr>
                            </table>
                            <div class="col-12 mb-3">
                                <input class="text-white btn btn-dark mr-2" type="submit" value="Login">
                                <input class="text-white btn btn-dark ml-2" type="reset" value="Clear">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../lib/dependenciesScripts.php' ?>
</body>

</html>