<?php
	if(isset($_POST['order_no']) && isset($_POST['pid']) && isset($_POST['qty']) && isset($_POST['rate']))
	{
		// include Database connection file 
		include("db_connection.php");


		$order_no = $_POST['order_no'];
		$pid = $_POST['pid'];
		$qty = $_POST['qty'];
		$rate = $_POST['rate'];
		$amount = $_POST['amount'];


		$query = "INSERT INTO salesorderline_13005(order_no, pid, qty, rate, amount) VALUES('$order_no','$pid','$qty','$rate','$amount')";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo "1 Sales Order Line Successfully Added! (Phew) ";
	}
?>