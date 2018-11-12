<?php
	if(isset($_POST['cid']))
	{
		// include Database connection file 
		include("db_connection.php");


		$cid = $_POST['cid'];

		$query1 = "SELECT c.cid, s.spid, c.address, c.area, s.spname  FROM customers_13005 AS c INNER JOIN salespersons_13005 AS s ON c.fk_spid=s.spid WHERE c.cid = '$cid' ";
		
		if (!$result1 = mysqli_query($con, $query1)) {
        	exit(mysqli_error($con));
    	}
	    $response = array();
	    if(mysqli_num_rows($result1) > 0) {
	        while ($row = mysqli_fetch_assoc($result1)) {
	            $response = $row;
	        }
	    }
	    else
	    {
	        $response['status'] = 200;
	        $response['message'] = "Data not found!";
	    }
	    // display JSON data
	    echo json_encode($response);


	}
?>