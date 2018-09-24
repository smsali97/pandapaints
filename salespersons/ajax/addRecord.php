<?php
	if(isset($_POST['sp_name']) && isset($_POST['cno']) )
	{
		// include Database connection file 
		include("db_connection.php");

		// get values 
		$sp_name = $_POST['sp_name'];
		$cno = $_POST['cno'];

		$query = "INSERT INTO salespersons_13005(spname, cno) VALUES('$sp_name','$cno')";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo "1 Salesperson Added!";
	}
?>