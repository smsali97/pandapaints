	<?php
session_start(); // REQUIRED TO BE USED SESSION VARIABLES

	if (!isset($_SESSION['id']) || !isset($_SESSION['user_type'])) {
		header('location: /pandapaints/login.php');
	}
?>


<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Salespersons</title>

	<!-- Bootstrap CSS File -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<nav class="navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Panda Paints Admin</a>

			</div>
			<ul class="nav navbar-nav nav-pills nav-fill">
				<li><img src="/pandapaints/panda.png" class="img-responsive img-icons"></li>
				<style>
				.img-icons {
					padding: 0.5em;
				}

				
			</style>
			<li class="active"><a href="/pandapaints/salespersons/">Salespersons</a></li>
			<li><a href="/pandapaints/users/">Users</a></li>
		</ul>
			<div class="pull-right">
			<ul class="nav pull-right">
				<li class="dropdown"><a href="#" class="dropdown-toggle text-center" data-toggle="dropdown">Welcome back <?php echo $_SESSION['username']; ?>!<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="nav-item"><a href="/pandapaints/logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	</div>

</nav>

		

	<!-- Content Section -->

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class = "text-warning">My Salespersons</h1>
				<div class="pull-right">
					<button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Salesperson
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
					<h4 class="modal-title" id="myModalLabel">Add New Salespersons</h4>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="sp_name">Salesperson Name</label>
						<input type="text" id="sp_name" placeholder="Salesperson Name" class="form-control" />
					</div>

					<div class="form-group">
						<label for="cno">Contact Number</label>
						<input type="tel" id="cno" placeholder="Contact Number" class="form-control" />
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" onclick="addRecord()">Add Salesperson</button>
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
						<label for="updated_sp_name">Salesperson Name</label>
						<input type="text" id="updated_sp_name" placeholder="Salesperson Name" class="form-control" />
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