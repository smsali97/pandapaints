<?php
	// include Database connection file 
	include("db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-striped">
			<thead class="thead-dark">
						<tr class="bg-warning">
							<th scope=\'col\'>#</th>
							<th scope=\'col\'>Username</th>
							<th scope=\'col\'>Created At</th>
							<th scope=\'col\'>Is a salesperson?</th>
                            <th scope=\'col\'>Is Active?</th>
							<th scope=\'col\'>Delete</th>
						</tr>
			</thead>';

	$query = "SELECT * FROM users_13005";

	if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	$number = 1;
    	while($row = mysqli_fetch_assoc($result))
    	{
    		$val = "";
    		if ($row['fk_spid'] != ""){ $val = "Yes"; }
    		else {  $val = "No"; }
    		$data .= '<tr>
    				<td>'.$number.'</td>
					<td>' . $row['username'] . '</td>
					<td>' . $row['created_at'] . '</td>
					<td>' . $val .'</td> 
				<td>';

            if ($row['isActive'] == 1) {
                $data .=  '<span class="glyphicon glyphicon-check" style="color:green"></span> </td> ';
            }
			$data .= '<td> <button onclick="deleteRecord(' . $row['uid'] . ')" class="btn btn-danger">
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