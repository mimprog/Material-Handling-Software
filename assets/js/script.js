function preventBack() {
  window.history.forward();
}
setTimeout('preventBack()', 0);
window.onunload = function () {
  null;
};

$(document).ready(function () {
  $('#location-btn').on('click', function (e) {
    event.preventDefault();
    $('#location-input').removeClass('invisible');
  });

  $('#mtag-btn').on('click', function (e) {
    event.preventDefault();
    $('#material-tag').removeClass('invisible');
  });

  var bookingId = $('.bookingId_input').val();

  //check location
  $('#location-input').keyup(function () {
    var location = $(this).val();
    $.ajax({
      url: 'marlon_functions.php?bookingId=' + bookingId,
      method: 'POST',
      data: { location: location },
      success: function (data) {
        if (data == 0) {
          $('#location_alert').html(
            '<p class="text-danger">WRONG LOCATION</p>'
          );
          $('#location-btn').prop('disabled', true);
        }
        if (data == 1) {
          $('#location_alert').html(
            '<p class="text-success">CORRECT LOCATION</p>'
          );
          $('#location-btn').prop('disabled', false);

          $('#location-btn').on('click', function (e) {
            window.location.href =
              'marlon_materialTag.php?bookingId=' + bookingId;
          });
        }
        if (location.length == 0) {
          $('#location_alert').html('');
        }
      },
    });
  });
  //---------

  //check material tag
  $('#material-tag').keyup(function () {
    var materialtag = $(this).val();
    $.ajax({
      url: 'marlon_functions.php?bookingId=' + bookingId,
      method: 'POST',
      data: { materialtag: materialtag },
      success: function (data) {
        if (data == 0) {
          $('#mtag_alert').html(
            '<p class="text-danger">WRONG MATERIAL TAG</p>'
          );
          $('#mtag-btn').prop('disabled', true);
        }
        if (data == 1) {
          $('#mtag_alert').html(
            '<p class="text-success">CORRECT MATERIAL TAG</p>'
          );
          $('#mtag-btn').prop('disabled', false);

          $('#mtag-btn').on('click', function (e) {
            window.location.href =
              'marlon_materialDetails.php?bookingId=' + bookingId;
          });
        }
        if (materialtag.length == 0) {
          $('#mtag_alert').html('');
        }
      },
    });
  });
  //---------

  //update status
  $('#mdetails-btn').on('click', function () {
    event.preventDefault();
    $.ajax({
      url: 'marlon_functions.php?bookingId=' + bookingId + '&updateStatus=1',
      method: 'POST',
      success: function (data) {
        if (data == 0) {
          window.location.href = 'marlon_reviewMaterials.php';
        }
        if (data == 1) {
          $('#mdetails-btn').prop('disabled', true);
          swal(
            {
              title: 'Would you like to check another material?',
              type: 'info',
              closeOnConfirm: false,
              showCancelButton: true,
              confirmButtonText: 'YES',
              cancelButtonText: 'NO',
            },
            function (isConfirm) {
              if (isConfirm) {
                window.location.href =
                  'marlon_functions.php?action=nextBookingId';
              } else {
                window.location.href = 'marlon_reviewMaterials.php';
              }
            }
          );
        }
      },
    });
  });
  //---------

  $('#selectId').on('click', function (e) {
    var firstbookingId = $('#requested_material_table tbody tr')
      .find('td:nth-child(1)')
      .html();
    console.log(firstbookingId);
    window.location.href = 'marlon_newRequest.php?bookingId=' + firstbookingId;
  });

  $('#ongoingBtn').on('click', function (e) {
    swal(
      {
        title: 'Go to Production',
        confirmButtonClass: 'btn-primary',
        confirmButtonText: 'OK',
      },
      function () {
        window.location.href = 'marlon_inputLocation.php';
      }
    );
  });

  $('#set-location').keyup(function (e) {
    var setLocationInput = $(this).val();

    if (setLocationInput.length > 0) {
      $('#set-location-btn').prop('disabled', false);
    } else {
      $('#set-location-btn').prop('disabled', true);
    }
  });

  //update location and status
  $('#set-location-btn').on('click', function (e) {
    event.preventDefault();
    var setLocation = $('#set-location').val();
    $.ajax({
      url: 'marlon_functions.php?location=' + setLocation,
      method: 'POST',
      success: function (data) {
        if (data == 'success') {
          swal(
            {
              title: 'Material successfully transferred',
              type: 'success',
              confirmButtonClass: 'btn-primary',
              confirmButtonText: 'OK',
            },
            function () {
              $('#set-location-btn').prop('disabled', true);
              window.location.href = 'index.php';
            }
          );
        } else {
          swal('Something went wrong!', '', 'error');
        }
      },
    });
  });
  //---------------
});
