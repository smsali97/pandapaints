<?php
    include("db_connection.php");

	$query = 'SELECT DATE(s.timestamp) AS "Date", COUNT(*) AS "Frequency" FROM salesorder_13005 s INNER JOIN salespersons_13005 p ON p.spid = s.spid GROUP BY p.spname, DATE(s.timestamp) ORDER BY s.timestamp';

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