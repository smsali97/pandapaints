<?php
	if(isset($_POST['pcode']) && isset($_POST['type']) && isset($_POST['brand']))
	{
		// include Database connection file 
		include("db_connection.php");

		// get values 
		$pcode = $_POST['pcode'];
		$brand = $_POST['brand'];
		$type = $_POST['type'];
		$brand = $_POST['brand'];
		$shade = $_POST['shade'];
		$size = $_POST['size'];
		$sales_price = $_POST['sales_price'];

		$query = "INSERT INTO products_13005(pcode, brand, type, shade, size, sales_price) VALUES('$pcode', '$brand', '$type', '$shade', '$size', '$sales_price')";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo "1 Product Added!";
	}
?>