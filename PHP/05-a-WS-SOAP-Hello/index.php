<?php
header('Cache-Control: no-cache');

$schema = "http";
$host = "localhost";
$port = 8080;
$webApp = "/ServiceHello-SOAP-Tomcat-1.0.0/";
$serviceName = "serviceHello?WSDL";

$wsdl = $schema . "://" . $host . ":" . $port . $webApp . $serviceName;
?>

<h1>PHP Web Service (SOAP) Client</h1>
<h2>Service location: <?php echo $wsdl; ?></h2>
<?php
try {
  $proxy = new SoapClient($wsdl, array("cache_wsdl" => WSDL_CACHE_NONE));

  $parameterSayHello = array(
      "user" => "SMI rocks - Browser access"
  );

  $resultSayHello = $proxy->sayHello($parameterSayHello);

  echo "<pre>";
  print_r($resultSayHello);
  echo "</pre>\n<br>";

  echo "Result: <b><i>" . $resultSayHello->return . "</i></b>\n<br>";
} catch (SoapFault $e) {
  echo "Could not execute WS. Cause:<br>\n";
  echo $e->faultstring . "<br>\n";
  echo $e->getTraceAsString() . "<br>\n";
}
?>
