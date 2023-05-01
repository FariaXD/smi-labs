<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        <title>Image Processing</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link rel="stylesheet" typr="text/css" href="../Styles/GlobalStyle.css">
    </head>

    <body>
<?php

session_start();

header( 'Content-Type: text/html; charset=utf-8' );

if ($_SESSION['captcha'] == $_POST['captcha']) {
    echo "<h1>Ok - Code is correct</h1>";
}
else {
    echo "<h1>Error - Code is incorrect</h1>";
}
?>

    </body>
</html>