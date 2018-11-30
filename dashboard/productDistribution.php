<?php
    include("db_connection.php");

	$query = 'SELECT p.brand AS "Brand", COUNT(*) AS "Frequency" FROM salesorderline_13005 s INNER JOIN products_13005 p ON p.pid = s.pid GROUP BY p.brand; ';

	if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }

    $data = array();
    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	while($row = mysqli_fetch_assoc($result))
    	{
            $data[] = $row;
        }
    }

    echo json_encode($data);

  ?>