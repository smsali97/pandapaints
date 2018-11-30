<?php

	echo var_dump($_POST);
	echo var_dump($_FILES["myFile"]);


	$cid = $_POST['cid'];
	$spid = $_POST['spid'];
	$is_product_available = $_POST['is_product_available'];
	$is_product_in_front = $_POST['is_product_in_front'];
	$is_competitor = $_POST['is_competitor'];
	$date = new DateTime();
	$timestamp = $date->getTimestamp();
	$lat = $_POST['lat'];
	$long = $_POST['long'];
	$image = $_FILES["myFile"];


	// MongoDB

	require_once "../../vendor/autoload.php";
	
	$collection = (new MongoDB\Client)->mydb->salesvisits;

	$insertOneResult = $collection->insertOne([
	    'cid' => $cid,
	    'spid' => $spid,
	    'is_product_available' => $is_product_available,
	    'is_product_in_front' => $is_product_in_front,
	    'lat' => $lat,
	    'long' => $long,
	    'is_competitor' => $is_competitor,
	    'timestamp' => $timestamp,
	    "image" => new MongoDB\BSON\Binary(file_get_contents($image["tmp_name"]), MongoDB\BSON\Binary::TYPE_GENERIC),
	]);

?>