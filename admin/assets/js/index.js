$(document).ready(function () {

    //login validation
    var validator = $('#loginForm').validate({
        rules : {
            username: {
                required : true,
                minlength : 4
            },
            password: {
                required : true,
                minlength : 5
            },
        },
        messages : {
            username: {
                required : "Username is required",
                minlength: jQuery.validator.format("Username should be at least {0} characters")
            },
            password: {
                required : "Password is required",
                minlength: jQuery.validator.format("Password should be at least {0} characters")
            },
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.next().next());
            
        },
    });
    //validation successful, do this
    if (validator){
        $.ajax({
            url: "index.php",
            type: "POST",
            data: $('#loginForm').serialize()
        });
    }

});
