<?php


    $API = 'AIzaSyCEXEfOEtj8pjxDteqE1htCLQWwdgqg9xs';

	session_start(); 
	include("db_connection.php");
	$spid = $_SESSION['spid'];


	// MongoDB
	require_once "../../vendor/autoload.php";
	$collection = (new MongoDB\Client)->mydb->salesvisits;


	$cursor = $collection->find(['spid' => $spid]);
	$data = '<div class="row">';

	foreach ($cursor as $document) {
    	$cid = $document['cid'];
    	$is_product_available = $document['is_product_available'];
    	$is_product_in_front = $document['is_product_in_front'];
    	$is_competitor = $document['is_competitor'];
    	$timestamp = $document['timestamp'];
    	$image = $document['image'];
    	$lat = $document['lat'];
    	$long = $document['long'];
        $id = $document['_id'];

    	$image_html = '<img src="data:jpeg;base64,' . base64_encode($image->getData()) .'" />';


    	$cname = "";
    	$query = "SELECT * FROM customers_13005 WHERE cid =" . $cid;

    	if (!$result = mysqli_query($con, $query)) {
    	        exit(mysqli_error($con));
    	}

    	while($row = mysqli_fetch_assoc($result)) {
    	    	$cname = $row['cname'];
    	}

    	$data .='
    	  <div class="col-sm-6 col-md-4">
    	    <div class="thumbnail bg-warning">' . 
    	    	$image_html
    	      . '<div class="caption">
    	        <h3>Shop\'s picture of ' . $cname . '</h3>
    	        <p>
    	        	<ul class="list-group">
    	        	  <li class="list-group-item"><em>Timestamp: </em>'. date('m/d/Y H:i:s',$timestamp) .'</li>
    	        	  <li class="list-group-item"><em>Geographical Coordinates: </em>'. $lat . ',' . $long . ')</li>
    	        	  <li class="list-group-item"><em>Is Product Available?: </em>('. $is_product_available .'</li>
    	        	  <li class="list-group-item"><em>Is Product Positioned In Front?: </em>'. $is_product_in_front .'</li>
    	        	  <li class="list-group-item"><em>Is Competitor\'s Products More Promiment?: </em>'. $is_competitor .'</li>
    	        	</ul>


                <div class="map" id="'. $id . '">

                </div>


                <script>
                var mymap = L.map(\'' . $id . '\').setView(['. $lat .','. $long . '], 14);


                L.tileLayer(\'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}\', {
                    attribution: \'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> \',
                    maxZoom: 18,
                    id: \'mapbox.streets\',
                    accessToken: \'pk.eyJ1Ijoic21zYWxpOTciLCJhIjoiY2pvZW04cTkwMDEzMjNrczkyMjlyN2RqcSJ9.xC352ob5YggCwK_Xw1V7kw\'
                }).addTo(mymap);

                var marker = L.marker(['. $lat .','. $long . ']).addTo(mymap);

                </script>
                <br>
                    <a class="delete-visit btn btn-danger"
                    onClick=deleteVisit(\'' . $id . '\')>
                    <span class="glyphicon glyphicon-trash"></span>
                    </a>
                
                </p>

    	      </div>
    	    </div>
    	  </div>
    	</div>';


	
	}

	echo $data;

	return $data;

?> 