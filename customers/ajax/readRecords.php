<?php

session_start(); 
	// include Database connection file 
	include("db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
			<thead class="thead">
						<tr class="bg-primary">
							<th scope=\'col\'>#</th>
							<th scope=\'col\'>Shop Name</th>
							<th scope=\'col\'>Customer Name</th>
							<th scope=\'col\'>Address</th>
							<th scope=\'col\'>Area</th>
							<th scope=\'col\'>Geo Coordinates</th>
							<th scope=\'col\'>Contact Number</th>
							<th scope=\'col\'>Edit</th>
							<th scope=\'col\'>Delete</th>
						</tr>
			</thead>';

	$query = "SELECT * FROM customers_13005 WHERE fk_spid =" . $_SESSION['spid'];

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
    				<td>'.$number.'</td>
					<td>' . $row['sname'] . '</td>
					<td>' . $row['cname'] . '</td>
					<td>' . $row['address'] . '</td>
					<td>' . $row['area'] . '</td>
					<td>' . $row['gc'] . '</td>
					<td>' . $row['cno'] . '</td>
				<td>
					<button onclick="viewRecordDetails('.$row['cid'].')" class="btn btn-warning">
					<span class="glyphicon glyphicon-edit"></span>
					</button>
				</td>
				<td>
					<button onclick="deleteRecord('.$row['cid'].')" class="btn btn-danger">
					<span class="glyphicon glyphicon-trash"></span>
					</button>
				</td>
    		</tr>';
    		$number++;
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">Records not found!</td></tr>';
    }

    $data .= '</table>';

    echo $data;
?>