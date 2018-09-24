<?php
// include Database connection file
include("db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $sp_name= $_POST['sp_name'];
    $cno= $_POST['cno'];

    // Updaste User details
    $query = "UPDATE salespersons_13005 SET spname = '$sp_name', cno = '$cno' WHERE spid = '$id'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}