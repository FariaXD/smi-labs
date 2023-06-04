<?php



$flags[] = FILTER_NULL_ON_FAILURE;

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);

$serverPort = 81;

$UrL = "http://" . $serverName . ":" . $serverPort;
$home = $UrL . "/examples-smi/Projeto/src";
$login = $UrL . "/examples-smi/Projeto/src/auth/loginForm.php";
$logout = $UrL . "/examples-smi/Projeto/src/auth/processLogout.php";
$register = $UrL . "/examples-smi/Projeto/src/auth/registerForm.php";
#$nextUrl = "http://" . $serverName . ":" . $serverPort . $name . "processFormLogin.php";

$idUser = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
if ($idUser == 0) {
    $_SESSION['roleName'] = "Guest";
    $_SESSION['id'] = 0;
    $_SESSION['username'] = "Guest";
}
?>
<div class="col-md-2 bg-light-gray min-vh-100 sidebar">
    <div class="d-flex flex-column h-100">
        <div class="">
            <a class="d-flex text-decoration-none mt-1 align-items-center justify-content-center text-white">
                <span class="fs-4">FunniMedia</span>
            </a>
            <ul class="nav nav-pills flex-column mt-4">
                <li class="nav-item">
                    <a href="<?php echo $home ?>" class="nav-link text-white">
                        <i class="fa-solid fa-home mr-2"></i><span class="fs-4 ms-3 d-none d-sm-inline">Home</span>
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
            <?php
            switch ($_SESSION['roleName']) {
                case "User":
                    include 'user.php';
                    break;
                case "Publisher":
                    include 'publisher.php';
                    break;
                case "Admin":
                    include 'admin.php';
                    break;
            }
            ?>
            <div class="white-line w-100 mt-3"></div> <!-- White line -->
            <img src="/examples-smi/Projeto/imgs/userplace.png" alt="User Image" class="center rounded-circle my-3" style="width: 100px; height: 100px;">
            <h5 class="text-white"><?php echo $_SESSION['username'] ?></h5>
            <div class="white-line w-100"></div> <!-- White line -->
            <p class="mt-3"><?php echo $_SESSION['roleName'] ?></p>
            <?php
            if ($_SESSION['id'] == 0) {
                echo '<a class="text-white btn btn-dark mb-1 w-75" href="' . $login . '">Login</a>';
                echo '<a class="text-white btn btn-dark mb-1 w-75" href="' . $register . '">Register</a>';
            } else {
                echo '<a class="text-white btn btn-dark mb-1 w-75" href="' . $logout . '">Logout</a>';
            }
            ?>
        </div>
    </div>
</div>