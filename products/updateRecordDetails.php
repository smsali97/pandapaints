<?php
// include Database connection file
include("db_connection.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $customer_name = $_POST['customer_name'];
    $shop_name = $_POST['shop_name'];
    $address = $_POST['address'];
    $area = $_POST['area'];
    $gc = $_POST['gc'];
    $cno = $_POST['cno'];
    // Updaste User details
    $query = "UPDATE customers_13005 SET cname = '$customer_name', sname = '$shop_name', address = '$address'
    , area = '$area' , gc = '$gc' , cno = '$cno' WHERE cid = '$id'";



    if (!$result = mysqli_query($con, $query)) {
       echo 'There was an error with your connection: '.mysqli_connect_error();
}
        exit(mysqli_error($con));
    }


?>