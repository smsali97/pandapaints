	<?php
session_start(); // REQUIRED TO BE USED SESSION VARIABLES

	if (!isset($_SESSION['id']) || !isset($_SESSION['user_type'])) {
		header('location: /pandapaints/login.php');
	}

	include("db_connection.php");
	require 'loadSalesPerson.php';
?>


<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Dashboard</title>

	<!-- Bootstrap CSS File -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
</head>
<body >

		<!-- Content Section -->
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
			<li class="active"><a href="/pandapaints/dashboard/">Dashboard</a></li>
			<li ><a href="/pandapaints/salespersons/">Salespersons</a></li>
			<li class=""><a href="/pandapaints/users/">Users</a></li>
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
		<div class="jumbotron">
		  <h2 style='font-family: sans-serif;'>Panada Paints Dashboard</h2>
		</div>
		<div class="row">
			<div class="col-md-12">
			<div class="page-header">
			  <h1>Time Series of Sales Orders<small> (Number of Orders at each Interval)</small></h1>
			</div>
			<div id="chart-container2" style="height: 600px">> 
					<canvas id="linegraph"></canvas>
			</div>
			</div>		
		</div>	
		<div class="row">
			<div class="page-header">
			  <h1>Products Popularity Distribution<small> Doughnut</small></h1>
			</div>
			<div class="col-md-6">
				<div id="piechart-container" style="height: 300px">> 
					<canvas id="piechart1"></canvas>
				</div>
			</div>
			<div class="col-md-6">
				<div id="piechart-container2" style="height: 300px">> 
					<canvas id="piechart2"></canvas>
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-12">
			<div class="page-header">
			  <h1>Total Sales Distribution<small> (PKR for each Customer)</small></h1>
			</div>
				<label><strong>For which salesperson?</strong></label>
				<select class="form-control salesperson" name="salesperson" id="salesperson_select">
						<?php echo fill_salesperson($con); ?>
				</select>
				<br>
				<div id="chart-container" style="height: 300px">> 
					<canvas id="bargraph"></canvas>
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