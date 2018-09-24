<?php
// include Database connection file
$host = "localhost"; // MySQL host name eg. localhost
$user = "root"; // MySQL user. eg. root ( if your on localserver)
$password = ""; // MySQL user password  (if password is not set for your root user then keep it empty )
$database = "myshop_13005"; // MySQL Database name
 
// Connect to MySQL Database
$con = new mysqli($host, $user, $password, $database);
 
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $pcode = $_POST['pcode'];
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $shade = $_POST['shade'];
    $size = $_POST['size'];
    $sales_price = $_POST['sales_price'];
    

    // Updaste User details
    $query = "UPDATE products_13005 SET pcode = '$pcode', brand = '$brand', type = '$type',
    shade = '$shade', size = '$size', sales_price = '$sales_price' WHERE pid = '$id'";


    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
           echo mysqli_error($con); 
    } 
}