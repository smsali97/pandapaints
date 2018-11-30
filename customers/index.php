<?php
session_start(); // REQUIRED TO BE USED SESSION VARIABLES

	if (!isset($_SESSION['id']) || !isset($_SESSION['spid'])) {
		header('location: /pandapaints/login.php');
	}
?>


<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Customers</title>

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
		        <li class=""><a href="/pandapaints/salesorder/">Sales Order<span class="sr-only"></span></a></li>
		        <li class=""><a href="/pandapaints/salesvisits/">Sales Visits<span class="sr-only"></span></a></li>
		        <li class="active"><a href="/pandapaints/customers/">Customers<span class="sr-only"></span></a></li>
		        <li class=""><a href="/pandapaints/payments/">Payments<span class="sr-only"></span></a></li>
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
			<div class="col-md-12">
				<h1 class = "text-primary">My Customers</h1>
				<div class="pull-right">
					<button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Customer
					</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>Records:</h4>
				<div class="records_content"></div>
			</div>
		</div>
	</div>



	<!-- Bootstrap Modal - To Add New Record -->
	<!-- Modal -->
	<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Add New Customer</h4>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="shop_name">Shop Name</label>
						<input type="text" id="shop_name" placeholder="Shop Name" class="form-control" />
					</div>

					<div class="form-group">
						<label for="customer_name">Customer Name</label>
						<input type="text" id="customer_name" placeholder="Customer Name" class="form-control" />
					</div>

					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" id="address" placeholder="Address" class="form-control" />
					</div>					

					<div class="form-group">
						<label for="area">Area</label>
						<input type="text" id="area" placeholder="Area" class="form-control" />
					</div>

					<div class="form-group">
						<label for="gc">Geographical Coordinates</label>
						<input type="text" id="gc" placeholder="Geographical Coordinates" class="form-control" />
					</div>

					<div class="form-group">
						<label for="cno">Contact Number</label>
						<input type="tel" id="cno" placeholder="Contact Number" class="form-control" />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" onclick="addRecord()">Add Customer</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal - Update User details -->
	<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel">Update</h4>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="updated_shop_name">Shop Name</label>
						<input type="text" id="updated_shop_name" placeholder="Shop Name" class="form-control" />
					</div>

					<div class="form-group">
						<label for="updated_customer_name">Customer Name</label>
						<input type="text" id="updated_customer_name" placeholder="Customer Name" class="form-control" />
					</div>

					<div class="form-group">
						<label for="updated_address">Address</label>
						<input type="text" id="updated_address" placeholder="Address" class="form-control" />
					</div>					

					<div class="form-group">
						<label for="updated_area">Area</label>
						<input type="text" id="updated_area" placeholder="Area" class="form-control" />
					</div>

					<div class="form-group">
						<label for="updated_gc">Geographical Coordinates</label>
						<input type="text" id="updated_gc" placeholder="Geographical Coordinates" class="form-control" />
					</div>

					<div class="form-group">
						<label for="updated_cno">Contact Number</label>
						<input type="tel" id="updated_cno" placeholder="Contact Number" class="form-control" />
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
	<!-- // Modal -->

	<!-- /Content Section -->

	<!-- Jquery JS file -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<!-- Bootstrap JS file -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<!-- Custom JS file -->
	<script type="text/javascript" src="js/script.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

</body>
</html>