<?php

session_start(); 


	if(isset($_POST['customer_name']) && isset($_POST['shop_name']) && isset($_POST['address']))
	{
		// include Database connection file 
		include("db_connection.php");

		// get values 
		$customer_name = $_POST['customer_name'];
		$shop_name = $_POST['shop_name'];
		$address = $_POST['address'];
		$area = $_POST['area'];
		$gc = $_POST['gc'];
		$cno = $_POST['cno'];
		$spid = $_SESSION['spid'];

		$query = "INSERT INTO customers_13005(cname, sname, address, area, gc, cno, fk_spid) VALUES('$customer_name', '$shop_name', '$address', '$area', '$gc', '$cno', '$spid')";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo "1 Record Added!";
	}
?>