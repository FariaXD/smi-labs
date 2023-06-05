<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
session_start();
require_once("../lib/db.php");
require_once("../lib/lib.php");
include_once("../lib/db_upload_media.php");
$allContent = GetAllContent($_SESSION['id']);
$orderedContent = OrderContent($allContent);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publish Content</title>
    <?php include '../lib/dependenciesLinks.php' ?>
</head>

<body class="bg-lightest-gray">
    <div class="container-fluid">
        <div class="row">
            <?php include '../sidebarmenus/sidebar.php' ?>
            <div id="accordion" class="col-md-10 bg-lightest-gray overflow-auto">

            </div>
        </div>
    </div>
</body>