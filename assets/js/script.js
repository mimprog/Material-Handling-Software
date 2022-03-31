// function preventBack() {
//   window.history.forward();
// }
// setTimeout('preventBack()', 0);
// window.onunload = function () {
//   null;
// };

$(document).ready(function () {
  $('#set-location').focus();

  $('#location-btn').on('click', function (e) {
    e.preventDefault();
    $('#location-input').removeClass('invisible');
    $('#location-input').focus();
  });

  $('#mtag-btn').on('click', function (e) {
    e.preventDefault();
    $('#material-tag').removeClass('invisible');
    $('#material-tag').focus();
  });

  var bookingId = $('.bookingId_input').val();

  //check location
  $('#location-input').keyup(function () {
    var location = $(this).val();
    $.ajax({
      url: './controllers/marlon_controller.php?bookingId=' + bookingId,
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
      url: './controllers/marlon_controller.php?bookingId=' + bookingId,
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
  $('#mdetails-btn').on('click', function (e) {
    e.preventDefault();
    $.ajax({
      url:
        './controllers/marlon_controller.php?bookingId=' +
        bookingId +
        '&updateStatus=1',
      method: 'POST',
      success: function (data) {
        if (data == 0) {
          window.location.href = 'marlon_reviewMaterials.php';
        }
        if (data == 1) {
          $('#mdetails-btn').prop('disabled', true);
          Swal.fire({
            title: 'Would you like to check another material?',
            text: '',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'YES',
            denyButtonText: 'NO',
            allowOutsideClick: false,
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href =
                './controllers/marlon_controller.php?action=nextBookingId';
            } else if (result.isDenied) {
              window.location.href = 'marlon_reviewMaterials.php';
            }
          });
        }
      },
    });
  });
  //---------

  $('#selectId').on('click', function (e) {
    window.location.href = 'index.php';
  });

  $('#ongoingBtn').on('click', function (e) {
    Swal.fire({
      title: 'Go to Production',
      text: '',
      icon: 'info',
      confirmButtonText: 'OK',
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'marlon_inputLocation.php';
      }
    });
  });

  $('#set-location').keyup(function (e) {
    var setLocationInput = $(this).val();

    if (setLocationInput.length > 0) {
      $('#set-location-btn').removeClass('disable');
    } else {
      $('#set-location-btn').addClass('disable');
    }
  });

  //update location and status
  $('#set-location-btn').on('click', function (e) {
    e.preventDefault();
    $(this).addClass('disable');
    $(this).html('PLEASE WAIT');
    var setLocation = $('#set-location').val();
    $.ajax({
      url: './controllers/marlon_controller.php?location=' + setLocation,
      method: 'POST',
      success: function (data) {
        if (data == 'success') {
          Swal.fire({
            title: 'Material successfully transferred',
            text: '',
            icon: 'success',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
          }).then((result) => {
            if (result.isConfirmed) {
              $(this).removeClass('disable');
              $(this).html('OK');
              window.location.href = 'index.php';
            }
          });
        } else {
          swal('Something went wrong!', '', 'error');
        }
      },
    });
  });
  //---------------

  var reviewTotalRecords = $('#reviewTotalRecords').html();
  if (reviewTotalRecords == 0) {
    $('#ongoingBtn').prop('disabled', true);
  }

  //remove booking
  $('#review_material_table tbody').on('click', 'i', function () {
    let bookingId = $(this).closest('tr').children('td:first').text();
    let quantity = $(this).closest('tr').children('td:nth-child(3)').text();
    let totalQuantity = $('#total b').html();
    let recordCount = $('#reviewTotalRecords').html();
    let selected = $(this).closest('tr');

    $(this).addClass('disable');

    $.ajax({
      url:
        './controllers/marlon_controller.php?bookingId=' +
        bookingId +
        '&action=remove',
      method: 'GET',
      success: function (response) {
        if (response == 1) {
          selected.remove();
          $('#reviewTotalRecords').html(recordCount - 1);
          $('#total b').html(totalQuantity - quantity);
          $(this).removeClass('disable');
          if ($('#reviewTotalRecords').html() == 0) {
            $('#ongoingBtn').prop('disabled', true);
            window.location.href = 'index.php';
          }
        }
      },
    });
  });
});
