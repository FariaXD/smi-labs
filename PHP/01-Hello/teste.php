<?php
	$url = "http://localhost:8080/ServiceCountriesTomcat-1.0.0/rest/countries";
	
	$data = file_get_contents( $url );
	
	print_r( $data );
?>