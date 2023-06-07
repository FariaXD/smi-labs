<html lang="en">
<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
require_once("../lib/db.php");
error_reporting(-1);
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include '../lib/dependenciesLinks.php' ?>
</head>

<body class="bg-lightest-gray">
    <div class="container-fluid">
        <div class="row">
            <?php include '../sidebarmenus/sidebar.php' ?>
            <div id="accordion" class="col-md-10 vh-100 bg-lightest-gray overflow-auto">
                <?php
                $role = isset($_SESSION['roleName']) ? $_SESSION['roleName'] : "Guest";
                if ($role == "Admin") {
                    include 'updateUsers.php';
                    include 'addCategory.php';
                    include 'updateCategories.php';
                    include 'updateMailService.php';
                }
                ?>
            </div>
        </div>
    </div>
    <?php include '../lib/dependenciesScripts.php' ?>
</body>

</html>