function addRecord() {
    // get values
    let qty = $("#qty").val();
    let rate = $("#rate").val();
    let amount = qty*rate;
    let cid = $(".customer option:selected").val();    
    let pid = $(".product option:selected").val();


    // Add record
    $.post("ajax/addRecord.php", {
        qty: qty,
        rate: rate,
        amount: amount,
        cid: cid,
        pid: pid
    }, function (data, status) {
    	alert(data);
        // close the popup
        $("#add_new_record_modal").modal("hide");

 
        // read records again
        readRecords();
 
        // clear fields from the popup
        $("#qty").val("");
        $("#rate").val("");
    });
};

function viewRecordDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_id").val(id);
    $.post("ajax/viewRecordDetails.php", {
            id: id
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
    let id = $("#hidden_id").val();
    let pid = $(".updated_product option:selected").val();
    let amount = qty * rate;

    // Update the details by requesting to the server using ajax
    $.post("ajax/updateRecordDetails.php", {
            qty: qty,
            rate: rate,
            amount: amount,
            pid: pid,
            id : id
        },
        function (data, status) {

            // hide modal popup
            $("#update_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}


function readRecords() {
	let cid = $(".customer option:selected").val();
	 $.post("ajax/readRecords.php", {
	 	cid: cid,
	 }, function (data, status) {
	        $(".records_content").html(data);
	});
};

function deleteRecord(id) {
    var conf = confirm("Are you really really sure, do you really want to delete the Sales Order?");
    if (conf == true) {
        $.post("ajax/deleteRecord.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
}


$(document).ready( function() {
	 $("select.customer").change(function(){
	 		readRecords(); 
      });
	readRecords();
});
