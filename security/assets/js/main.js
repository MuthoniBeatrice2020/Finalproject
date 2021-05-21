$(document).ready(function() {

    //displaying tables in data table format
    $('#deviceTable').DataTable();
    
    //notify alert add text and fade out fxn
    $('.notify span').click( function () {
        $('.notify p').text('');
        $('.notify').fadeOut();
    });

    //notify alert reset fxn
    function resetAlert() {
        setTimeout(function () {
            $('.notify').removeClass('success').removeClass('danger').fadeOut();
            $('.notify p').text('');
        }, 10000);
    }
});