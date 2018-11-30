<?php
include("db_connection.php");

?>




<!DOCTYPE html>
<html>
  <head>    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Testing Pie Chart</title>
   <!--<script type="text/javascript" src="d3/d3.v2.js"></script>-->
    <script src="http://d3js.org/d3.v3.js"></script>
	<!-- Note: I made good use of the sample code provided by the D3JS community and extended it to fit my needs to create this simple dashboard -->
    <style type="text/css">


#pieChart {    
	position:absolute;
	top:10px;
	left:10px;
	width:400px;
	height: 400px; 
}



#lineChart {    
	position:absolute;
	top:10px;
	left:410px;
	height: 150px;
}

#barChart {
	position:absolute;
	top:160px;
	left:410px;
	height: 250px;
}

.slice {
   font-size: 12pt;
   font-family: Verdana;
   fill: white; //svg specific - instead of color
   font-weight: bold;	
  		} 

/*for line chart*/
.axis path, .axis line {
    fill: none;
    stroke: black;
    shape-rendering: crispEdges; //The shape-rendering property is an SVG attribute, used here to make sure our axis and its tick mark lines are pixel-perfect. 
}

.line {
  fill: none;
  /*stroke: steelblue;*/
  stroke-width: 3px;
}

.dot {
  /*fill: white;*/
  /*stroke: steelblue;*/
  stroke-width: 1.5px;
  }
				

.axis text {
    font-family: Verdana;
    font-size: 11px;
}

.title {
	 font-family: Verdana;
    font-size: 15px;	
		
}

.xAxis {
    font-family: verdana;
    font-size: 11px;
    fill: black;
}  

.yAxis {
    font-family: verdana;
    font-size: 11px;
    fill: white;
}

  
table {
	border-collapse:collapse;
	border: 0px;	
	font-family: Verdana;	
	color: #5C5558;
	font-size: 12px;
	text-align: right;			
}

td {
	padding-left: 10px;		
}

#lineChartTitle1 {
	font-family: Verdana;
	font-size  : 14px;
	fill       : lightgrey;
	font-weight: bold;
	text-anchor: middle;
}

#lineChartTitle2 {
	font-family: Verdana;
	font-size  : 72px;
	fill       : grey;
	text-anchor: middle;
	font-weight: bold;
	/*font-style: italic;*/
}
				 
    </style>
  </head>
  <body>
  
    <div id="pieChart"></div>
    <div id="barChart"></div>  
    <div id="lineChart"></div>
    <script type="text/javascript">
    
/*
################ FORMATS ##################
-------------------------------------------
*/


var 	formatAsPercentage = d3.format("%"),
		formatAsPercentage1Dec = d3.format(".1%"),
		formatAsInteger = d3.format(","),
		fsec = d3.time.format("%S s"),
		fmin = d3.time.format("%M m"),
		fhou = d3.time.format("%H h"),
		fwee = d3.time.format("%a"),
		fdat = d3.time.format("%d d"),
		fmon = d3.time.format("%b")
		;

/*
############# PIE CHART ###################
-------------------------------------------
*/



function dsPieChart(dataset){


	var 	width = 400,
		   height = 400,
		   outerRadius = Math.min(width, height) / 2,
		   innerRadius = outerRadius * .999,   
		   // for animation
		   innerRadiusFinal = outerRadius * .5,
		   innerRadiusFinal3 = outerRadius* .45,
		   color = d3.scale.category20()    //builtin range of colors
		   ;
	    
	var vis = d3.select("#pieChart")
	     .append("svg:svg")              //create the SVG element inside the <body>
	     .data([dataset])                   //associate our data with the document
	         .attr("width", width)           //set the width and height of our visualization (these will be attributes of the <svg> tag
	         .attr("height", height)
	     		.append("svg:g")                //make a group to hold our pie chart
	         .attr("transform", "translate(" + outerRadius + "," + outerRadius + ")")    //move the center of the pie chart from 0, 0 to radius, radius
				;
				
   var arc = d3.svg.arc()              //this will create <path> elements for us using arc data
        	.outerRadius(outerRadius).innerRadius(innerRadius);
   
   // for animation
   var arcFinal = d3.svg.arc().innerRadius(innerRadiusFinal).outerRadius(outerRadius);
	var arcFinal3 = d3.svg.arc().innerRadius(innerRadiusFinal3).outerRadius(outerRadius);

   var pie = d3.layout.pie()           //this will create arc data for us given a list of values
        .value(function(d) { return d.measure; });    //we must tell it out to access the value of each element in our data array

   var arcs = vis.selectAll("g.slice")     //this selects all <g> elements with class slice (there aren't any yet)
        .data(pie)                          //associate the generated pie data (an array of arcs, each having startAngle, endAngle and value properties) 
        .enter()                            //this will create <g> elements for every "extra" data element that should be associated with a selection. The result is creating a <g> for every object in the data array
            .append("svg:g")                //create a group to hold each slice (we will have a <path> and a <text> element associated with each slice)
               .attr("class", "slice")    //allow us to style things in the slices (like text)
               .on("mouseover", mouseover)
    				.on("mouseout", mouseout)
    				.on("click", up)
    				;
    				
        arcs.append("svg:path")
               .attr("fill", function(d, i) { return color(i); } ) //set the color for each slice to be chosen from the color function defined above
               .attr("d", arc)     //this creates the actual SVG path using the associated data (pie) with the arc drawing function
					.append("svg:title") //mouseover title showing the figures
				   .text(function(d) { return d.data.category + ": " + formatAsPercentage(d.data.measure); });			

        d3.selectAll("g.slice").selectAll("path").transition()
			    .duration(750)
			    .delay(10)
			    .attr("d", arcFinal )
			    ;
	
	  // Add a label to the larger arcs, translated to the arc centroid and rotated.
	  // source: http://bl.ocks.org/1305337#index.html
	  arcs.filter(function(d) { return d.endAngle - d.startAngle > .2; })
	  		.append("svg:text")
	      .attr("dy", ".35em")
	      .attr("text-anchor", "middle")
	      .attr("transform", function(d) { return "translate(" + arcFinal.centroid(d) + ")rotate(" + angle(d) + ")"; })
	      //.text(function(d) { return formatAsPercentage(d.value); })
	      .text(function(d) { return d.data.category; })
	      ;
	   
	   // Computes the label angle of an arc, converting from radians to degrees.
		function angle(d) {
		    var a = (d.startAngle + d.endAngle) * 90 / Math.PI - 90;
		    return a > 90 ? a - 180 : a;
		}
		    
		
		// Pie chart title			
		vis.append("svg:text")
	     	.attr("dy", ".35em")
	      .attr("text-anchor", "middle")
	      .text("Revenue Share 2012")
	      .attr("class","title")
	      ;		    


		
	function mouseover() {
	  d3.select(this).select("path").transition()
	      .duration(750)
	        		//.attr("stroke","red")
	        		//.attr("stroke-width", 1.5)
	        		.attr("d", arcFinal3)
	        		;
	}
	
	function mouseout() {
	  d3.select(this).select("path").transition()
	      .duration(750)
	        		//.attr("stroke","blue")
	        		//.attr("stroke-width", 1.5)
	        		.attr("d", arcFinal)
	        		;
	}
	
	function up(d, i) {
	
				/* update bar chart when user selects piece of the pie chart */
				//updateBarChart(dataset[i].category);
				updateBarChart(d.data.category, color(i));
				updateLineChart(d.data.category, color(i));
			 
	}
}

d3.json("salesDistribution.php", (error, data) => dsPieChart(data));


    </script>
  </body>
</html>