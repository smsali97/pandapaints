
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
    var conf = confirm("Are you sure, do you really want to delete the User?");
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
