<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        <title>Send an e-mail using PHP mail function</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link REL="stylesheet" TYPE="text/css" href="../Styles/GlobalStyle.css">
        <link REL="stylesheet" TYPE="text/css" href="../Styles/TableUsingDivs.css">
        
        <link REL="stylesheet" TYPE="text/css" href="./Styles/forms.css">
    </head>

    <body>
        <h1>Send an e-mail using PHP <code>mail()</code> function</h1>

        <div align="center">
            <form 
                    action="processFormSendEmail.php" 
                    method="post" >
                <div class="rTableForm">
<?php
    include_once( "formEmail.inc" );
?>
                </div>
                <div>
                    <input type="submit" id="SendID" name="Send" value="Send E-mail"> <input type="reset" id="ResetID" name="Reset" value="Clear">
                </div>
            </form>
        </div>

        <hr>
        <br><a href=".">Back</a>
    </body>
</html>
