<?php
	if(isset($_POST['cid']))
	{
		// include Database connection file 
		include("db_connection.php");

		$cid = $_POST['cid'];
		$spid = $_POST['spid'];


		$query = "INSERT INTO salesorder_13005(cid, spid) VALUES('$cid','$spid')";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo mysqli_insert_id($con);

	}
?>