<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("../lib/db.php");
require_once("../lib/lib.php");

$flags[] = FILTER_NULL_ON_FAILURE;

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);

$serverPort = $_SERVER['SERVER_PORT'];
;

$name = webAppName();

$nextUrl = "http://" . $serverName . ":" . $serverPort . "/examples-smi/Projeto/src/admin/processAddCategory.php";
?>
<div id="add-cat">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-dark w-25" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                    Add Category
                </button>
                <a class="fs-5 fa fa-caret-down"></a>
            </h5>
        </div>

        <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#add-cat">
            <div class="card-body">
                <form id="add_category" method="POST" action="<?php echo $nextUrl ?>">
                    <div class="row d-flex align-items-center">
                        <h3 class="col-12 text-dark text-center">New Category</h3>
                        <div class="col-12 text-center mb-2">
                            <input type="text" name="categoryName" pattern="^[a-zA-Z]+$" placeholder="Type the category name" required />
                        </div>
                        <div class="col-12 text-center">
                            <input type="submit" name="submitAction" value="Add Category" class="text-white btn btn-dark mb-1" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>