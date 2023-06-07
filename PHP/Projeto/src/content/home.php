<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
require_once("lib/db.php");
require_once("lib/db_upload_media.php");

$content = GetContentWithMostViews();
$idImg =  $content['idContent'];
$displayName = $content['displayName'];
$url = "http://" . $serverName . ":" . $serverPort;
$imgTrendingPath = $url . "/examples-smi/Projeto/media/$idImg" . ".jpg";
$recommended = GetRandomContent(10);
?>
<!--trending-->
<div class="col-md-10 bg-lightest-gray overflow-auto p-0 vh-100">
    <div class="bg-dark trending-bg">
        <img src="<?php echo $imgTrendingPath ?>" alt="Image Description" class="img-scale w-100 h-100">
        <a href="content/media.php?idContent=<?php echo $idImg ?>">
            <div class="img-filter w-100 h-100 img-absolute">
            </div>
        </a>
        <h3 class="text-white trending-text ml-5"><?php echo $displayName ?></h5>
        <div class="row mx-0 mt-3">
            <h3 class="col-12">Recommended</h3>
            <?php foreach ($recommended as $cont) {
                $idContent = $cont[0];
                $thumbnail = $url . "/examples-smi/Projeto/media/$cont[0]" . ".jpg";
            ?>
                <div class="col-md-2 mx-3">
                    <a href="content/media.php?idContent=<?php echo $cont[0] ?>"><img src="<?php echo $thumbnail ?>" alt="Image Description" class="rounded w-100 ratio-1x1"></a>
                    <p class="text-truncate"></h3><?php echo $cont[1] ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>