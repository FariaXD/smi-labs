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
<div class="col-md-10 bg-lightest-gray p-0 overflow-auto">
    <div class="bg-dark w-100 trending-bg">
        <img src="<?php echo $imgTrendingPath ?>" alt="Image Description" class="img-scale w-100 h-100">
        <a href="content/media.php?idContent=<?php echo $idImg ?>">
            <div class="img-filter w-100 h-100 img-absolute">
            </div>
        </a>
        <h3 class="text-white trending-text ml-5"><?php echo $displayName ?></h5>
        <div class="row p-0 ml-3 mt-3">
            <h3 class="col-12">Recommended</h3>
            <div class="row">
                <?php foreach ($recommended as $cont) {
                    $idContent = $cont[0];
                    $thumbnail = $url . "/examples-smi/Projeto/media/$cont[0]" . ".jpg";
                ?>
                    <div class="col-md-2 mx-3">
                        <a href="content/media.php?idContent=<?php echo $cont[0] ?>"><img src="<?php echo $thumbnail ?>" alt="Image Description" class="rounded" style="height: 20vh;width: 20vh;"></a>
                        <p class="text-truncate"></h3><?php echo $cont[1] ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>