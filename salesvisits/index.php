<?php
		session_start(); // REQUIRED TO BE USED SESSION VARIABLES

		if (!isset($_SESSION['id'])) {
			header('location: /pandapaints/login.php');
		}

			require 'ajax/db_connection.php';
			require 'ajax/loadCustomer.php';
?>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Field Survey Form</title>

			<!-- Bootstrap CSS File -->
			<link rel="stylesheet" href="/pandapaints/assets/bootstrap.min.css">

			<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
			  />	
			<!-- Make sure you put this AFTER Leaflet's CSS -->
			<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
			    ></script>

			<style>

				.thumbnail {
				    text-align:center;
				}

				li {
				    display: inline-block;
				    float: none; /* this is the part that makes it work */
				}
				
				 .map {
				   width: 100%;
				   height: 180px;
				   background-color: grey;
				 }
				
			</style>
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
		        <li class="active"><a href="/pandapaints/salesvisits/">Sales Visits<span class="sr-only"></span></a></li>
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


		<input type="hidden" id="hidden_cid">
		<input type="hidden" id="hidden_spid"> 


		<div class="container">
		  <div class="page-header text-center">
		  				<h2>Add New Survey Form</h2>
		  </div>

		  <div id="notification">

		  </div>


		  <form class="my-form" method="post" name="my-form" enctype="multipart/form-data">
		    <div class="form-group row">

		      <label for="customer" class="col-sm-2 col-form-label"></label>
		      <div class="col-sm-10">
		        <label>For which customer?</label>
					<select class="form-control customer" name="customer" id="customer">
									<?php echo fill_customer($con); ?>
					</select>
		      </div>
		    </div>
		    <div class="form-group row">
		      <label for="customer" class="col-sm-2 col-form-label"></label>
		      <div class="col-sm-10">
		        <label>Attach Picture</label>
		        	<input type="file" accept="image/*" name="myFile" capture>
		     </div>
		    </div>
		    <div class="form-group row">
		      <div class="col-sm-10">
		        <div class="form-check">
		          <label class="form-check-label">
		            <input class="form-check-input" type="checkbox" id="is_product_available"> My Products are available
		          </label>
		        </div>
		      </div>
		      <div class="col-sm-10">
		        <div class="form-check">
		          <label class="form-check-label">
		            <input class="form-check-input" type="checkbox" id="is_product_in_front"> My Products are positioned in front
		          </label>
		        </div>
		      </div>
		      <div class="col-sm-10">
		        <div class="form-check">
		        	<label class="form-check-label">
		            <input class="form-check-input" type="checkbox" id="is_competitor"> The Competitors' products are more promiment
		   			</label>	
		        </div>
		      </div>
		  </div>
		      <div class="form-group row">
		      	<div class="col-sm-10">
		      	<label for="latitude">Latitude</label>
		      	<input type="number" id="latitude" placeholder="Latitude" class="form-control" />
		      	</div>
		      	<div class="col-sm-10">
		      	<label for="longitude">Longitude</label>
		      	<input type="number" id="longitude" placeholder="Longitude" class="form-control" />
		      	</div>
		      </div>

		    <div class="form-group row">
		      <div class="offset-sm-2 col-sm-10">
		        <button type="submit" method="post" class="btn btn-primary">Submit</button>
		      </div>
		    </div>
		  </form>


		  	<div class="page-header text-center">
		    				<h2>My Surveys</h2>
		  	</div>
		  	<div class="records_content"></div>	
		  	

		</div>



		<!-- /Content Section -->

		<!-- Jquery JS file -->

		<script src="/pandapaints/assets/jquery-3.3.1.min.js"></script>
		<!-- Bootstrap JS file -->
		<script src="/pandapaints/assets/bootstrap.min.js"></script>
		<!-- Custom JS file -->
		<script type="text/javascript" src="js/script.js"></script>



		</body>
		</html>