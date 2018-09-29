// Add Record 
function addRecord() {
    // get values
    var pcode = $("#pcode").val();
    var brand = $("#brand").val();
    var type  = $('input[name=optradio]').filter(":checked").val();
    var size = $('input[name=optradio2]').filter(":checked").val();
    var shade = $("#shade").val();
    var sales_price = $("#sales_price").val();



    // Add record
    $.post("ajax/addRecord.php", {
        pcode: pcode,
        brand: brand,
        type: type,
        size: size,
        shade: shade,
        sales_price: sales_price
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

 
        // read records again
        readRecords();
 
        // clear fields from the popup
        $("#pcode").val("");
        $("#brand").val("");
        $("#color").val("");
        $("#sales_price").val("");
    });
}
    
$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
});
 
// READ records
function readRecords() {
    $.get("ajax/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    })};






function deleteRecord(id) {
    var conf = confirm("Are you sure, do you really want to delete the Product?");
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

function viewRecordDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_id").val(id);
    $.post("ajax/viewRecordDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var record = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#updated_pcode").val(record.pcode);
            $("#updated_brand").val(record.brand);
            $("#updated_type").val(record.type);
            $("#updated_shade").val(record.shade);
            $("#updated_size").val(record.size);
            $("#updated_sales_price").val(record.sales_price);
        }
    );
    // Open modal popup
    $("#update_modal").modal("show");
}

function updateRecordDetails() {
    // get values
    var pcode = $("#updated_pcode").val();
    var brand = $("#updated_brand").val();
    var type  = $('input[name=updated_optradio]').filter(":checked").val();
    var size = $('input[name=updated_optradio2]').filter(":checked").val();
    var sales_price = $("#updated_sales_price").val();
    var id = $("#hidden_id").val();
    var shade = $("#updated_shade").val();


    // Update the details by requesting to the server using ajax
    $.post("ajax/updateRecordDetails.php", {
            pcode: pcode,
            brand: brand,
            type: type,
            shade: shade,
            size: size,
            sales_price: sales_price,
            id: id
        },
        function (data, status) {
            
            // hide modal popup
            $("#update_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}