<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("../lib/db.php");
require_once("../lib/lib.php");
require_once("../lib/db_admin_options.php");

$flags[] = FILTER_NULL_ON_FAILURE;

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);

$serverPort = $_SERVER['SERVER_PORT'];
;

$name = webAppName();

$cats = GetAllCats();

?>
<div id="up-cat">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-dark w-25" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                    Update Categories
                </button>
                <a class="fs-5 fa fa-caret-down"></a>
            </h5>
        </div>

        <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#up-cat">
            <div class="card-body">
                <div class="row">
                    <?php foreach ($cats as $cat) { ?>
                        <div class="col-4-md">
                            <form id="cat<?php echo $cat[0] ?>" method="POST">
                                <div class="row">
                                    <h5 class="text-center col-12">Category</h5>
                                    <div class="col-12 text-center mb-3">
                                        <input type="text" name="categoryName" value="<?php echo $cat[1] ?>" placeholder="Category's Name" required>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-12 text-center mb-3">
                                                <input type="submit" name="submitAction" value="Update" class="text-white btn btn-dark mb-1" />
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <input type="submit" name="submitAction" value="Delete" class="text-white btn btn-dark mb-1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Confirmation Modal -->
                            <div class="modal fade" id="confirmationModal<?php echo $cat[0] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel<?php echo $cat[0] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel<?php echo $cat[0] ?>">Confirm Action
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
                        <script>
                            // Submit the form based on the button clicked
                            document.getElementById("cat<?php echo $cat[0] ?>").addEventListener("submit", function(event) {
                                event.preventDefault(); // Prevent default form submission

                                var submitAction = event.submitter.value; // Get the value of the clicked button
                                var formData = new FormData();
                                var form = document.getElementById("cat<?php echo $cat[0] ?>");

                                // Retrieve form input values and append them to the FormData object
                                formData.append("submitAction", submitAction);
                                formData.append("idCat", <?php echo$cat[0]?>);
                                formData.append("categoryName", form.elements.categoryName.value);

                                // Show the confirmation modal
                                $('#confirmationModal<?php echo $cat[0] ?>').modal('show');

                                // Assign the submitForm function to the Confirm button
                                document.getElementById("confirmationModal<?php echo $cat[0] ?>").querySelector("button.btn-primary").onclick = function() {
                                    submitCategoryChange(submitAction, formData);
                                };
                            });
                        </script>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>