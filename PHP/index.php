<html>

  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <title>SMI 2022-2023</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link REL="stylesheet" TYPE="text/css" href="./Styles/GlobalStyle.css">
  </head>
  
  <body onload="window.open('', '_self', '');">
    <h1 align="center">SMI-LEIM-ADEETC Examples Main Page</h1>
    <h2 align="center">Summer Semester 2022/2023</h2>
    
    <h3>HTTP Protocol</h3>
      <a href="Requests-MainPage.txt" target="_blank">HTTP commands to get "index.php" page</a><br>
      <a href="Requests-StylePage.txt" target="_blank">HTTP commands to get "Styles/GlobalStyle.css" page (refered on "index.php" page)</a><br>
    
    
    <h3>Available Examples</h3>
<?php 
  $files = array();
?>

<?php
  if ( $handle=opendir( "." ) ) {
    while ( false !== ( $entry = readdir( $handle ) ) ) {
      if ( 
          $entry=="." || 
          $entry==".." || 
          $entry=="index.php" || 
          $entry=="index.html" || 
          $entry=="Lib" || 
          $entry=="Styles" || 
          $entry=="Config" ||
		      $entry=="bin" ||
		      $entry=="java" ||
          $entry==".DS_STORE" ||
          preg_match('/zip$/i', $entry) ||
          preg_match('/txt$/i', $entry) 
          ) {
        continue;
      }
      
      $files[] = $entry;
    }
    closedir( $handle );
	
	natsort( $files );
	
	foreach( $files as $file ) {
		echo "    <a href=\"$file\">$file</a><br>\r\n";
	}
	
  }
?>
    
    <br>
    
    <a href="javascript:window.close();">Close Page</a>

  </body>
  
</html>
