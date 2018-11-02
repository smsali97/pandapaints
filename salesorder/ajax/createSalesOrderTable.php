<?php
	if(isset($_POST['order_no']) && $_POST['order_no'] != '')
	{
		// include Database connection file 
		include("db_connection.php");

		$cid = $_POST['cid'];
		$spid = $_POST['spid'];
		$order_no = $_POST['order_no'];


		$query1 = "SELECT so.order_no, so.is_return, c.cname, c.address, c.area, s.spname, so.timestamp  FROM customers_13005 AS c INNER JOIN salespersons_13005 AS s ON c.fk_spid=s.spid 
			INNER JOIN salesorder_13005 AS so ON c.cid=so.cid
		WHERE so.order_no = '$order_no' ";
		
		if (!$result1 = mysqli_query($con, $query1)) {
        	echo mysqli_error($con);
    	}

    	$data = "";


    	$data .= '<table class="table table-hover table-sm"" class="align-middle"> 
				<thead class="bg-info">
					<tr>
						<th>Order Number</th>
						<th>Customer Name</th>
						<th>Address</th>
						<th>Area</th>
						<th>Assigned Salesperson</th>
						<th>Timestamp</th>
						<th>Sales Return</th>
					</tr>
				</thead>';


	    if(mysqli_num_rows($result1) > 0) {
	        while ($row = mysqli_fetch_assoc($result1)) {

	        	$sales_return = "";
	        	if ($row['is_return'] != '1') {
	        		$sales_return = '<span class="glyphicon glyphicon-remove-sign" style="font-size:25px;color:orange"></span>';
	        	}
	        	else {
	        		$sales_return = '<span class="glyphicon glyphicon-ok-sign" style="font-size:25px;color:green"></span>';
	        	}


	            $data .= '<td>' . $row['order_no'] . '</td>
					<td>' . $row['cname'] . '</td>
					<td>' . $row['address'] . '</td>
					<td>' . $row['area'] . '</td>
					<td>' . $row['spname'] . '</td>
					<td>' . $row['timestamp'] . '</td>
					<td align=\'center\'>' . $sales_return . '</td>';
	        }
	    }
	    else {
	    	$data .= '<tr><td colspan="6">Sales Order Header not set!</td></tr>';
	    }

	      $data .= '</table>';

    	  echo $data;	

	}
?>