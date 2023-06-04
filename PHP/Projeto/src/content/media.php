<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
require_once("../lib/db.php");
require_once("../lib/db_upload_media.php");

error_reporting(-1);
session_start();
$idContent = $_GET['idContent'];
$flags[] = FILTER_NULL_ON_FAILURE;

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);

$serverPort = 81;

$UrL = "http://" . $serverName . ":" . $serverPort;
$videoPath = GetVideoPath($idContent);
$videoPath1 = $UrL . "/examples-smi/Projeto/media/" . rawurlencode($videoPath);
?>

<head>
    <title>Media</title>
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
    <!-- City -->
    <link href="https://unpkg.com/@videojs/themes@1/dist/city/index.css" rel="stylesheet">
    <?php include '../lib/dependenciesLinks.php' ?>
</head>

<body class="bg-lightest-gray">
    <div class="container-fluid">
        <div class="row">
            <?php include '../sidebarmenus/sidebar.php' ?>
            <div id="accordion" class="col-md-10 bg-lightest-gray">
                <video id="my-video" class="video-js vjs-theme-city" controls preload="auto" width="640" height="264" data-setup="{}">
                    <source src="<?php echo $videoPath1 ?>" type="video/mp4" />
                    <source src="<?php echo $videoPath1 ?>" type="video/webm" />

                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
            </div>
        </div>
    </div>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
</body>