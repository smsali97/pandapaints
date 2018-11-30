<?php
session_start(); // REQUIRED TO BE USED SESSION VARIABLES

  if (!isset($_SESSION['id']) || !isset($_SESSION['spid'])) {
    header('location: /pandapaints/login.php');

  }
  require 'ajax/db_connection.php';
  require 'ajax/loadCustomer.php';


  $spid = $_SESSION['spid'];
  $spname = "";
  $sql_query = "SELECT s.spname FROM salespersons_13005 s WHERE spid = " . $spid;
   $resultset = mysqli_query($con, $sql_query) or die("database error:". mysqli_error($con));
   while( $query = mysqli_fetch_assoc($resultset) ) {
      $spname = $query['spname'];
   }
  

?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap -->
      
   <script src="/pandapaints/assets/jquery-3.3.1.min.js"></script>  
  <link href="/pandapaints/assets/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="/pandapaints/assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script src="/pandapaints/assets/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap JS file -->
  <script src="/pandapaints/assets/bootstrap.min.js"></script>
  <!-- Custom JS file -->
  <script type="text/javascript" src="js/script.js"></script>
  

  <!-- DataTables -->
  <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>


    <title>Payments</title>
  </head>
<body>

    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
            <span>
              <img src="/pandapaints/panda.png" class="img-icons">
            </span>
            Panda Paints
          </a>

        </div>

        <style type="text/css">
          .navbar-brand {
            display: inline-block;
          }
          
        .img-icons {
          padding: auto;
        }

        </style>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class=""><a href="/pandapaints/salesorder/">Sales Order<span class="sr-only"></span></a></li>
            <li class=""><a href="/pandapaints/salesvisits/">Sales Visits<span class="sr-only"></span></a></li>
            <li class=""><a href="/pandapaints/customers/">Customers<span class="sr-only"></span></a></li>
            <li class="active"><a href="/pandapaints/payments/">Payments<span class="sr-only"></span></a></li>
            <li class=""><a href="/pandapaints/products/">Products<span class="sr-only"></span></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome back <?php echo $_SESSION['username']; ?>!<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li class="nav-item"><a href="/pandapaints/logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </li>
      </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>


  <!-- Content Section -->
  <div class="container">

   <div id="message_area">
   </div> 
   <table id="data_table" class="table table-striped">
   <thead>
   <tr>
   <th>Receipt No</th>
   <th>Customer Name</th>
   <th>Salesperson Name</th>
   <th>Amount</th>
   <th>Time</th>
   <th>Action</th>
   </tr>
   </thead>
   <tbody>
   <?php

   $sql_query = "SELECT receiptno, time, c.cname, s.spname, amount FROM payment_13005 p INNER JOIN customers_13005 c ON c.cid = p.cid INNER JOIN salespersons_13005 s ON p.spid = s.spid WHERE s.spid= $spid ";
   $resultset = mysqli_query($con, $sql_query) or die("database error:". mysqli_error($con));
   while( $query = mysqli_fetch_assoc($resultset) ) {
   ?>
   <tr>
   <td class="receiptno"><?php echo $query ['receiptno']; ?></td>
   <td><?php echo $query ['cname']; ?></td>
   <td><?php echo $query ['spname']; ?></td>
   <td><?php echo $query ['amount']; ?></td>
   <td><?php echo $query ['time']; ?></td>
   <td><button class="btn btn-info glyphicon glyphicon-edit" onclick="editPayment(<?php echo $query['receiptno']; ?>)"></span>
    <button class="btn btn-danger glyphicon glyphicon-trash" onclick="deletePayment(<?php echo $query['receiptno']; ?>)"></td>
    </span>
   </tr>
   <?php }    
   ?>

   <tr class="warning">
   <td>
   </td>
   <td>
    <select id="add_customer">
       <?php echo fill_customer($con); ?>
    </select>
   </td>
   <td id="add_salesperson" data-id=<?php echo $spid; ?>>
     <?php echo $spname; ?>
   </td>
   <td><input type="text" name="Amount" id="amount"></td>
   <td><input type="time" name="time" id="time" disabled="true"></td>
   <td>   <button onclick="addPayment()" class="btn btn-success btn-md">
          <span class="glyphicon glyphicon-ok-sign"></span>
          </button> 
  </td>
   </tbody>
   </table>
  </div>


  <div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myModalLabel">Update</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="updated_amount">Updated Amount</label>
            <input type="number" id="updated_amount" placeholder="Amount" class="form-control" />
          </div>

         <div class="form-group">
          <label for="updated_customer">Updated Customer</label>
          <br>
          <select id="update_customer">
             <?php echo fill_customer($con); ?>
          </select>
         </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" onclick="updateRecordDetails()" >Save Changes</button>
          <input type="hidden" id="hidden_id">
        </div>
      </div>
    </div>
  </div>

</body>

</html>