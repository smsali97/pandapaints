<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("db_connection.php");

    // get user id
    $order_no = $_POST['id'];

    // delete User
    $query = "DELETE FROM salesorders_13005 WHERE order_no = '$order_no'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}
?>