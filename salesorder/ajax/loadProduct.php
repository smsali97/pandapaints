<?php

function fill_product($con) {
	$output = "";
	$sql = "SELECT * FROM products_13005";

	$result = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_array($result) )
	{
		$output .= '<option value="' . $row['pid'] . '">' . $row['pcode']. ": " . $row['brand'] . '</option>';
	}

	return $output;
}

?>