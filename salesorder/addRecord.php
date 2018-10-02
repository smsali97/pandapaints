<?php
	if(isset($_POST['cid']) )
	{
		// include Database connection file 
		include("db_connection.php");


		$cid = $_POST['cid'];
		$spid = $_POST['spid'];

		$query = "INSERT INTO salesorder_13005(cid, spid, sdate) VALUES('$cid','$spid'
		, CURRENT_DATE";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo "1 Sales Order Successfully Added! (Phew) ";
	}
?>