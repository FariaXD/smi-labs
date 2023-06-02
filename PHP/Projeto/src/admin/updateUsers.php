<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("../lib/db.php");
require_once("../lib/lib.php");
require_once("../lib/db_admin_options.php");

//idUser, username, email, roleName, idRole
$users = GetAllUsers();
?>

<script src="/examples-smi/Projeto/src/admin/js/formSubmission.js"></script>
<div id="user-update">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-dark w-25" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    Users
                </button>
                <a class="fs-5 fa fa-caret-down"></a>
            </h5>
        </div>
        <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#user-update">
            <div class="card-body">
                <?php
                foreach ($users as $user) {
                ?>
                    <!--User Row-->
                    <form id="user<?php echo $user[0] ?>" method="POST">
                        <div class="row bg-light">
                            <h3 class="col-12 text-dark text-center">User</h3>

                            <!--Image Col-->
                            <div class="col-md-3">
                                <div class="row">
                                    <!--Image-->
                                    <div class="col-md-12 text-center">
                                        <img src="/examples-smi/Projeto/imgs/userplace.png" alt="User Image" class="center rounded-circle my-3" style="width: 75px; height: 75px;">
                                    </div>
                                    <!--Button-->
                                    <div class="col-md-12 text-center">
                                        <a class="text-white btn btn-dark mb-1">Remove</a>
                                    </div>
                                </div>
                            </div>
                            <!--Username-->
                            <div class="col-md-2 text-center align-items-center d-flex">
                                <input type="text" name="username" value="<?php echo $user[1] ?>" placeholder="User's Username" required>
                            </div>
                            <!--Email-->
                            <div class="col-md-2 text-center align-items-center d-flex">
                                <input type="email" name="email" value="<?php echo $user[2] ?>" placeholder="User's Email" required>
                            </div>
                            <!--User Permission-->
                            <div class="col-md-3 text-center align-items-center d-flex">
                                <select name="roleName" class="form-select w-100" aria-label="Default select example">
                                    <option value="Admin" <?php echo ($user[3] == 'Admin') ? 'selected' : ''; ?>>Admin
                                    </option>
                                    <option value="Publisher" <?php echo ($user[3] == 'Publisher') ? 'selected' : ''; ?>>
                                        Publisher</option>
                                    <option value="User" <?php echo ($user[3] == 'User') ? 'selected' : ''; ?>>User</option>
                                </select>
                            </div>
                            <div class="col-md-2  d-flex align-items-center">
                                <div class="row">
                                    <div class="col-md-12 text-center">
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
                    <div class="modal fade" id="confirmationModal<?php echo $user[0] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel<?php echo $user[0] ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmationModalLabel<?php echo $user[0] ?>">Confirm Action
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
                    <!--UPDATE OR DELETE USER HANDLER VIA AJAX-->
                    <script>
                        // Submit the form based on the button clicked
                        document.getElementById("user<?php echo $user[0]?>").addEventListener("submit", function(event) {
                            event.preventDefault(); // Prevent default form submission

                            var submitAction = event.submitter.value; // Get the value of the clicked button
                            var formData = new FormData();
                            var form = document.getElementById("user<?php echo $user[0] ?>");

                            // Retrieve form input values and append them to the FormData object
                            formData.append("submitAction", submitAction);
                            formData.append("username", form.elements.username.value);
                            formData.append("email", form.elements.email.value);
                            formData.append("roleName", form.elements.roleName.value);
                            // Show the confirmation modal
                            $('#confirmationModal<?php echo $user[0] ?>').modal('show');

                            // Assign the submitForm function to the Confirm button
                            document.getElementById("confirmationModal<?php echo $user[0] ?>").querySelector("button.btn-primary").onclick = function() {
                                submitForm(<?php echo $user[0] ?>, submitAction, formData);
                            };
                        });
                    </script>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>