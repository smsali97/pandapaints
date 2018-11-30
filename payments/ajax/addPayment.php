<?php

session_start(); 


	if(isset($_POST['amount']) && isset($_POST['cid']) && isset($_POST['spid']))
	{
		// include Database connection file 
		include("db_connection.php");

		// get values 
		$amount = mysqli_escape_string($con,$_POST["amount"]);
		$cid = mysqli_escape_string($con,$_POST["cid"]);
		$spid = mysqli_escape_string($con,$_POST["spid"]);


		$query = "INSERT INTO payment_13005 (cid, spid, amount) VALUES('$cid', '$spid', '$amount')";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo "1 Record Added!";
	}
?>