<?php
    require_once( "../../Lib/db.php" );
    
    dbConnect( ConfigFile );
                
    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db( $GLOBALS['ligacao'], $dataBaseName );

    $queryString = "SELECT `id`, `displayName` FROM `$dataBaseName`.`email-contacts`"; 
    $result = mysqli_query( $GLOBALS['ligacao'], $queryString );
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        <title>Manage e-mail contacts</title>
    
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link REL="stylesheet" TYPE="text/css" href="../../Styles/GlobalStyle.css">
        <link REL="stylesheet" TYPE="text/css" href="../../Styles/TableUsingDivs.css">
    </head>
  
    <body>
        <h2>Delete an existing e-mail contact</h2>
    
        <div align="center">
            <form action="processFormManageContactsDelete.php" method="post">
                <div class="rTableForm">
                    <div class="rTableRowForm">
                        <div class="rTableCellForm">Contact:</div>
                        <div class="rTableCellForm">
                            <select name="contactId" >
<?php
    if ( $result ) {
        while ( $record = mysqli_fetch_array( $result ) ) {
            $id          = $record[ 'id' ];
            $displayName = $record[ 'displayName' ];
            echo "\t\t\t\t\t\t\t<option value=\"$id\">$displayName</option>\n";
        }

        mysqli_free_result($result);
    }
    else {
        echo "\t\t\t\t\t\t\t<option value=\"-1\">No e-mail contacts available</option>\n";
    }
    dbDisconnect();
?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <p></p>
                <input type="submit" name="delete" value="Delete Contact">
            </form>
        </div>
        
        <hr>
        <p><a target="_top" href="./formManageContacts.php">Back.</a></p>
    </body>
</html>
