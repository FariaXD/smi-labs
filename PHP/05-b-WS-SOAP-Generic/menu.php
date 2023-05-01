<!DOCTYPE html>
<?php
require_once( "../Lib/lib.php" );

$name = webAppName();
?>

<html>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

    <title>Accessing Web Services using PHP</title>

    <link REL="stylesheet" TYPE="text/css" href="../Styles/GlobalStyle.css">
  </head>

  <body>
    <a target="content" href="<?php echo $name; ?>main.php">Main</a><br>
    <a target="content" href="<?php echo $name; ?>clientSoap.php">PHP SOAP Client</a><br>
    <a target="content" href="<?php echo $name; ?>links.php">Useful links</a><br>
    <br>
    <a target="_top" href="../">Back to Example Pages</a>
  </body>
</html>