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

	<!-- Content Section -->
	<nav class="nav">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="">Panda Paints</a>

			</div>
			<ul class="nav navbar-nav">
				<li><img src="/pandapaints/panda.png" class="img-responsive img-icons"></li>
				   <style>
					.img-icons {
					     padding: 0.5em;
					}

					</style>
				<li><a href="/pandapaints/salesorders/">Sales Orders</a></li>
				<li><a class="nav-link active" href="/pandapaints/customers/">Customers</a></li>
				<li><a href="/pandapaints/products/">Products</a></li>



			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a>Welcome back <?php echo $_SESSION['username']; ?>!</a></li>
				<li><a href="/pandapaints/logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
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

</body>
</html>