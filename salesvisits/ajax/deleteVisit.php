<?php


	$id = $_POST['id'];
	// MongoDB

	require_once "../../vendor/autoload.php";
	
	$collection = (new MongoDB\Client)->mydb->salesvisits;
	$deleteResult = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId("$id")]);

	echo "Deleted %d document(s)\n" . $deleteResult->getDeletedCount() ;

?>