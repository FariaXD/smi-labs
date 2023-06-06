﻿<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
session_start();
require_once("../lib/db.php");
require_once("../lib/lib.php");
include_once("../lib/db_upload_media.php");
$allContent = GetAllContent($_SESSION['id']);
$orderedContent = OrderContent($allContent);
$flags[] = FILTER_NULL_ON_FAILURE;
$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);
$serverPort = 81;
$url = "http://" . $serverName . ":" . $serverPort;
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
                <?php foreach ($orderedContent as $series) { ?>
                    <h5><?php echo $series[0][2] ?></h5>
                    <div class="row">
                        <?php foreach ($series as $serie) {
                            $idContent = $serie[0];
                            $thumbnail = $url . "/examples-smi/Projeto/media/$idContent" . ".jpg";
                        ?>
                            <div class="col-12 bg-dark p-0 my-3">
                                <img src="<?php echo $thumbnail ?>" alt="Image Description" class="rounded w-25 h-100">
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include '../lib/dependenciesScripts.php' ?>
</body>