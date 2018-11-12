<?php

	require_once "../../vendor/autoload.php";
	
	$collection = (new MongoDB\Client)->mydb->salesvisits;

	$collection->drop();

?>