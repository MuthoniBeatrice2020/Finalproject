$(document).ready(function() {
    //processing delete
    $('.report-active').click(function(event) {
        var deviceID = $(this).attr('id');
        $('#deviceID').val(deviceID);
        $('#reportDeviceModal').modal('show');
    });

    //displaying tables in data table format
    // $('#deviceTable').DataTable();
    $('#deviceTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'potrait',
                pageSize: 'A4'
            }
        ]
    } );
    
    //notify alert add text and fade out fxn
    $('.notify span').click( function () {
        $('.notify p').text('');
        $('.notify').fadeOut();
    });

    //report Device Form validation
    var validator = $('#reportDeviceForm').validate({
        rules : {
            deviceID:{
                required: true,       
            },
            comment: {
                required : true,
                minlength: 8
            }
        },
        messages : {
            idNo:{
                required: "Contact Admin"    
            },
            comment: {
                required: "Comment on where and when your device was stolen",
                minlength: jQuery.validator.format("Your comment should be atleast {0} characters")
            }
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.next().next());
        },
        submitHandler: function (form) {
            $.ajax({
                url: "php/report_stolen.php",
                type: "POST",
                data: $("#reportDeviceForm").serialize(),
                success: function (output) {
                    output = $.trim(output);
                    if (output == 'success'){
                        $('.notify p').text("Device reported successfully");
                        $('.notify').removeClass("alert-danger").addClass("alert-success").fadeIn();
                        $('#reportDeviceForm')[0].reset();
                        location.reload('true');
                    }else if(output == 'fail'){
                        $('.notify p').text("Server Error, Try Again");
                        $('.notify').addClass("alert-danger").fadeIn();
                    }else{
                        $('.notify p').text("Please Fill in all fields");
                        $('.notify').addClass("alert-danger").fadeIn();
                    }

                },
                error: function(output){
                    console.log('An Error occurred !!!!!');
                }
            });
        }
    });

    //notify alert reset fxn
    function resetAlert() {
        setTimeout(function () {
            $('.notify').removeClass('success').removeClass('danger').fadeOut();
            $('.notify p').text('');
        }, 10000);
    }
});