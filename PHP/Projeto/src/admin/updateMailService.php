<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("../lib/db.php");
require_once("../lib/lib.php");
require_once("../lib/db_admin_options.php");

//idUser, username, email, roleName, idRole
$getEmailService = GetEmailService()[0];
?>

<div id="updateMail">
    <div class="card">
        <div class="card-header" id="heading4">
            <h5 class="mb-0">
                <button class="btn btn-dark w-25" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                    Update Email Service
                </button>
                <a class="fs-5 fa fa-caret-down"></a>
            </h5>
        </div>

        <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#add-cat">
            <div class="card-body">
                <form id="upd-mail" method="POST">
                    <div class="row d-flex align-items-center">
                        <h3 class="col-12 text-dark text-center mb-3">Mail Service</h3>
                        <div class="col-2 text-center">
                            <label for="acc_name" class="control-label">Account Name</label>
                            <input class="w-100" type="text" name="acc_name" placeholder="Type the category name" value="<?php echo $getEmailService[0] ?>" required />
                        </div>
                        <div class="col-2 text-center">
                            <label for="login_name" class="control-label">Login Name</label>
                            <input class="w-100" type="text" name="login_name" placeholder="Type the category name" value="<?php echo $getEmailService[1] ?>" required />
                        </div>
                        <div class="col-2 text-center">
                            <label for="password" class="control-label">Password</label>
                            <input class="w-100" type="password" name="password" placeholder="Type the category name" value="<?php echo $getEmailService[2] ?>" required />
                        </div>
                        <div class="col-2 text-center">
                            <label for="email" class="control-label">Email</label>
                            <input class="w-100" type="email" name="email" placeholder="Type the category name" value="<?php echo $getEmailService[3] ?>" required />
                        </div>
                        <div class="col-4 text-center">
                            <label for="disp_name" class="control-label">Display Name</label>
                            <input class="w-100" type="text" name="disp_name" placeholder="Type the category name" value="<?php echo $getEmailService[4] ?>" required />
                        </div>
                        <div class="col-12 text-center mt-3">
                            <input type="submit" name="submitAction" value="Update" class="text-white btn btn-dark mb-1" />
                        </div>
                    </div>
                </form>
                <!-- Confirmation Modal -->
                <div class="modal fade" id="confirmationModalMail" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabelMail" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmationModalLabelMail">Confirm Action
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to update the Mail Service?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--UPDATE MAIL VIA AJAX-->
                <script>
                    // Submit the form based on the button clicked
                    document.getElementById("upd-mail").addEventListener("submit", function(event) {
                        event.preventDefault(); // Prevent default form submission

                        var submitAction = event.submitter.value; // Get the value of the clicked button
                        var formData = new FormData();
                        var form = document.getElementById("upd-mail");

                        // Retrieve form input values and append them to the FormData object

                        formData.append("acc_name", form.elements.acc_name.value);
                        formData.append("login_name", form.elements.login_name.value);
                        formData.append("password", form.elements.password.value);
                        formData.append("email", form.elements.email.value);
                        formData.append("disp_name", form.elements.disp_name.value);
                        // Show the confirmation modal
                        $('#confirmationModalMail').modal('show');

                        // Assign the submitForm function to the Confirm button
                        document.getElementById("confirmationModalMail").querySelector("button.btn-primary").onclick = function() {
                            SubmitFormData("processUpdateMailService.php", formData);
                        };
                    });
                </script>
            </div>
        </div>
    </div>
</div>