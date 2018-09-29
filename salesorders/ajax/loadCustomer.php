<?php

function fill_customer($con) {
	$output = "";
	$sql = "SELECT * FROM customers_13005";

	$result = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_array($result) )
	{
		$output .= '<option value="' . $row['cid'] . '">' . $row['cname']. '</option>';
	}

	return $output;
}

?>