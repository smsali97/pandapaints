

$(document).ready( function() {
	createSalesOrderTable();
});



// Update Customer related fields
$('#customer').change(function() {
    let cid = $(this).val();

    $.post("ajax/getCustomerValues.php", {
        cid: cid
    }, function (data, status) {
    	  let r= JSON.parse(data);

    	  $("#hidden_cid").val(r.cid);
    	  $("#hidden_spid").val(r.spid);
    });

});


function addSalesOrder(){
	cid = $("#hidden_cid").val();
	spid = $("#hidden_spid").val();

	$.post("ajax/addSalesOrder.php",{
		cid: cid,
		spid: spid
	}, function (data, status) {
		$("#hidden_order_no").val(data);
		$("#new_sales_order").attr("disabled", true);
		$("#add_new_record_modal").modal("hide");
		createSalesOrderTable();
		$("#salesorderlines").show();
	});	
}

function createSalesOrderTable() {
	cid = $("#hidden_cid").val();
	spid = $("#hidden_spid").val();
	order_no = $("#hidden_order_no").val();

	$.post("ajax/createSalesOrderTable.php", {
		cid: cid,
		spid: spid,
		order_no: order_no
	},
		function (data, status) {
			$(".records_content").html(data);

	});
}

