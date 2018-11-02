
// Add Record 
function addRecord() {
    // get values
    var sp_name = $("#sp_name").val();
    var cno = $("#cno").val();
    var username = $("#username").val();
    var password = $("#username").val();
    var confirm_password = $("#confirm_password").val();

    if(username == "")
    {
        alert("username field is required!");
    }
    else if (password == "")
    {
        alert("Password field is required!");
    }
    else if(confirm_password == "")
    {
        alert("Confirm Password field is required!");
    }
    else if(confirm_password != password)
    {
        alert("Invalid Confirm password!");
    }
        else if(sp_name == "" || cno == "")
    {
        alert("Missing Salesperson Information!");
    }

    else
    {
        
        // Add record
        $.post("ajax/addRecord.php", {
            sp_name: sp_name,
            cno: cno,
            username: username,
            password: password,
        }, function (data, status) {
            // close the popup
            $("#add_new_record_modal").modal("hide");

     
            // read records again
            readRecords();
     
            // clear fields from the popup
            $("#sp_name").val("");
            $("#cno").val("");
            $("#username").val("");
            $("#password").val("");
            $("#confirm_password").val("");
        });

    }

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
    var conf = confirm("Are you sure, do you really want to delete the Salesperson?");
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
            $("#updated_sp_name").val(record.spname);
            $("#updated_cno").val(record.cno);
        }
    );
    // Open modal popup
    $("#update_modal").modal("show");
}

function updateRecordDetails() {
    // get values
    var id = $("#hidden_id").val();
    var sp_name = $("#updated_sp_name").val();
    var cno = $("#updated_cno").val();



    // Update the details by requesting to the server using ajax
    $.post("ajax/updateRecordDetails.php", {
            id: id,
            sp_name: sp_name,
            cno: cno
        },
        function (data, status) {
            
            // hide modal popup
            $("#update_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}
