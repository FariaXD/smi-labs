<html lang="en">
<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
require_once("../lib/db.php");
require_once("../lib/db_admin_options.php");

error_reporting(-1);
session_start();

$cats = GetAllCats();

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
            <div id="accordion" class="col-md-10 bg-lightest-gray">
                <div class="row">
                    <div class="col-md-6">
                        <form action="POST" id="publish_series">
                            <div class="row">
                                <h4 class="col-12 text-center">New Episode</h4>
                                <div class="col-12 mb-2">
                                    <label for="name" class="control-label">Name</label>
                                    <input class="w-100" type="text" name="name" placeholder="Type your series name" required/>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="episodeNumb" class="control-label">Number of Episode</label>
                                    <input class="w-100" type="number" name="episodeNumb" placeholder="Type the episode number" required/>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="categories" class="control-label">Categories</label>
                                    <select id="select_categories_series" name="categories" class="form-select w-100" aria-label="Default select example" multiple required>
                                        <?php foreach ($cats as $cat) { ?>
                                            <option value="<?php echo $cat[0] ?>"><?php echo $cat[1] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 mb-2 text-center">
                                    <label for="private" class="control-label">Private</label>
                                    <input class="" type="checkbox" name="private" placeholder="Toggle private"/>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="content" class="control-label">Upload</label>
                                    <input class="w-100" type="file" id="content" name="content" accept="video/*" required /><br>
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="submit" name="submitAction" value="Upload" class="text-white btn btn-dark mb-1" />
                                    <input type="reset" name="clear" value="Clear" class="text-white btn btn-dark mb-1" />
                                </div>
                            </div>
                        </form>
                        <div class="modal fade" id="confirmationModalSeries" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabelSeries" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmationModalLabelSeries">Confirm Action
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
                    </div>
                    <div class="col-md-6">
                        <form action="POST" id="publish_movie">
                            <div class="row">
                                <h4 class="col-12 text-center">New Movie</h4>
                                <div class="col-12 mb-2">
                                    <label for="name" class="control-label">Name</label>
                                    <input class="w-100" type="text" name="name" placeholder="Type your movie name" required/>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="categories" class="control-label">Categories</label>
                                    <select id="select_categories_movie" name="categories" class="form-select w-100" aria-label="Default select example" multiple required>
                                        <?php foreach ($cats as $cat) { ?>
                                            <option value="<?php echo $cat[0] ?>"><?php echo $cat[1] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12 mb-2 text-center">
                                    <label for="private" class="control-label">Private</label>
                                    <input class="" type="checkbox" name="private" placeholder="Toggle private"/>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="content" class="control-label">Upload</label>
                                    <input multiple="false" class="w-100" type="file" id="content" name="content" accept="video/*" required /><br>
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="submit" name="submitAction" value="Upload" class="text-white btn btn-dark mb-1" />
                                    <input type="reset" name="clear" value="Clear" class="text-white btn btn-dark mb-1" />
                                </div>
                            </div>
                        </form>
                        <div class="modal fade" id="confirmationModalMovies" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabelMovies" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmationModalLabelMovies">Confirm Action
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/examples-smi/Projeto/src/content/js/process_content.js"></script>
    <?php include '../lib/dependenciesScripts.php' ?>
</body>

</html>