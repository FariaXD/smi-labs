<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $_INPUT_METHOD = INPUT_POST;
} else {
  $_INPUT_METHOD = INPUT_GET;
}

$flags[] = FILTER_NULL_ON_FAILURE;

$wsdl = filter_input($_INPUT_METHOD, 'wsdl', FILTER_SANITIZE_URL, $flags);
$bookName = filter_input($_INPUT_METHOD, 'bookName', FILTER_SANITIZE_STRING, $flags);

if ($wsdl === null || $bookName === null) {
  exit();
}

class PhpBook {

  public $_isbn;
  public $_title;
  public $_quantity;
  public $_price;

}

$options = array(
    'classmap' => array('book ' => 'PhpBook'),
    'cache_wsdl' => WSDL_CACHE_NONE,
);

$args = array('title' => $bookName);

try {
  $bookProxy = new SoapClient($wsdl, $options);
  $resultAsObject = $bookProxy->getBookByTitle($args);
} catch (SoapFault $e) {
  echo "Could not execute WS. Cause:<br>\n";
  echo $e->faultstring . "<br>\n";
  echo $e->getTraceAsString() . "<br>\n";
  exit;
}

$myBook = $resultAsObject->return;

echo json_encode($myBook);
?>
