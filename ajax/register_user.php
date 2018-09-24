<?php

include("db_connection.php");

$username = mysqli_real_escape_string($con, $_POST['username']);
$password = md5(mysqli_real_escape_string($con, $_POST['password']));
$sp_name = $_POST['sp_name'];
$cno = $_POST['cno'];

// First create sales person
$query = "";
$query = "INSERT INTO salespersons_13005(spname, cno) VALUES('$sp_name','$cno')";
if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
}


// Get spid
$query = "SELECT * FROM salespersons_13005 WHERE spname = '$sp_name' AND cno = '$cno' ";
$fk_spid = mysqli_fetch_array(mysqli_query($con, $query))['spid'];


// regiser user 
$query = "INSERT INTO users_13005(username, password, fk_spid) 
VALUES('$username', '$password', '$fk_spid')";


if(!mysqli_query($con, $query))
{
	exit(mysqli_error($con));
}
else
{
	echo "Your registration is successful, Please login!";
}
?>