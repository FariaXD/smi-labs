<!DOCTYPE html>
  <?php
  header( 'Cache-Control: no-cache' );

  $schema = "http";
  $host = "localhost";
  $port = 8080;
  $webApp = "/ServiceCompositeCalculator-SOAP-Tomcat-1.0.0/";
  $serviceName = "serviceCalculatorComposite?WSDL";
  
  $wsdl = $schema . "://" . $host . ":" . $port . $webApp . $serviceName;
?>

<h1>PHP Composite Calculator (SOAP Web Service) client</h1>
<h2>Service location: <?php echo $wsdl; ?></h2>
<?php
  try {
    require_once( "PhpComplexNumber.php" );
    
    $argDouble1 = "3.456";
    $argDouble2 = "1.397";
    
    $argComplex1 = new PhpComplexNumber();
    $argComplex2 = new PhpComplexNumber();

    $options = array( 
        "cache_wsdl" => WSDL_CACHE_NONE,
        'classmap' => array( 'complexNumber' => 'PhpComplexNumber' )
    );
    
    $proxy = new SoapClient( $wsdl, $options);

    // ------------------------------------------------
    $types = $proxy->__getTypes();
    echo "\n<hr>Available types/structs:\n<br>";
    foreach ($types as $key => $value) {
      echo "$key: $value<br>\n";
    }
    
    // ------------------------------------------------ 
    $functions = $proxy->__getFunctions();
    echo "\n<hr>Available functions/methods:\n<br>";
    foreach ($functions as $key => $value) {
      echo "$key: $value<br>\n";
    }
    
    // ------------------------------------------------ 
    echo "\n<hr>Invoking Composite Calculator Operations:\n<br>";
    
    $argumentsDouble = array( "d1" => $argDouble1, "d2" => $argDouble2 );
    
    $resultAddDoubleComposite = $proxy->addDoubleComposite( $argumentsDouble );
    printf( "%5.3f + %5.3f = %5.3f", $argDouble1, $argDouble2, $resultAddDoubleComposite->return );
    echo "\n<br \>";
    
    $resultSubDoubleComposite = $proxy->subDoubleComposite( $argumentsDouble );
    printf( "%5.3f - %5.3f = %5.3f", $argDouble1, $argDouble2, $resultSubDoubleComposite->return );
    echo "\n<br \>";
    
    $resultMulDoubleComposite = $proxy->mulDoubleComposite( $argumentsDouble );
    printf( "%5.3f * %5.3f = %5.3f", $argDouble1, $argDouble2, $resultMulDoubleComposite->return );
    echo "\n<br \>";
    
    $resultDivDoubleComposite = $proxy->divDoubleComposite( $argumentsDouble );
    printf( "%5.3f / %5.3f = %5.3f", $argDouble1, $argDouble2, $resultDivDoubleComposite->return );
    echo "\n<br \>";
    
    $argComplex1->real = $resultAddDoubleComposite->return;
    $argComplex1->imaginary = $resultSubDoubleComposite->return;
    
    $argComplex2->real = $resultMulDoubleComposite->return;
    $argComplex2->imaginary = $resultDivDoubleComposite->return;
    
    
    $argumentsComplex = array( "c1" => $argComplex1, "c2" => $argComplex2 );
    
    $resultAddComplexComposite = $proxy->addComplexComposite( $argumentsComplex );
    printf( 
            "%s + %s = %s", 
            $proxy->format( array( "c1" => $argComplex1 ) )->return, 
            $proxy->format( array( "c1" => $argComplex2 ) )->return, 
            $proxy->format( array( "c1" => $resultAddComplexComposite->return ) )->return
    );
    echo "\n<br \>";
    
    $resultSubComplexComposite = $proxy->subComplexComposite( $argumentsComplex );
    printf( 
            "%s - %s = %s", 
            $proxy->format( array( "c1" => $argComplex1 ) )->return, 
            $proxy->format( array( "c1" => $argComplex2 ) )->return, 
            $proxy->format( array( "c1" => $resultSubComplexComposite->return ) )->return
    );
    echo "\n<br \>";
  }
  catch (SoapFault $e) {
    echo "Could not execute WS. Cause:<br>\n";
    echo $e->faultstring . "<br>\n";
    echo $e->getTraceAsString() . "<br>\n";
  }  
?>
