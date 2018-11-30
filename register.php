<?php

session_start(); // REQUIRED TO BE USED SESSION
if(isset($_SESSION['id']))
{
	header("location: ccustomers");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register yourself on Panda Paints</title>

	<!-- Bootstrap CSS File -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar bg-success">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/pandapaints/index.php">Panda Paints</a>

            </div>
            <ul class="nav navbar-nav">
                <li><img src="/pandapaints/panda.png" class="img-responsive img-icons"></li>
                   <style>
                    .img-icons {
                         padding: 0.5em;
                    }

                    </style>
                <li class="nav-item disabled"><a class="nav-link" href="/pandapaints/salesorder/">Sales Order</a></li>
                <li class="nav-item disabled"><a class="nav-link disabled" href="/pandapaints/customers/">Customers</a></li>
                <li class="nav-item disabled"><a class="nav-link disabled" href="/pandapaints/products/">Products</a></li>
                <li class="nav-item disabled"><a class="nav-link disabled" href="/pandapaints/salespersons/">Salespersons</a></li>
                <li class="nav-item disabled"><a class="nav-link disabled" href="/pandapaints/users/">Users</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="/pandapaints/register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				<li><a href="/pandapaints/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				<li class="nav-item disabled"><a class="nav-link disabled" href="/pandapaints/salesvisits/">Sales Visits</a></li>
				<li class="nav-item disabled"><a class="nav-link disabled" href="/pandapaints/payments/">Payments</a></li>
				<li class="nav-item disabled"><a class="nav-link disabled" href="/pandapaints/dashboard/">Dashboard</a></li>
			</ul>
		</div>
	</nav> 



	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Register</h2>
				<p>
					<a href="/pandapaints/index.php">Home</a> | <a href="/pandapaints/login.php">Login</a> | <a href="/pandapaints/register.php">Register</a>
				</p>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" placeholder="Username" id="username">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" placeholder="Password" id="password">
				</div>
				<div class="form-group">
					<label for="confirm_password">Password</label>
					<input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password">
				</div>

				<h3 class="h4"><i>Salesperson Information</i></h3>
				<div class="form-group">
						<label for="updated_shop_name">Salesperson Name</label>
						<input type="text" id="sp_name" placeholder="Shop Name" class="form-control" />
				</div>

				<div class="form-group">
						<label for="updated_cno">Contact Number</label>
						<input type="tel" id="cno" placeholder="Contact Number" class="form-control" />
				</div>

				<div class="form-group">
					<button onclick="register()" class="btn btn-primary">Register</button>
				</div>

			</div>
			<div class="col-md-6"></div>
		</div>
	</div>
	<!-- Jquery JS file -->
	<script src="js/script.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</body>
</html>