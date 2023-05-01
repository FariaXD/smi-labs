<?php
    require_once( "../Lib/lib.php" );

    $name = webAppName();
?>

Version 1 - HTTP Basic<br>
&nbsp;&nbsp;&nbsp;<a target="content" href="<?php echo $name ?>Ver1/">Pages</a><br>
&nbsp;&nbsp;&nbsp;<a target="content" href="<?php echo $name ?>Ver1/files/">Files</a><br>
<br>

Version 2 - HTTP Digest<br>
&nbsp;&nbsp;&nbsp;<a target="content" href="<?php echo $name ?>Ver2/">Pages</a><br>
&nbsp;&nbsp;&nbsp;<a target="content" href="<?php echo $name ?>Ver2/files/">Files</a><br>
<br>

Version 3 - PHP Sessions<br>
&nbsp;&nbsp;&nbsp;<a target="_blank" href="<?php echo $name ?>Ver3/">Pages</a><br>
&nbsp;&nbsp;&nbsp;<a target="content" href="<?php echo $name ?>Ver3/files/">Files</a><br>
<br>

<a target="content" href="<?php echo $name ?>links.php">Useful links</a><br>
<br>
<a target="_top" href="./">Back to Authentication Examples</a>
