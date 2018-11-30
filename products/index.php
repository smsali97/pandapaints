	<?php
session_start(); // REQUIRED TO BE USED SESSION VARIABLES

	if (!isset($_SESSION['id'])) {
		header('location: /pandapaints/login.php');
	}
	require 'ajax/db_connection.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>My Products</title>


	<!-- Bootstrap CSS File -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Jquery JS file -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<!-- Bootstrap JS file -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<!-- Custom JS file -->
	<script type="text/javascript" src="js/script.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/js/bootstrap-colorpicker.min.js"></script>  

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
		        <li class=""><a href="/pandapaints/payments/">Payments<span class="sr-only"></span></a></li>
		        <li class="active"><a href="/pandapaints/products/">Products<span class="sr-only"></span></a></li>
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
		<div class="row">
			<div class="col-md-12">
				<h2 class='h1 text-info' >My Products</h2>
				<div class="pull-right">
					<button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Product</button>
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
					<h4 class="modal-title" id="myModalLabel">Add New Product</h4>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="pcode">Product Code</label>
						<input type="text" id="pcode" placeholder="Product Code" class="form-control" />
					</div>

					<div class="form-group">
						<label for="brand">Brand</label>
						<input type="text" id="brand" placeholder="Brand" class="form-control" />
					</div>


					<div class="form-group" id="myForm">
						<label for="brand">Type</label>
						 <label class="radio-inline"><input type="radio" name="optradio" checked value="1">Option 1</label>
						<label class="radio-inline"><input type="radio" name="optradio" value="2">Option 2</label>
						<label class="radio-inline"><input type="radio" name="optradio" value="3">Option 3</label>
					</div>

					<div class="form-group">
						<label for="brand">Shade</label>
						<div id="color" class="input-group colorpicker-component">
						<input class="form-control" type="text" id="shade"/>
						<span class="input-group-addon"><i></i></span>
						</div>
						<script>
						    $('#color').colorpicker({});
						</script>
					</div>


					<div class="form-group" id="myForm">
						<label for="brand">Size</label>
						<label class="radio-inline"><input type="radio" name="optradio2" checked value="S">Small</label>
						<label class="radio-inline"><input type="radio" name="optradio2" value='M'>Medium</label>
						<label class="radio-inline"><input type="radio" name="optradio2" value="L">Large</label>
					</div>

					<div class="form-group">
						<label for="sales_price">Sales Price</label>
						<input type="number" id="sales_price" placeholder="Sales Price" class="form-control" />
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
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
						<label for="updated_pcode">Product Code</label>
						<input type="text" id="updated_pcode" placeholder="Product Code" class="form-control" />
					</div>

					<div class="form-group">
						<label for="updated_brand">Brand</label>
						<input type="text" id="updated_brand" placeholder="Brand" class="form-control" />
					</div>


					<div class="form-group" id="myForm">
						<label for="updated_type">Type</label>
						 <label class="radio-inline"><input type="radio" name="updated_optradio" checked value="1">Option 1</label>
						<label class="radio-inline"><input type="radio" name="updated_optradio" value="2">Option 2</label>
						<label class="radio-inline"><input type="radio" name="updated_optradio" value="3">Option 3</label>
					</div>

					<div class="form-group">
						<label for="shade">Shade</label>
						<div id="updated_color" class="input-group colorpicker-component">
						<input class="form-control" type="text" id="updated_shade"/>
						<span class="input-group-addon"><i></i></span>
						</div>
						<script>
						    $('#updated_color').colorpicker({});
						</script>
					</div>


					<div class="form-group" id="myForm">
						<label for="updated_size">Size</label>
						<label class="radio-inline"><input type="radio" name="updated_optradio2" checked value="S">Small</label>
						<label class="radio-inline"><input type="radio" name="updated_optradio2" value='M'>Medium</label>
						<label class="radio-inline"><input type="radio" name="updated_optradio2" value="L">Large</label>
					</div>

					<div class="form-group">
						<label for="updated_sales_price">Sales Price</label>
						<input type="number" id="updated_sales_price" placeholder="Sales Price" class="form-control" />
					</div>				</div>
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

</body>
</html>