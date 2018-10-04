<?php
// check request
if(isset($_POST['pid']) && isset($_POST['order_no']) != "")
{
    // include Database connection file
    include("db_connection.php");

    // get user id
    $order_no = $_POST['order_no'];
    $pid = $_POST['pid'];

    // delete User
    $query = "DELETE FROM salesorderline_13005 WHERE order_no = '$order_no' AND pid = '$pid' ";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}
?>