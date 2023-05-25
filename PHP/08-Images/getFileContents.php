<?php
    require_once( "../Lib/lib.php" );
    require_once( "../Lib/db.php" );

    $id = $_GET['id'];
    session_start();
    dbConnect( ConfigFile );
                
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db( $GLOBALS['ligacao'], $dataBaseName );
    
    $id_user = $_SESSION['id'];
    $query = "SELECT `idRole` FROM `auth-permissions` WHERE `idUser` = $id_user";
    
    $result = $ligacao->query($query);
    $record = $result->fetch_array();
    $idRole = $record['idRole'];
    
    if($idRole > 0 ){
        // Read from the data base details about the file
        $fileDetails = getFileDetails( $id );

        $fileName = $fileDetails['fileName'];
        $mimeFileName = $fileDetails['mimeFileName'];
        $typeFileName = $fileDetails['typeFileName'];

        $pathParts = pathinfo( $fileName );
        $fileNameForDownload = $pathParts[ "basename" ];

        // Pass image contents to the browser
        $fileHandler = fopen($fileName, 'rb');

        header( "Content-Type: $mimeFileName/$typeFileName");
        header( "Content-Length: " . filesize($fileName) );

        header( "Content-Transfer-Encoding: Binary" );
        header( "Content-Disposition: attachment; filename=\"" . $fileNameForDownload . "\""); 

        //header( "Content-Disposition: attachment; "); 

        fpassthru( $fileHandler );
        fclose( $fileHandler );
    }
    else{
        header( "Location: ../formLogin.php" );
        exit();
    }
