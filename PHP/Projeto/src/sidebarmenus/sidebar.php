<?php

$flags[] = FILTER_NULL_ON_FAILURE;

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);

$serverPort = 81;

$name = webAppName();

$UrL = "http://" . $serverName . ":" . $serverPort;
$home = $UrL . "/examples-smi/Projeto/src";
$login = $UrL . "/examples-smi/Projeto/src/auth/loginForm.php";
$register = $UrL . "/examples-smi/Projeto/src/auth/registerForm.php";
#$nextUrl = "http://" . $serverName . ":" . $serverPort . $name . "processFormLogin.php";
?>
<div class="col-md-2 bg-light-gray min-vh-100">
    <div class="d-flex flex-column h-100">
        <div class="">
            <a class="d-flex text-decoration-none mt-1 align-items-center justify-content-center text-white">
                <span class="fs-4">FunniMedia</span>
            </a>
            <ul class="nav nav-pills flex-column mt-4">
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="fa-solid fa-home mr-2"></i><span class="fs-4 ms-3 d-none d-sm-inline" href="<?php echo $home ?>">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <i class="fs-5 fa fa-list mr-2"></i><span class="fs-4 ms-3 d-none d-sm-inline">Categories</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="mt-auto p-3 align-items-center d-flex flex-column">
            <a class="text-white btn btn-dark mb-1 w-75">Adminstrator</a>
            <a class="text-white btn btn-dark mb-1 w-75">Your Content</a>
            <a class="text-white btn btn-dark mb-1 w-75">Publish</a>
            <a class="text-white btn btn-dark mb-1 w-75">Settings</a>
            <div class="white-line w-100 mt-3"></div> <!-- White line -->
            <img src="/examples-smi/Projeto/imgs/userplace.png" alt="User Image" class="center rounded-circle my-3" style="width: 100px; height: 100px;">
            <h5 class="text-white">User Name</h5>
            <div class="white-line w-100"></div> <!-- White line -->
            <p class="mt-3">Admin</p>
            <a class="text-white btn btn-dark mb-1 w-75" href="<?php echo $login ?>">Login</a>
            <a class="text-white btn btn-dark mb-1 w-75" href="<?php echo $register ?>">Register</a>
        </div>
    </div>
</div>