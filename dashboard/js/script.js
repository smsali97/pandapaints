
function render() {
	let spid = $(".salesperson option:selected").val();
	$.ajax({
		url: "salesDistribution.php",
		method: "POST",
		data: { spid },
		success: function(data) {
		    $("#chart-container").empty();
		    $("#chart-container").html('<canvas id="bargraph"></canvas>');
			data = JSON.parse(data);
			var Customer = [];
			var Total = [];
			for(var i in data) {
				Customer.push(data[i].Customer);
				Total.push(parseFloat(data[i].Total));
			}

			var chartdata = {
				labels: Customer,
				datasets : [
					{
						label: 'Total Sales in PKR',
						backgroundColor: '#49e2ff',
						borderColor: '#46d5f1',
						hoverBackgroundColor: '#CCCCCC',
						hoverBorderColor: '#666666',
						data: Total
					}
				]
			};

			var ctx = $("#bargraph");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
};

$("#salesperson_select").on('change',render);


$(document).ready(function() {
	
	render()
	$.ajax({
		url : "productDistribution.php",
		type : "GET",
		success : function(data){
			data = JSON.parse(data);
			console.log(data);

			Brand = []
			Freq = []

			var len = data.length;

			for (var i = 0; i < len; i++) {
				Freq.push(data[i].Frequency);
				Brand.push(data[i].Brand);
			}

			var ctx1 = $("#piechart1");

			var data1 = {
				labels : Brand,
				datasets : [
					{
						label : "Number of Items of Brand",
						data : Freq,
						backgroundColor : [
		                    "#DEB887",
		                    "#A9A9A9",
		                    "#DC143C",
		                    "#F4A460",
		                    "#2E8B57"
		                ],
		                borderColor : [
		                    "#CDA776",
		                    "#989898",
		                    "#CB252B",
		                    "#E39371",
		                    "#1D7A46"
		                ],
		                borderWidth : [1, 1, 1, 1, 1]
					}
				]
			};

			var options = {
				title : {
					display : true,
					position : "top",
					text : "Brand Popularity",
					fontSize : 18,
					fontColor : "#111"
				},
				legend : {
					display : true,
					position : "bottom"
				}
			};


			var chart1 = new Chart( ctx1, {
				type : "doughnut",
				data : data1,
				options : options
			});

		},
		error : function(data) {
			console.log(data);
		}
	});


	$.ajax({
		url : "productDistribution2.php",
		type : "GET",
		success : function(data){
			data = JSON.parse(data);
			Size = []
			Freq = []

			var len = data.length;

			for (var i = 0; i < len; i++) {
				Freq.push(data[i].Frequency);
				Size.push(data[i].Size);
			}

			var ctx1 = $("#piechart2");

			var data2 = {
				labels : Size,
				datasets : [
					{
						label : "Number of Items of Size",
						data : Freq,
						backgroundColor : [
		                    "#F7464A",
		                    "#46BFBD",
		                    "#FDB45C",
		                ],
		                borderWidth : [1, 1, 1, 1, 1]
					}
				]
			};

			var options = {
				title : {
					display : true,
					position : "top",
					text : "Size Popularity",
					fontSize : 18,
					fontColor : "#111"
				},
				legend : {
					display : true,
					position : "bottom"
				}
			};


			var chart2 = new Chart( ctx1, {
				type : "doughnut",
				data : data2,
				options : options
			});

		},
		error : function(data) {
			console.log(data);
		}
	});

	/**
		 * call the data.php file to fetch the result from db table.
		 */
		$.ajax({
			url : "timesDistribution.php",
			type : "GET",
			success : function(data){
				data = JSON.parse(data);

				var dates = [];
				var freq = [];

				var len = data.length;

				for (let i = 0; i < len; i++) {
					dates.push(data[i].Date)
					freq.push(data[i].Frequency);
				}

				console.log(dates);

				//get canvas
				var ctx = $("#linegraph");

				var data = {
					labels : dates,
					datasets : [
						{
							label : "Number of Orders",
							data : freq,
							backgroundColor : "blue",
							borderColor : "lightblue",
							fill : false,
							lineTension : 0,
							pointRadius : 5
						}
					]
				};

				var options = {
					title : {
						display : true,
						position : "top",
						text : "Number of Sales Orders Over Time",
						fontSize : 18,
						fontColor : "#111"
					},
					legend : {
						display : true,
						position : "bottom"
					}
				};

				var chart = new Chart( ctx, {
					type : "line",
					data : data,
					options : options
				} );

			},
			error : function(data) {
				console.log(data);
			}
		});


});