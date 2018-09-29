<?php
	if(isset($_POST['cid']) && isset($_POST['pid']) && isset($_POST['qty']) && isset($_POST['rate']))
	{
		// include Database connection file 
		include("db_connection.php");


		$cid = $_POST['cid'];
		$pid = $_POST['pid'];
		$qty = $_POST['qty'];
		$rate = $_POST['rate'];
		$amount = $_POST['amount'];


		$query1 = "SELECT fk_spid FROM customers_13005 WHERE cid='$cid'";
		
		if (!$result1 = mysqli_query($con, $query1)) {
        	exit(mysqli_error($con));
    	}
    	$row = mysqli_fetch_array($result1);
		$spid = $row['fk_spid']; 


		$query = "INSERT INTO salesorders_13005(cid, spid, pid, qty, rate, amount) VALUES('$cid','$spid'
		,'$pid','$qty','$rate','$amount')";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo "1 Sales Order Successfully Added! (Phew) ";
	}
?>