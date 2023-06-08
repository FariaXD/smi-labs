<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
session_start();
require_once("../lib/db.php");
require_once("../lib/lib.php");
require_once("../lib/db_upload_media.php");

$allContent = GetAllContent($_SESSION['id']);
$orderedContent = OrderContent($allContent);
$seriesNames = GetAllSeriesNames($_SESSION['id']);
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
                <?php foreach ($orderedContent as $series) { ?>
                    <h5><?php echo $series[0][2] ?></h5>
                    <div class="m-0 p-0 w-100 justify-content-center align-items-center">
                        <?php foreach ($series as $serie) {
                            $idContent = $serie[0];
                            $thumbnail = $url . "/examples-smi/Projeto/media/$idContent" . ".jpg";
                        ?>
                            <div class="col-12 bg-dark p-0 my-3">
                                <!--IdSeries, displayName, private, episodeNumber -->
                                <form id="update_series_<?php echo $idContent ?>" action="POST">
                                    <div class="row">
                                        <a class="col-2" href="media.php?idContent=<?php echo $idContent ?>"><img src="<?php echo $thumbnail ?>" alt="Image Description" class="rounded" style="height: 20vh;width: 20vh;"></a>
                                        <div class="col-2 d-flex justify-content-center align-items-center">
                                            <div class="form-group text-center">
                                                <label class="text-white" for="displayName">Display Name</label>
                                                <input type="text" class="form-control" name="displayName" value="<?php echo $serie[2] ?>" placeholder="User's Username" required>
                                            </div>
                                        </div>
                                        <div class="col-2 d-flex justify-content-center align-items-center">
                                            <div class="form-group text-center">
                                                <label for="series" class="control-label text-white">Series</label>
                                                <select id="select_series_series<?php echo $serie[0] ?>" name="series" class="form-select w-100" aria-label="Default select example">
                                                    <?php foreach ($seriesNames as $seriesName) { ?>
                                                        <option value="<?php echo intval($seriesName[0]) ?>"><?php echo $seriesName[1] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <script>
                                                    // Select the option with value "optionValue"
                                                    document.getElementById('select_series_series<?php echo $serie[0] ?>').value = <?php echo $serie[1] ?>;
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-2 d-flex justify-content-center align-items-center">
                                            <label for="private" class="control-label mr-4 text-white">Private</label>
                                            <input id="private_series" <?php if ($serie[5] == 1) echo 'checked'; ?> class="" type="checkbox" name="private" placeholder="Toggle private" />
                                        </div>
                                        <div class="col-2 d-flex justify-content-center align-items-center">
                                            <label for="episodeNumber" class="control-label mr-4 text-white">Episode Number</label>
                                            <select id="select_episode_numb<?php echo $serie[0] ?>" name="episodeNumber" class="form-select w-100" aria-label="Default select example">
                                                <?php for ($i = 1; $i <= count($series); $i++) { ?>
                                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php } ?>
                                            </select>
                                            <script>
                                                // Select the option with value "optionValue"
                                                document.getElementById('select_episode_numb<?php echo $serie[0] ?>').value = <?php echo $serie[4] ?>;
                                            </script>
                                        </div>
                                        <div class="col-md-2  d-flex align-items-center">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <input type="submit" name="submitAction" value="Update" class="text-dark btn btn-light mb-1" />
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <input type="submit" name="submitAction" value="Delete" class="text-dark btn btn-light mb-1" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="modal fade" id="confirmationModal<?php echo $idContent ?>" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabelSeries" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmationModalLabel<?php echo $idContent ?>">Confirm Action
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
                                        .getElementById("update_series_<?php echo $idContent ?>")
                                        .addEventListener("submit", function(event) {
                                            event.preventDefault(); // Prevent default form submission

                                            var formData = new FormData();
                                            var form = document.getElementById("update_series_<?php echo $idContent ?>");
                                            formData.append("idContent", <?php echo $idContent ?>);
                                            formData.append("displayName", form.elements.displayName.value);
                                            formData.append("newSeries", form.elements.series.value);
                                            formData.append("oldSeries", <?php echo $serie[1] ?>);
                                            var priv = $("#private_series").is(":checked");
                                            formData.append("private", priv);
                                            formData.append("oldEpisodeNumber", <?php echo $serie[4] ?>);
                                            formData.append("newEpisodeNumber", form.elements.episodeNumber.value);
                                            var submitAction = event.submitter.value; // Get the value of the clicked button
                                            formData.append("submitAction", submitAction)
                                            $("#confirmationModal<?php echo $idContent ?>").modal("show");

                                            // Assign the submitForm function to the Confirm button
                                            document
                                                .getElementById("confirmationModal<?php echo $idContent ?>")
                                                .querySelector("button.btn-primary").onclick = function() {
                                                    SubmitFormData("processUpdateContent.php", formData);
                                                };
                                        });
                                </script>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include '../lib/dependenciesScripts.php' ?>
    <script src="/examples-smi/Projeto/src/content/js/userContent.js"></script>

</body>