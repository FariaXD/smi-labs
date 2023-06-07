<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
session_start();
require_once("../lib/db.php");
require_once("../lib/lib.php");
require_once("../lib/db_user_settings.php");
$user = GetUserInfo($_SESSION['id']);
$flags[] = FILTER_NULL_ON_FAILURE;
$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);
$serverPort = $_SERVER['SERVER_PORT'];
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
            <div id="accordion" class="col-md-10 vh-100 bg-lightest-gray overflow-auto">
                <form id="user" method="POST">
                    <div class="row bg-light">
                        <h3 class="col-12 text-dark text-center">User</h3>
                        <!--Image Col-->
                        <div class="col-md-12 my-2">
                            <div class="row">
                                <!--Image-->
                                <div class="col-md-12 text-center">
                                    <img src="/examples-smi/Projeto/imgs/userplace.png" alt="User Image" class="center rounded-circle my-3" style="width: 75px; height: 75px;">
                                </div>
                            </div>
                        </div>
                        <!--Username-->
                        <div class="col-md-12 text-center align-items-center justify-content-center d-flex my-2">
                            <input type="text" name="username" value="<?php echo $user[0] ?>" placeholder="Username..." required>
                        </div>
                        <!--Password-->
                        <div class="col-md-12 text-center align-items-center justify-content-center d-flex my-2">
                            <input type="password" name="currentPassword" value="" placeholder="Current Password..." required>
                        </div>
                        <div class="col-md-12 text-center align-items-center justify-content-center d-flex my-2">
                            <input type="password" name="newPassword" value="" placeholder="New password...">
                        </div>
                        <div class="col-md-12 text-center align-items-center justify-content-center d-flex my-2">
                            <input type="password" name="cNewPassword" value="" placeholder="Confirm new password...">
                        </div>
                        <div class="col-md-12  align-items-center justify-content-center d-flex my-2">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="submitAction" value="Update" class="text-white btn btn-dark mb-1" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabelSeries" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmationModalLabel">Confirm Action
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to proceed with this action?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document
                        .getElementById("user")
                        .addEventListener("submit", function(event) {
                            event.preventDefault(); // Prevent default form submission

                            var formData = new FormData();
                            var form = document.getElementById("user");
                            formData.append("username", form.elements.username.value);
                            formData.append("currentPassword", form.elements.currentPassword.value);
                            formData.append("newPassword", form.elements.newPassword.value);
                            formData.append("cNewPassword", form.elements.cNewPassword.value);
                            $("#confirmationModal").modal("show");
                            // Assign the submitForm function to the Confirm button
                            document
                                .getElementById("confirmationModal")
                                .querySelector("button.btn-primary").onclick = function() {
                                    SubmitFormData("processUserUpdate.php", formData);
                                };
                        });
                </script>
            </div>
        </div>
    </div>
    <?php include '../lib/dependenciesScripts.php' ?>
    <script src="/examples-smi/Projeto/src/content/js/userContent.js"></script>

</body>