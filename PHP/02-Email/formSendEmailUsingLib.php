<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        <title>Send an e-mail using PHP SMTP library</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link REL="stylesheet" TYPE="text/css" href="../Styles/GlobalStyle.css">
        <link REL="stylesheet" TYPE="text/css" href="../Styles/TableUsingDivs.css">
        
        <link REL="stylesheet" TYPE="text/css" href="./Styles/forms.css">
    </head>

    <body>
        <h1>Send an e-mail with custom SMTP library</h1>

        <div align="center"><form 
                action="processFormSendEmailUsingLib.php" 
                method="post" >
            <div class="rTableForm">
                <div class="rTableRowForm">
                    <div class="rTableCellForm">Account:</div>
<?php
    require_once( "../Lib/db.php" );
                
    dbConnect( ConfigFile );
                
    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db( $GLOBALS['ligacao'], $dataBaseName );

    $queryString = "SELECT `id`,`accountName` FROM `$dataBaseName`.`email-accounts`";
?>
                    <div class="rTableCellForm">
                        <select name="Account" id="AccountID" size="1">
<?php
    $queryResult = mysqli_query( $GLOBALS['ligacao'], $queryString);
                
    if ( $queryResult ) {
        while ( $record = mysqli_fetch_array( $queryResult ) ) {
            $id = $record[ 'id' ];
            $accountName = $record['accountName'];
            echo "\t\t\t\t\t\t\t<option value=\"$id\">$accountName</option>\n";
        }
    }
    else {
        echo "\t\t\t\t\t\t\t<option value=\"-1\">No accounts available</option>\n";
    }
    mysqli_free_result($queryResult);
    
    dbDisconnect();
?>
                        </select>
                    </div>
                </div>
<?php
    include_once( "formEmail.inc" );
?>                
                <div class="rTableRowForm">
                    <div class="rTableCellForm">Send as HTML:</div>
                    <div class="rTableCellForm"><input type="checkbox" id="SendAsHTMLID" name="SendAsHTML"></div>
                </div>
                <div class="rTableRowForm">
                    <div class="rTableCellForm">Debug SMTP:</div>
                    <div class="rTableCellForm"><input type="checkbox" id="DebugID" name="Debug"></div>
                </div>
            </div>
            <div>
                <input type="submit" id="SendID" name="Send" value="Send E-mail"> <input type="reset" id="ResetID" name="Reset" value="Clear">
            </div>
            </form></div>

        <hr>
        <br><a href=".">Back</a>
    </body>
</html>
