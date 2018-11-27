
// Geo coordinates
const gc = {
    lat: -1,
    long: -1,
}


$(document).ready ( () => {
    getLocation();
    readSalesVisits();
})





function deleteVisit(id) {
    alert(id);
    $.ajax({
    url: "ajax/deleteVisit.php",
    type: "POST",
    data: { id },
    success: function (data, status) {
      alert(data);
      readSalesVisits();
    }
  });

}


function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    gc.lat = position.coords.latitude;
    gc.long =  position.coords.longitude;

  let text ='<div class="alert alert-success"><strong>Success!</strong> Location added using GPS</div>';
  $(".container").prepend(text);

}

function readSalesVisits() {

    $.post("ajax/readSalesVisits.php", {
    }, function (data, status) {
            $(".records_content").html(data);
        }
    );   
}

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



$("form[name='my-form']").submit(function(e) {

        if ($('#latitude').val() == "" && $('#longitude').val() == "") {
                  coords = "(" + gc.lat + "," + gc.long + ")";
        }
        else {
           coords = "(" + $('#latitude').val() + "," + $('#longitude').val()  + ")";
        }

        let spid = $("#hidden_spid").val();
        let cid = $("#hidden_cid").val();
        let is_product_available = "No";
        let is_product_in_front = "No";
        let is_competitor = "No";

                                                                        
        if ($('#is_product_available').is(':checked')) {
            is_product_available = "Yes";
        }
        if ($('#is_product_in_front').is(':checked')) {
            is_product_in_front = "Yes";
        }
        if ($('#is_competitor').is(':checked')) {
            is_competitor = "Yes";
        }




  var formData = new FormData($(this)[0]);
  formData.append("cid",cid);
  formData.append("spid",spid);
  formData.append("is_product_available",is_product_available);
  formData.append("is_product_in_front",is_product_in_front);
  formData.append("is_competitor",is_competitor);
  formData.append("lat",gc.lat);
  formData.append("long",gc.long);


  $.ajax({
    url: "ajax/addSalesVisit.php",
    type: "POST",
    data: formData,
    success: function (msg) {
      readSalesVisits();
    },
    cache: false,
    contentType: false,
    processData: false
  });

  e.preventDefault();

});
