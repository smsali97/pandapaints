<?php
// include Database connection file
include("db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $order_no = $_POST['order_no'];
    $qty= $_POST['qty'];
    $rate= $_POST['rate'];
    $amount = $_POST['amount'];
    $pid = $_POST['pid'];

    // Updaste User details
    $query = "UPDATE salesorderline_13005 SET qty = '$qty', rate = '$rate', amount = '$amount' WHERE pid = '$pid' AND order_no = '$order_no'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}