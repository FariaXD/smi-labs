<!DOCTYPE html>
<html>
<?php
    require_once( "../Lib/lib.php" );

    $name = webAppName();
?>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        <title>Image Processing</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link rel="stylesheet" typr="text/css" href="../Styles/GlobalStyle.css">
    </head>

    <body>
        <a target="content" href="<?php echo $name ?>main.php">Home</a><br>
        <a target="content" href="<?php echo $name ?>formUpload.php">Upload File</a><br>
        <a target="content" href="<?php echo $name ?>list.php">List Files</a><br>
        <a target="content" href="<?php echo $name ?>stats.php">Show Statistics</a><br>
        <a target="content" href="<?php echo $name ?>captcha.php">Generate captcha</a><br>
        <a target="content" href="<?php echo $name ?>links.php">Useful Links</a><br>
        <a target="content" href="<?php echo $name ?>static/jwplayer.php">JWPlayer6 Play Video Demo</a><br>
        <a target="content" href="<?php echo $name ?>static/html5.php">HTML 5 Play Video Demo</a><br>
        <a target="_blank" href="https://html5test.com/">Test HTML 5 Browser Capabilities</a><br>
        <br>
        <a target="_top" href="../">Back to Examples Pages</a>
    </body>
</html>
