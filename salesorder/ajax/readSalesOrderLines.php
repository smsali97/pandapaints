<?php

session_start();



	if(isset($_POST['order_no'])) {
		// include Database connection file 
	include("db_connection.php");


	$order_no = $_POST['order_no'];

	// Design initial table header 
	$data = '<table class="table table-striped table-hover ">
			<thead class="thead">
						<tr class="bg-danger">
							<th scope=\'col\'>#</th>
							<th scope=\'col\'>Product Name</th>
							<th scope=\'col\'>Quantity</th>
							<th scope=\'col\'>Rate</th>
							<th scope=\'col\'>Amount</th>
							<th scope=\'col\'>Edit</th>
							<th scope=\'col\'>Delete</th>

						</tr>
			</thead>';


	$query = "SELECT * FROM salesorderline_13005 WHERE order_no = '$order_no'";

	if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }




    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	$number = 1;
    	while($row = mysqli_fetch_assoc($result))
    	{
    		$data .= '<tr>
    				<td>'.$number.'</td>';

    		
    		// Get the Product Details		
    		$pid = $row['pid'];
    		$query2 = "SELECT pcode, brand FROM products_13005 WHERE pid = '$pid'";

			if (!$result2 = mysqli_query($con, $query2)) {
		        exit(mysqli_error($con));
		    }
		    $row2 = mysqli_fetch_array($result2);
			$pcode = $row2['pcode']; 
			$brand = $row2['brand'];

			$data .= '<td>' . $pcode . ": " . $brand . '</td>';

			$data .= '<td>' . $row['qty'] . '</td>
					<td>' . $row['rate'] . '</td>
					<td> Rs. ' . $row['amount'] . '</td>
					<td>
					<button onclick="editRecord('.$row['order_no'].','.$row['pid'].')" class="btn btn-warning">
					<span class="glyphicon glyphicon-edit"></span>
					</button>
				</td>
				<td>
					<button onclick="deleteRecord('.$row['order_no'].','.$row['pid'].')" class="btn btn-danger">
					<span class="glyphicon glyphicon-trash"></span>
					</button>
				</td>
    		</tr>';
    		$number++;
    	}
    }
    else
    {
    	// records not found 
    	$data .= '<tr><td colspan="6">Records not found!</td></tr>';
    }

    $data .= '</table>';

    echo $data;	
	
	}
	
?>