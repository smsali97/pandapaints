// Add Record 
function addRecord() {
    // get values
    var shop_name = $("#shop_name").val();
    var customer_name = $("#customer_name").val();
    var address = $("#address").val();
    var area = $("#area").val();
    var gc = $("#gc").val();
    var cno = $("#cno").val();
    
    if(shop_name == "")
    {
        alert("Shop Name field is required!");
    }
    else if (customer_name == "")
    {
        alert("A Customer is required! duh!");
    }
    else if(address == "")
    {
        alert("address field is required!");
    }
    else if(area == "")
    {
        alert("area field is required!");
    }
    else if(gc == "")
    {
        alert("Geo Coords. field is required");
    }

    else if(cno == "")
    {
        alert("Contact Number field is required! ");
    }

    else
    {
    // Add record
    $.post("ajax/addRecord.php", {
        shop_name: shop_name,
        customer_name: customer_name,
        address: address,
        area: area,
        gc: gc,
        cno: cno
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
        $("#shop_name").val();
        $("#customer_name").val();
        $("#address").val();
        $("#area").val();
        $("#gc").val();
        $("#cno").val();
    });

    }
}

// READ records
function readRecords() {
    $.get("ajax/readRecords.php", {}, function (data, status) {

        $(".records_content").html(data);
    });
}

$(document).ready(function () {
        
    // READ recods on page load
    readRecords(); // calling function
});

function deleteRecord(id) {
    var conf = confirm("Are you sure, do you really want to delete the Customer?");
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

            // console.error(record);
            $("#updated_shop_name").val(record.sname);
            $("#updated_customer_name").val(record.cname);
            $("#updated_address").val(record.address);
            $("#updated_area").val(record.area);
            $("#updated_gc").val(record.gc);
            $("#updated_cno").val(record.cno);
        }
    );
    // Open modal popup
    $("#update_modal").modal("show");
}


function updateRecordDetails() {
    // get values
    var shop_name = $("#updated_shop_name").val();
    var customer_name = $("#updated_customer_name").val();
    var address = $("#updated_address").val();
    var area = $("#updated_area").val();
    var gc = $("#updated_gc").val();
    var cno = $("#updated_cno").val();
    // get hidden field value
    var id = $("#hidden_id").val();

    if(shop_name == "")
    {
        alert("Shop Name field is required!");
    }
    else if (customer_name == "")
    {
        alert("A Customer is required! duh!");
    }
    else if(address == "")
    {
        alert("address field is required!");
    }
    else if(area == "")
    {
        alert("area field is required!");
    }
    else if(gc == "")
    {
        alert("Geo Coords. field is required");
    }

    else if(cno == "")
    {
        alert("Contact Number field is required! ");
    }
    else {

        // Update the details by requesting to the server using ajax
        $.post("ajax/updateRecordDetails.php", {
                id: id,
                shop_name: shop_name,
                customer_name: customer_name,
                address: address,
                area: area,
                gc: gc,
                cno: cno,
            },
            function (data, status) {

                console.error(data);
                // hide modal popup
                $("#update_modal").modal("hide");
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
}