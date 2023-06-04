<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
require_once("lib/db.php");
require_once("lib/db_upload_media.php");

$content = GetContentWithMostViews();
$idImg =  $content['idContent'];
$displayName = $content['displayName'];
$UrL = "http://" . $serverName . ":" . $serverPort;
$imgTrendingPath = $UrL . "/examples-smi/Projeto/media/$idImg" . ".jpg";
?>
<!--trending-->
<div class="col-md-10 bg-lightest-gray p-0">
    <div class="bg-dark w-100 trending-bg">
        <img src="<?php echo $imgTrendingPath ?>" alt="Image Description" class="img-fluid w-100 h-100">
        <img src="<?php echo $imgTrendingPath ?>" alt="Image Description" class="img-scale w-100 h-100 img-absolute">
        <a href="content/media.php?idContent=<?php echo $idImg ?>">
            <div class="img-filter w-100 h-100 img-absolute"></div>
        </a>
        <h3 class="text-white trending-text ml-5"><?php echo $displayName ?></h5>
    </div>
</div>