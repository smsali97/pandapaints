<?php
	// include Database connection file 
	include("db_connection.php");


    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = md5(mysqli_real_escape_string($con, $_POST['password']));
	$query = "UPDATE users_13005 SET password = '$password'
    WHERE username = '$username' ";

	if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
        echo mysqli_error($con); 
    }

?>