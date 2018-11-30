<?php
// include Database connection file
include("db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $amount = $_POST['amount'];
    $cid = $_POST['cid'];
    $id = $_POST['id'];

    // Updaste User details
    $query = "UPDATE payment_13005 SET amount = '$amount', cid = '$cid' WHERE receiptno = '$id'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}