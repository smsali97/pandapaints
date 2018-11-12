	<?php
session_start(); // REQUIRED TO BE USED SESSION VARIABLES

if (!isset($_SESSION['id'])) {
	header('location: /pandapaints/login.php');
}

	require 'ajax/db_connection.php';
	require 'ajax/loadCustomer.php';
	require 'ajax/loadProduct.php';
?>


<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Salesorders</title>

	<!-- Bootstrap CSS File -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
		        <li class="active"><a href="/pandapaints/salesorder/">Sales Order<span class="sr-only"></span></a></li>
		        <li class=""><a href="/pandapaints/salesvisits/">Sales Visits<span class="sr-only"></span></a></li>
		        <li class=""><a href="/pandapaints/customers/">Customers<span class="sr-only"></span></a></li>
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



<div class="container">
	<div class="row">
		<div class="mt-2 col-md-12">
			<div class="pull-right">
					<button id="new_sales_order" class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Sales Order</button>
			</div>
			<div class="page-header text-center">
  				<h2>My Sales Order</h2>
			</div>
			<div class="records_content"></div>
			

			<div id="salesorderlines" style="display: none">
			<div class="page-header text-center">
  				<h2>My Sales Order Lines</h2>
			</div>
  			<div class="pull-right">
					<button id="new_sales_order" class="btn btn-success" data-toggle="modal" data-target="#add_new_salesorderline_modal">Add New Sales Order Line</button>
			</div>
			<br> <br>
			<div class="records_content2"></div>
			
		</div>
	</div>
</div>



<input type="hidden" id="hidden_order_no">
<input type="hidden" id="hidden_pid">

<!-- Modal -->
	<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Add New Sales Order</h4>
				</div>
				<div class="modal-body">
					<label>For which customer?</label>
					<select class="form-control customer" name="customer" id="customer">
							<?php echo fill_customer($con); ?>
					</select>
					<br>
					<label><input type="checkbox" id="is_return"><em> This is a Sales Return</em></label>

					<input type="hidden" id="hidden_cid">
					<input type="hidden" id="hidden_spid">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" onclick="addSalesOrder()">Add Record</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="add_new_salesorderline_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Add New Sales Order Line</h4>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="product">
						Select Product
				  		</label>
						<select class="form-control product" name="product" id="product">
							<?php echo fill_product($con); ?>
						</select>
					</div>

					<div class="form-group">
						<label for="qty">Quantity</label>
						<input type="number" id="qty" placeholder="Quantity" class="form-control" />
					</div>


					<div class="form-group">
						<label for="rate">Rate</label>
						<input type="number" id="rate" placeholder="Rate" class="form-control" />
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" onclick="addSalesOrderLine()">Add</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Update New Sales Order Line</h4>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="product">
						Select Product
				  		</label>
						<select class="form-control product" name="updated_product" id="updated_product">
							<?php echo fill_product($con); ?>
						</select>
					</div>

					<div class="form-group">
						<label for="qty">Quantity</label>
						<input type="number" id="updated_qty" placeholder="Quantity" class="form-control" />
					</div>


					<div class="form-group">
						<label for="rate">Rate</label>
						<input type="number" id="updated_rate" placeholder="Rate" class="form-control" />
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" onclick="updateRecordDetails()">Add</button>
				</div>
			</div>
		</div>
	</div>

<!-- /Content Section -->

<!-- Jquery JS file -->

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- Bootstrap JS file -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Custom JS file -->
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>