<?php
    require_once( "../Lib/lib.php");
    require_once( "../Lib/lib-mail-v2.php" );

    $flags[] = FILTER_NULL_ON_FAILURE;
    
    $method = filter_input( INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING, $flags);
    $referer = filter_input( INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_STRING, $flags);
    
    if ( $referer==NULL ) {
        redirectToLastPage( "Invalid data", 5, "HTTP REFERER is missing" );
    }

    if ( $method=='POST') {
        $_INPUT_METHOD = INPUT_POST;
    } elseif ( $method=='GET' ) {
        $_INPUT_METHOD = INPUT_GET;
    }
    else {
        redirectToLastPage( "Invalid data", 5, "Invalid HTTP method (" . $method . ")" );
    }
    
    $ToName = filter_input( $_INPUT_METHOD, 'ToName', FILTER_SANITIZE_STRING, $flags);
    $ToEmail = filter_input( $_INPUT_METHOD, 'ToEmail', FILTER_SANITIZE_EMAIL, $flags);
    $Subject = filter_input( $_INPUT_METHOD, 'Subject', FILTER_SANITIZE_STRING, $flags);
    $Message = filter_input( $_INPUT_METHOD, 'Message', FILTER_SANITIZE_STRING, $flags);

    if ( $ToName == NULL || $ToEmail == NULL || $Subject == NULL || $Message == NULL) {
        redirectToLastPage( "Invalid fields" );
    }
    
    $newLine = "\r\n";
    
    $senderEmail = "smi.isel.1516@gmail.com";
    $senderName = "Sistemas Multimédia para a Internet";
    
    $from = $senderName . " <" . $senderEmail . ">";
    $replyTo = $from;
    
    $to = $ToName . " <" . $ToEmail . ">";
    $subject = $Subject;
    $message = $Message;
    
    $headers = "MIME-Version: 1.0" . $newLine;
    $headers .= "Content-Type: text/plain; charset=UTF-8" . $newLine;
    
    $headers .= encodeHeaderEmail( 
            "From", 
            $senderName, 
            $senderEmail );
    $headers .= encodeHeaderEmail( 
            "Reply-To", 
            $senderName, 
            $senderEmail );

    $preferences = array(
        "input-charset" => "UTF-8",
        "output-charset" => "ISO-8859-1",
        "scheme" => "Q");

    echo "From:\n<br>" . str_replace(">", "&gt;", str_replace("<", "&lt;", $from)) . "\n<br>\n<br>";
    echo "To:\n<br>" . str_replace(">", "&gt;", str_replace("<", "&lt;", $to)) . "\n<br>\n<br>";
    echo "Reply-To:\n<br>" . str_replace(">", "&gt;", str_replace("<", "&lt;", $replyTo)) . "\n<br>\n<br>";
    
    echo "Subject:\n<br>" . str_replace(">", "&gt;", str_replace("<", "&lt;", $subject)) . "\n<br>\n<br>";
    echo "Message:\n<br>" . str_replace(">", "&gt;", str_replace("<", "&lt;", $message)) . "\n<br>\n<br>";
    echo "Headers:\n<br>" . str_replace(">", "&gt;", str_replace("<", "&lt;", $headers)) . "\n<br>\n<br>";

    $result = mail($to, $subject, $message, $headers);
    
    if ( $result==true ) {
        $userMessage = "was";
    }
    else {
        $userMessage = "could not be";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        <title>Send an e-mail using PHP mail function</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link REL="stylesheet" TYPE="text/css" href="../Styles/GlobalStyle.css">
    </head>
    <body>
        <p>E-mail <?php echo $userMessage;?> delivered to e-mail server.</p>
        
        <hr>
        <br><a href="<?php echo $referer;?>">Back</a>
    </body>
</html>
