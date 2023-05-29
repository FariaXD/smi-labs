<!DOCTYPE html>
<html>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <title>Email Confirmation</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" typr="text/css" href="../../Styles/GlobalStyle.css">
    <?php include '../lib/dependenciesLinks.php' ?>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include '../sidebarmenus/sidebar.php' ?>
            <div class="col-md-10 bg-lightest-gray">
                <div class="row mb-5">
                    <h1>PHP - Email Confirmation Sent</h1>
                    <p align="center">Please go to email and authenticate. If email has been authenticated please:</p>
                    <p align="center"><a href="formLogin.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>