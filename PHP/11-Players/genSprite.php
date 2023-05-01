<?php
	$dirToScan      =   'sprites/';
	$filePrefix     =   'thumb-';
	$fileSuffix     =   '.jpg';
	$thumbWidth     =   80;
	$thumbHeight    =   80;
	$imageFiles     =   array();
	$spriteFile     =   'sprite.png';
	$imageLine      =   20;
	$vttFile        =   'sprite.vtt';
	$dst_x          =   0;
	$dst_y          =   0;
	
	# read the directory with thumbnails, file name in array
	foreach (glob($dirToScan.$filePrefix.'*'.$fileSuffix) as $filename) {
		array_push($imageFiles,$filename);
	}
	
	natsort( $imageFiles );
	
	echo "<pre>";
		print_r( $imageFiles );
	echo "</pre>";

	#calculate dimension for the sprite 
	$spriteWidth  = $thumbWidth*$imageLine;
	$spriteHeight =  $thumbHeight*(floor(count($imageFiles)/$imageLine)+1);
	
	# create png file for sprite
	$png = imagecreatetruecolor($spriteWidth,$spriteHeight);

	# open vtt file
	$handle = fopen( $vttFile,'wb+' );
	fwrite( $handle, 'WEBVTT'."\n" );

	# insert thumbs in sprite and write the vtt file
	foreach($imageFiles AS $file)   {
		$counter  = str_replace($filePrefix,'',str_replace($fileSuffix,'',str_replace($dirToScan,'',$file)));
		
		echo "<pre>";
			print_r( $counter );
		echo "</pre>";		
		
		$imageSrc = imagecreatefromjpeg($file);
		imagecopyresized ($png, $imageSrc, $dst_x , $dst_y , 0, 0, $thumbWidth, $thumbHeight, $thumbWidth, $thumbHeight );

		$varTCstart = gmdate("H:i:s", $counter-1).'.000';
		$varTCend   = gmdate("H:i:s", $counter).'.000';

		$varSprite  =   $spriteFile.'#xywh='.$dst_x.','.$dst_y.','.$thumbWidth.','.$thumbHeight;

		fwrite( $handle, $counter."\n".$varTCstart.' --> '.$varTCend."\n".$varSprite."\n\n" );

		#create new line after 20 images
		if ($counter % $imageLine == 0) {
			$dst_x=0;
			$dst_y+=$thumbHeight;
		}
		else {
			$dst_x+=$thumbWidth;
		}
		
		unlink( $file );
	}

	imagejpeg($png,$spriteFile);
	fclose($handle);
?>