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
		readSalesOrderLines();
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

function addSalesOrderLine() {
	let qty = $("#qty").val();
    let rate = $("#rate").val();
    let amount = qty*rate;
 	let pid = $(".product option:selected").val();
 	let order_no = $("#hidden_order_no").val();

 	let data = {
 		qty: qty,
 		rate: rate,
 		amount: amount,
 		pid: pid,
 		order_no: order_no
 	}

 	$.post("ajax/addSalesOrderLine.php", data,
 		function (data,status) {
 			readSalesOrderLines();
 			$("#add_new_salesorderline_modal").modal("hide");
 			$("#qty").val();
    		$("#rate").val();
            
    
 		});

}

function readSalesOrderLines() {
	let order_no = $("#hidden_order_no").val();

 	let data = {
 		order_no: order_no
 	}

 	$.post("ajax/readSalesOrderLines.php", data,
 		function (data,status) {
 			 $(".records_content2").html(data);
 		});
}

function deleteRecord(order_no,pid) {
	var conf = confirm("Are you really really sure, do you really want to delete the entry?");
    if (conf == true) {
        $.post("ajax/deleteRecord.php", {
                order_no: order_no,
                pid: pid,
            },
            function (data, status) {
                readSalesOrderLines();
            }
        );
    }
}

function editRecord(order_no,pid) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_order_no").val(order_no);
    $("#hidden_pid").val(pid);
    $.post("ajax/viewRecordDetails.php", {
            pid: pid,
            order_no: order_no
        },
        function (data, status) {
            // PARSE json data
            let record = JSON.parse(data);
            // Assignng existing values to the modal popup fields
            $('[name=updated_product]').val(record.pid);
            $("#updated_qty").val(record.qty);
            $("#updated_rate").val(record.rate);
            
        }
    );
    // Open modal popup
    $("#update_modal").modal("show");
}

function updateRecordDetails() {
    // get values
    let qty = $("#updated_qty").val();
    let rate = $("#updated_rate").val();
    let h_pid = $("#hidden_pid").val();
    let order_no = $("#hidden_order_no").val();
    let pid = $(".updated_product option:selected").val();
    let amount = qty * rate;

    // Update the details by requesting to the server using ajax
    $.post("ajax/updateRecordDetails.php", {
            qty: qty,
            rate: rate,
            amount: amount,
            pid: h_pid,
            order_no : order_no
        },
        function (data, status) {

            // hide modal popup
            $("#update_modal").modal("hide");
            // reload Users by using readRecords();
            readSalesOrderLines();
        }
    );
}
