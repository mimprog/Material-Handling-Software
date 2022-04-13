// function preventBack() {
//   window.history.forward();
// }
// setTimeout('preventBack()', 0);
// window.onunload = function () {
//   null;
// };
$('.loader').hide();

$(document).ready(function () {
  $('#set-location').focus();
  var bookingId = $('.bookingId_input').val();

  //check location
  let locationInput = $('#location-input');
  $('#location-btn').one('click', function (e) {
    e.preventDefault();
    locationInput.removeClass('invisible');
    locationInput.focus();
  });

  $('#location-btn').on('click', function (e) {
    e.preventDefault();

    if (!locationInput.hasClass('invisible') && locationInput.val() != '') {
      checkLocation();
    }
  });

  function checkLocation() {
    let location = $('#location-input').val();
    $.ajax({
      url: './controllers/marlon_controller.php?bookingId=' + bookingId,
      method: 'POST',
      data: { location: location },
      success: function (data) {
        if (data == 0) {
          $('#location_alert').html(
            '<p class="text-danger">WRONG LOCATION</p>'
          );
        }
        if (data == 1) {
          $('#location_alert').html(
            '<p class="text-success">CORRECT LOCATION</p>'
          );

          window.location.href =
            'marlon_materialTag.php?bookingId=' + bookingId;
        }
      },
    });
    setTimeout(function () {
      $('#location_alert').html('');
    }, 1500);
  }

  //---------

  //check material tag
  let materialTagInput = $('#material-tag');
  $('#mtag-btn').one('click', function (e) {
    e.preventDefault();
    materialTagInput.removeClass('invisible');
    materialTagInput.focus();
  });

  $('#mtag-btn').on('click', function (e) {
    e.preventDefault();

    if (
      !materialTagInput.hasClass('invisible') &&
      materialTagInput.val() != ''
    ) {
      checkMaterialTag();
    }
  });

  function checkMaterialTag() {
    let materialtag = $('#material-tag').val();
    $.ajax({
      url: './controllers/marlon_controller.php?bookingId=' + bookingId,
      method: 'POST',
      data: { materialtag: materialtag },
      success: function (data) {
        if (data == 0) {
          $('#mtag_alert').html(
            '<p class="text-danger">WRONG MATERIAL TAG</p>'
          );
        }
        if (data == 1) {
          $('#mtag_alert').html(
            '<p class="text-success">CORRECT MATERIAL TAG</p>'
          );

          window.location.href =
            'marlon_materialDetails.php?bookingId=' + bookingId;
        }
      },
    });
    setTimeout(function () {
      $('#mtag_alert').html('');
    }, 1500);
  }
  //---------

  //update status
  $('#mdetails-btn').on('click', function (e) {
    e.preventDefault();
    $('.loader').show();

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
            confirmButtonColor: '#4a69bd',
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
        $('.loader').fadeOut(200);
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
      confirmButtonColor: '#4a69bd',
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
    $('.loader').show();
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
            confirmButtonColor: '#4a69bd',
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
        $('.loader').fadeOut(200);
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
    $('.loader').show();
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
        $('.loader').fadeOut(200);
      },
    });
  });
});
