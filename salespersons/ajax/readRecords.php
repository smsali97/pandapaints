<?php

session_start();

	// include Database connection file 
	include("db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-striped">
			<thead class="thead-dark">
						<tr class="bg-warning">
							<th scope=\'col\'>#</th>
							<th scope=\'col\'>Salesperson Name</th>
							<th scope=\'col\'>Contact Number</th>
							<th scope=\'col\'>Assigned Customers</th>
							<th scope=\'col\'>Edit</th>
							<th scope=\'col\'>Delete</th>
						</tr>
			</thead>';

	$query = "SELECT * FROM salespersons_13005";

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
					<td>' . $row['spname'] . '</td>
					<td>' . $row['cno'] . '</td>';

			// Get the customers list
			$c_list = mysqli_query($con, "SELECT cname FROM customers_13005 WHERE fk_spid = " . $row['spid']);

			if (mysqli_num_rows($c_list) == 0 ) { $data .= '<td>No Customers assigned yet</td>';  }
			else {
				$data .= '<td> <ul>';
				while ($r = mysqli_fetch_array($c_list)) {
     				$data .= '<li>' . $r['cname'] . '</li>';  
				}
				$data .= '</ul></td>';	
			}

			$data .= '<td>
					<button onclick="viewRecordDetails('.$row['spid'].')" class="btn btn-warning">
					<span class="glyphicon glyphicon-edit"></span>
					</button>
				</td>
				<td>
					<button onclick="deleteRecord('.$row['spid'].')" class="btn btn-danger">
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