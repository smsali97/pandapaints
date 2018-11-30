<?php

function fill_salesperson($con) {
	$output = "";
	$sql = "SELECT * FROM salespersons_13005";

	$result = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_array($result) )
	{
		$output .= '<option value="' . $row['spid'] . '">' . $row['spname']. '</option>';
	}

	return $output;
}

?>