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
$content = GetVideoInfo($idContent);
$videoPath = $UrL . "/examples-smi/Projeto/media/" . rawurlencode($content['name']);

$comments = GetAllCommentsToMedia($idContent);
$newViews = AddViewToContent($content);
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
            <div id="accordion" class="col-md-10 vh-100 bg-lightest-gray overflow-auto">
                <div class="row mt-5">
                    <div class="col-md-10 pl-0">
                        <video id="my-video" class="video-js vjs-theme-city w-100 " controls preload="auto" height="580" data-setup="{}">
                            <source src="<?php echo $videoPath ?>" type="video/mp4" />
                            <source src="<?php echo $videoPath ?>" type="video/webm" />
                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                            </p>
                        </video>
                        <div class="row">
                            <div class="col-11 w-100">
                                <h4 class="mt-2 ml-2 text-dark"><?php echo $content['displayName'] ?></h4>
                            </div>
                            <div class="col-1 d-flex align-items-center">
                                <i class="fa-sharp fa-solid fa-eye"></i>
                                <h4 class=""><?php echo $newViews ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 w-100 text-center">
                        <h5 class="text-center">Related</h5>
                    </div>
                    <div class="col-12 mt-5 mx-auto text-center">
                        <h4 class="text-dark">Comment</h4>
                        <!--New Comment-->
                        <div class="w-100 d-flex align-items-center justify-content-center">
                            <form id="newComment" action="POST" class="w-75">
                                <div class="input-group w-100 rounded-pill bg-light row">
                                    <div class="col-11 w-100 p-0">
                                        <input class="w-100 form-control rounded-pill" type="text" name="comment" placeholder="Type your comment..." required />
                                    </div>
                                    <div class="col-1 d-flex align-items-center">
                                        <button type="submit" class="btn btn-dark rounded-pill">
                                            <i class="fa-sharp fa-solid fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="modal fade" id="confirmationModalComment" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabelComment" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabelComment">Confirm Action
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to post this comment?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="commentContainer rounded-pill bg-light h-100">
                            <h4 class="text-dark">Comments</h4>
                            <div class="bg-gray row justify-content-center">
                                <?php foreach ($comments as $comment) { ?>
                                    <div class="col-7 rounded bg-light-dark w-50 my-2">
                                        <div class="row">
                                            <div class="col-2 p-0">
                                                <img src="/examples-smi/Projeto/imgs/userplace.png" alt="User Image" class="col-12 p-0 center rounded-circle my-3" style="width: 50px; height: 50px;">
                                                <p class="fa col-12"><?php echo $comment[3] ?></p>
                                            </div>
                                            <div class="col-10 my-3">
                                                <p class="w-100 h-100 bg-light rounded-pill lead"><?php echo $comment[2] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    <script src="/examples-smi/Projeto/src/content/js/media.js"></script>
    <script>
        document
            .getElementById("newComment")
            .addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent default form submission

                var formData = new FormData();
                var form = document.getElementById("newComment");
                formData.append("comment", form.elements.comment.value);
                formData.append("idContent", <?php echo $content['idContent'] ?>);

                $("#confirmationModalComment").modal("show");

                // Assign the submitForm function to the Confirm button
                document
                    .getElementById("confirmationModalComment")
                    .querySelector("button.btn-primary").onclick = function() {
                        SubmitFormData("processNewComment.php", formData);
                    };
            });
    </script>
    <?php include '../lib/dependenciesScripts.php' ?>
</body>