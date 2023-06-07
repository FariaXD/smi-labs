<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
session_start();
require_once("../lib/db.php");
require_once("../lib/lib.php");
require_once("../lib/db_upload_media.php");

$flags[] = FILTER_NULL_ON_FAILURE;
$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_UNSAFE_RAW, $flags);
$serverPort = $_SERVER['SERVER_PORT'];
$url = "http://" . $serverName . ":" . $serverPort;
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
            <div id="accordion" class="col-md-10 bg-lightest-gray overflow-auto">
                <h4>Categories</h4>
                <?php foreach ($cats as $cat) {
                    $contentCat = GetContentWithCat(5, $cat[0], false, 0);
                ?>
                    <a href="category.php?category=<?php echo $cat[0] ?>&catName=<?php echo $cat[1] ?>">
                        <h3 class="link-dark"><?php echo $cat[1] ?> (For more)</h3>
                    </a>
                    <div class="row">
                        <?php foreach ($contentCat as $cont) {
                            $idContent = $cont[0];
                            $thumbnail = $url . "/examples-smi/Projeto/media/$cont[0]" . ".jpg";

                        ?>
                            <div class="col-md-2">
                                <h3 class="text-truncate"><?php echo $cont[1] ?></h3>
                                <a href="media.php?idContent=<?php echo $cont[0] ?>"><img src="<?php echo $thumbnail ?>" alt="Image Description" class="rounded" style="height: 20vh;width: 20vh;"></a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include '../lib/dependenciesScripts.php' ?>
</body>