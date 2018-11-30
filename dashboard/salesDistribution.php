<?php
    include("db_connection.php");

    $id = $_POST['spid'];
	$query = 'SELECT c.cname as "Customer", SUM(s.amount) AS "Total" FROM salesorderline_13005 s INNER JOIN salesorder_13005 o ON o.order_no = s.order_no INNER JOIN customers_13005 c ON o.cid = c.cid WHERE o.spid =' . $id . ' GROUP BY c.cname';

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