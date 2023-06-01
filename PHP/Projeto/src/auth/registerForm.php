<html lang="en">
<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once("../Lib/lib.php");

$flags[] = FILTER_NULL_ON_FAILURE;

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);

$serverPort = 81;

$name = webAppName();

$nextUrl = "http://" . $serverName . ":" . $serverPort . "/examples-smi/Projeto/src/auth/processRegisterForm.php";

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <?php include '../lib/dependenciesLinks.php' ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include '../sidebarmenus/sidebar.php' ?>
            <div class="col-md-10 bg-lightest-gray">
                <div class="row my-5 ml-5">
                    <h3 class="col-12">Register</h3>
                    <div class="formRegister d-flex justify-content-center">
                        <form class="text-center" action="<?php echo $nextUrl ?>" method="POST" onsubmit="return validateRegister(this)">
                            <table>
                                <tr>
                                    <td class="px-3">Username</td>
                                    <td><input value="AAAAAA" id="username" class="" type="text" name="username" placeholder="Type your name" required></td>
                                </tr>
                                <tr>
                                    <td class="px-3">Email</td>
                                    <td><input value="fariafactor2@gmail.com" id="email" class="" type="email" name="email" placeholder="Type your email" required></td>
                                </tr>
                                <tr>
                                    <td class="px-3">Confirm Email</td>
                                    <td><input value="fariafactor2@gmail.com" id="cemail" class="" type="email" name="cemail" placeholder="Confirm your email" required></td>
                                </tr>
                                <tr>
                                    <td class="px-3">Password</td>
                                    <td><input value="amongus123" id="password" class="" type="password" name="password" placeholder="Type your password" required></td>
                                </tr>
                                <tr>
                                    <td class="px-3">Confirm password</td>
                                    <td><input value="amongus123" id="cpassword" class="" type="password" name="cpassword" placeholder="Confirm your password" required></td>
                                </tr>
                                <tr>
                                    <td class="px-3">Captcha</td>
                                    <td>
                                        <div class="g-recaptcha" data-sitekey="6Lf9EE4mAAAAAJhyoKSUEtoSAlHq_1lAAM8wcS-o">
                                    </td>
                                </tr>
                            </table>
                            <div class="col-12 my-3">
                                <input class="text-white btn btn-dark mr-2" type="submit" value="Register">
                                <input class="text-white btn btn-dark ml-2" type="reset" value="Clear">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/examples-smi/Projeto/src/auth/js/auth.js"></script>
    <?php include '../lib/dependenciesScripts.php' ?>
</body>

</html>