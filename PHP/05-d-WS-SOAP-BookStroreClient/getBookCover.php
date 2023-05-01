<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $_INPUT_METHOD = INPUT_POST;
} else {
  $_INPUT_METHOD = INPUT_GET;
}

$flags[] = FILTER_NULL_ON_FAILURE;

$wsdl = filter_input($_INPUT_METHOD, 'wsdl', FILTER_SANITIZE_URL, $flags);
$bookISBN = filter_input($_INPUT_METHOD, 'bookISBN', FILTER_SANITIZE_STRING, $flags);
$flags[] = FILTER_NULL_ON_FAILURE;

if ($wsdl === null || $bookISBN === null) {
  exit();
}

$options = array(
    'cache_wsdl' => WSDL_CACHE_NONE,
);

$args = array('title' => $bookISBN);

try {
  $bookProxy = new SoapClient($wsdl, $options);
  $resultAsObject = $bookProxy->getBookCover($args);
} catch (SoapFault $e) {
  echo "Could not execute WS. Cause:<br>\n";
  echo $e->faultstring . "<br>\n";
  echo $e->getTraceAsString() . "<br>\n";
  exit;
}

echo base64_encode($resultAsObject->return);
?>
