<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <title>Accessing Web Services using PHP - Calc Process</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <script type="text/javascript" src="scripts/forms.js">
    </script>

    <link REL="stylesheet" TYPE="text/css" href="../Styles/GlobalStyle.css">
  </head>

  <body>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_INPUT_METHOD = INPUT_POST;
    } else {
      $_INPUT_METHOD = INPUT_GET;
    }

    $flags[] = FILTER_NULL_ON_FAILURE;

    $wsdl = filter_input($_INPUT_METHOD, 'wsdl', FILTER_SANITIZE_URL, $flags);

    if ($wsdl === null) {
      echo "Invalid arguments.";
      echo "<br><hr><a href=\"javascript: history.go(-1)\">Back</a>";
      exit();
    }

    if (!filter_var($wsdl, FILTER_VALIDATE_URL)) {
      echo "Invalid WSDL format.";
      echo "<br><hr><a href=\"javascript: history.go(-1)\">Back</a>";
      exit();
    }

    $options = array(
        'cache_wsdl' => WSDL_CACHE_NONE,
    );

    try {
      $bookProxy = new SoapClient($wsdl, $options);
      $resultAsObject = $bookProxy->getBookTitles();
    } catch (SoapFault $e) {
      echo "Could not execute WS. Cause:<br>\n";
      echo $e->faultstring . "<br>\n";
      echo $e->getTraceAsString() . "<br>\n";
      exit;
    }

    $bookList = $resultAsObject->return;
    $numberOfBooks = count($bookList);
    ?>

    <input type="hidden" name="wsdl" value="<?php echo $wsdl; ?>">

    <select 
      name="bookList" 
      size="<?php echo $numberOfBooks; ?>"
      onchange="BookSelected(this)" >
        <?php
        foreach ($bookList as $currentBookName) {
          echo "      <option value=\"$currentBookName\">$currentBookName</option>\n";
        }
        ?>
    </select>

    <table align="center" border ="1">
      <tr>
        <td>
          <p>ISBN:</p>
          <div id="isbn"></div>

          <p>Price:</p>
          <div id="price"></div>

          <p>Quantity:</p>
          <div id="quantity"></div>          
        </td>
        <td>
          <img id="image" alt="Book cover" height="250"> 
        </td>
      </tr>
    </table>

    <br><hr><a href="javascript: history.go(-1)">Back</a>

  </body>
</html>