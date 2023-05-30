<?php
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    
    require_once("../lib/lib.php");
    
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <title>Email Confirmation</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" typr="text/css" href="../../Styles/GlobalStyle.css">
    <?php include '../lib/dependenciesLinks.php' ?>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include '../sidebarmenus/sidebar.php' ?>
            <div class="col-md-10 bg-lightest-gray">
                <div class="mb-5">
                    <h1 align="center">PHP - Email Confirmation Sent</h1>
                    <p align="center">Please go to email and authenticate.<br> If email has been authenticated please:</p>
                    <p align="center"><a href="loginForm.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>
    <?php include '../lib/dependenciesScripts.php' ?>
</body>

</html>