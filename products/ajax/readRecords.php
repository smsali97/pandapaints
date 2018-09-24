<?php


	// include Database connection file 
	include("db_connection.php");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<thead class="thead">
						<tr class="bg-info">
							<th scope="col">#</th>
							<th scope="col">Product Code</th>
							<th scope="col">Brand</th>
							<th scope="col">Type</th>
							<th scope="col">Shade</th>
							<th scope="col">Size</th>
							<th scope="col">Sales Price</th>
							<th scope="col">Edit</th>
							<th scope="col">Delete</th>
						</tr>
						</thead>';

	$query = "SELECT * FROM products_13005";

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
				<td>'.$row['pcode'].'</td>
				<td>'.$row['brand'].'</td>
				<td>'.$row['type'].'</td>
				<td>'.$row['shade'].'</td>
				<td>'.$row['size'].'</td>
				<td> Rs.'.$row['sales_price'].'</td>
				<td>
					<button onclick="viewRecordDetails('.$row['pid'].')" class="btn btn-warning">
					<span class="glyphicon glyphicon-edit"></span>
					</button>
				</td>
				<td>
					<button onclick="deleteRecord('.$row['pid'].')" class="btn btn-danger">
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