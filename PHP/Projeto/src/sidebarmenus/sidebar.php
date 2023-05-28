<?php include 'lib/dependenciesLinks.php.php' ?>
<div class="col-md-2 bg-light-gray min-vh-100">
    <div class="d-flex flex-column h-100">
        <div class="">
            <a class="d-flex text-decoration-none mt-1 align-items-center justify-content-center text-white">
                <span class="fs-4">FunniMedia</span>
            </a>
            <ul class="nav nav-pills flex-column mt-4">
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
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
            <button class="btn btn-dark mb-1 w-75">Adminstrator</button>
            <button class="btn btn-dark mb-1 w-75">Your Content</button>
            <button class="btn btn-dark mb-1 w-75">Publish</button>
            <button class="btn btn-dark mb-1 w-75">Settings</button>
            <div class="white-line w-100 mt-3"></div> <!-- White line -->
            <img src="../imgs/userplace.png" alt="User Image" class="center rounded-circle my-3" style="width: 100px; height: 100px;">
            <h5 class="text-white">User Name</h5>
            <div class="white-line w-100"></div> <!-- White line -->
            <p class="mt-3">Admin</p>
            <button class="btn btn-dark mb-1 w-75">Login</button>
            <button class="btn btn-dark mb-1 w-75">Register</button>
        </div>
    </div>
</div>
<?php include 'lib/dependenciesScripts.php' ?>