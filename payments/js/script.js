function addPayment() {
	amount = $("#amount").val();
	cid = $("#add_customer option:selected").val();
	spid = $("#add_salesperson").attr('data-id');

	if (amount == "") {
		alert("fill the amount first dummy!");
	}
	else {
		$.post("ajax/addPayment.php",{
			amount, cid, spid
		}, (data, status) => {
			$("#amount").val("");
			text = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'
			+ data + '</strong></div>';
			$('#message_area').after(data);
		});
	}

}

function deletePayment(id) {
	$.post("ajax/deletePayment.php", {
		id
	}, (data, status) => {
		location.reload();
	});
}


function editPayment(id) {
	$.post("ajax/viewRecordDetails.php", {
		id
	},
	function (data, status) {
            // PARSE json data
            var record = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#hidden_id").val(id);
            // console.error(record);
            $("#updated_amount").val(record.amount);
            
            $("#update_modal").modal("show");
        }
        );
}

function updateRecordDetails() {

	let amount = $("#updated_amount").val();
	let cid = $("#add_customer option:selected").val();
	var id = $("#hidden_id").val();


	if (amount == "") {
		alert("fill the amount first dummy!");
	}
	else {
		$.post("ajax/updatePayment.php",{
			amount, cid, id
		}, (data, status) => {
			$("#updated_amount").val("");
			$("#update_modal").modal("hide");
			location.reload();
			text = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'
			+ ' Updated ' + '</strong></div>';
			$('#message_area').html(text);
		});
	}
}