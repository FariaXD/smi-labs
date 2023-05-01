<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <title>Accessing Web Services using PHP - Generic Client</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <script type="text/javascript" src="scripts/forms.js">
    </script>

    <link REL="stylesheet" TYPE="text/css" href="../Styles/GlobalStyle.css"> 
  </head>

  <body onload="init()">
    <?php
    $services = simplexml_load_file("services.xml");

    $description = $services->Description;
    $locations = $services->Locations[0];

    $numLocations = count($locations);

    echo "Available locations for <i>" . $description . "</i>";
    ?>
    <form action="processClientSoap.php" method="POST">
      <table>
        <tr>
          <td>
            <select size="1" name="wsdls" id="wsdls" onchange="selectChanged('wsdls', 'wsdl')">
              <?php
              $idxLocation = 1;
              foreach ($locations as $currentlocation) {
                if ($idxLocation != $numLocations) {
                  echo "<option value=\"$currentlocation\">$currentlocation</option>\n";
                } else {
                  echo "<option selected value=\"$currentlocation\">$currentlocation</option>\n";
                }
                ++$idxLocation;
              }
              ?>
            </select>
          </td>
        </tr>

        <tr>
          <td>
            <input type="text" size="100" value="" name="wsdl" id="wsdl">
          </td>
        </tr>

      </table>

      <input type="submit" value="Create Proxy">
    </form>
  </body>
</html>
