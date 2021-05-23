$(document).ready(function() {
     //processing delete
     $('.delete').click(function(event) {
        var did = $(this).attr('id');
        $('#did').val(did);
        $('#deleteStudentModal').modal('show');
    });
    //displaying tables in data table format
    $('#usersTable').DataTable();
    $('#securityTable').DataTable();
    $('#deptTable').DataTable();
    $('#catTable').DataTable();
    $('#ticTable').DataTable();
    $('#escTicTable').DataTable();

    //manage users view
    $('#addUsersToggle').click(function () {
        $('#viewUsers').hide();
        $('#addUsers').show();
        $('#addUsersToggle').addClass('disabled');
        $('#viewUsersToggle').removeClass('disabled');
    });
    $('#viewUsersToggle').click(function () {
        $('#addUsers').hide();
        $('#viewUsers').show();
        location.reload('true');
        $('#viewUsersToggle').addClass('disabled');
        $('#addUsersToggle').removeClass('disabled');
    });

    //manage Guard view
    $('#addSecurityToggle').click(function () {
        $('#viewSecurity').hide();
        $('#addSecurity').show();
        $('#addSecurityToggle').addClass('disabled');
        $('#viewSecurityToggle').removeClass('disabled');
    });
    $('#viewSecurityToggle').click(function () {
        $('#addSecurity').hide();
        $('#viewSecurity').show();
        location.reload('true');
        $('#viewSecurityToggle').addClass('disabled');
        $('#addSecurityToggle').removeClass('disabled');
    });

    //manage department view
    $('#addDeptToggle').click(function () {
        $('#viewDept').hide();
        $('#addDept').show();
        $('#addDeptToggle').addClass('disabled');
        $('#viewDeptToggle').removeClass('disabled');
    });
    $('#viewDeptToggle').click(function () {
        $('#addDept').hide();
        $('#viewDept').show();
        location.reload('true');
        $('#viewDeptToggle').addClass('disabled');
        $('#addDeptToggle').removeClass('disabled');
    });

    //manage category view
    $('#addCatToggle').click(function () {
        $('#viewCat').hide();
        $('#addCat').show();
        $('#addCatToggle').addClass('disabled');
        $('#viewCatToggle').removeClass('disabled');
    });
    $('#viewCatToggle').click(function () {
        $('#addCat').hide();
        $('#viewCat').show();
        location.reload('true');
        $('#viewCatToggle').addClass('disabled');
        $('#addCatToggle').removeClass('disabled');
    });

    //manage tickets view
    $('#viewTicToggle').click(function () {
        $('#viewEscTic').hide();
        $('#viewTic').show();
        location.reload('true');
        $('#viewTicToggle').addClass('disabled');
        $('#viewEscTicToggle').removeClass('disabled');
    });
    $('#viewEscTicToggle').click(function () {
        $('#viewTic').hide();
        $('#viewEscTic').show();
        $('#viewEscTicToggle').addClass('disabled');
        $('#viewTicToggle').removeClass('disabled');
    });
    
    //notify alert add text and fade out fxn
    $('.notify span').click( function () {
        $('.notify p').text('');
        $('.notify').fadeOut();
    });

    //add user validation
    var validator = $("#userForm").validate({
        rules : {
            regNo:{
                required : true,
                minlength : 4        
            },
            idNo:{
                required: true,
                number: true,
                minlength: 8        
            },
            firstName: {
                required : true,
                minlength: 4
            },
            lastName: {
                required : true,
                minlength: 3
            },
            serialNo: {
                required: true,
                minlength: 8
            },
            model: {
                required: true,
            },
            faculty: {
                required: true,
                minlength: 4,
            },
            password1: {
                required : true,
                minlength : 8
            },
            password2: {
                required : true,
                minlength: 8,
                equalTo : "#password1"
            },
        },
        messages : {
            regNo:{
                required : "Reg No is required",
                minlength : jQuery.validator.format("Reg No  should be at least {0} characters")       
            },
            idNo:{
                required: "ID Number is required",
                number: "Enter a Valid ID",
                minlength: jQuery.validator.format("ID No  should be at least {0} characters")        
            },
            firstName: {
                required: "First Name is required",
                minlength: jQuery.validator.format("First Name should be at least {0} characters")
            },
            lastName: {
                required: "Last Name is required",
                minlength: jQuery.validator.format("Last Name should be at least {0} characters")
            },
            serialNo: {
                required: "Device Serial Number is required",
                minlength: jQuery.validator.format("Enter at least {0} characters")
            },
            model: {
                required: "Device Model is required",
            },
            faculty: {
                required: "Faculty is required",
                minlength: jQuery.validator.format("Faculty should be at least {0} characters")
            },
            password1: {
                required : "Password is required",
                minlength: jQuery.validator.format("Password should be at least {0} characters")
            },
            password2: {
                required : "Confirm password please",
                minlength : jQuery.validator.format("Password should be at least {0} characters"),
                equalTo : "Passwords Do Not Match"

            },
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.next().next());
        },
        submitHandler: function (form) {
            $.ajax({
                url: "php/add_users.php",
                type: "POST",
                data: $("#userForm").serialize(),
                success: function (output) {
                    output = $.trim(output);
                    if (output == 'success'){
                        $('.notify p').text("Student [Device] added successfully");
                        $('.notify').addClass("alert-success").fadeIn();
                        $('#userForm')[0].reset();
                    }else if(output == 'fail'){
                        $('.notify p').text("Server Error, Try Again");
                        $('.notify').addClass("alert-danger").fadeIn();
                    }else if(output == 'userExists'){
                        $('.notify p').text("User [Staff] Already Exists");
                        $('.notify').addClass("alert-danger").fadeIn();
                        $('#userForm')[0].reset();
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

    //edit user validation
    var validator = $("#editUserForm").validate({
        rules : {
            regNo:{
                required : true,
                minlength : 4        
            },
            idNo:{
                required: true,
                number: true,
                minlength: 8        
            },
            firstName: {
                required : true,
                minlength: 4
            },
            lastName: {
                required : true,
                minlength: 3
            },
            faculty: {
                required: true,
                minlength: 4,
            },
        },
        messages : {
            regNo:{
                required : "Reg No is required",
                minlength : jQuery.validator.format("Reg No  should be at least {0} characters")       
            },
            idNo:{
                required: "ID Number is required",
                number: "Enter a Valid ID",
                minlength: jQuery.validator.format("ID No  should be at least {0} characters")        
            },
            firstName: {
                required: "First Name is required",
                minlength: jQuery.validator.format("First Name should be at least {0} characters")
            },
            lastName: {
                required: "Last Name is required",
                minlength: jQuery.validator.format("Last Name should be at least {0} characters")
            },
            faculty: {
                required: "Faculty is required",
                minlength: jQuery.validator.format("Faculty should be at least {0} characters")
            },
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.next().next());
        },
        submitHandler: function (form) {
            $.ajax({
                url: "php/edit_students.php",
                type: "POST",
                data: $("#editUserForm").serialize(),
                success: function (output) {
                    output = $.trim(output);
                    if (output == 'success'){
                        $('.notify p').text("Student updated successfully");
                        $('.notify').addClass("alert-success").fadeIn();
                        $('#editUserForm')[0].reset();
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

    //add Security[Guard] validation
    var validator = $('#securityForm').validate({
        rules : {
            idNo:{
                required: true,
                number: true,
                minlength: 8        
            },
            firstName: {
                required : true,
                minlength: 4
            },
            lastName: {
                required : true,
                minlength: 3
            },
            password1: {
                required : true,
                minlength : 8
            },
            password2: {
                required : true,
                minlength: 8,
                equalTo : "#password1"
            },
        },
        messages : {
            idNo:{
                required: "ID Number is required",
                number: "Enter a Valid ID:  Numeric",
                minlength: jQuery.validator.format("ID No  should be at least {0} characters")        
            },
            firstName: {
                required: "First Name is required",
                minlength: jQuery.validator.format("First Name should be at least {0} characters")
            },
            lastName: {
                required: "Last Name is required",
                minlength: jQuery.validator.format("Last Name should be at least {0} characters")
            },           
            password1: {
                required : "Password is required",
                minlength: jQuery.validator.format("Password should be at least {0} characters")
            },
            password2: {
                required : "Confirm password please",
                minlength : jQuery.validator.format("Password should be at least {0} characters"),
                equalTo : "Passwords Do Not Match"

            },
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.next().next());
        },
        submitHandler: function (form) {
            $.ajax({
                url: "php/add_security.php",
                type: "POST",
                data: $("#securityForm").serialize(),
                success: function (output) {
                    output = $.trim(output);
                    if (output == 'success'){
                        $('.notify p').text("Security [Guard] added successfully");
                        $('.notify').addClass("alert-success").fadeIn();
                        $('#securityForm')[0].reset();
                    }else if(output == 'fail'){
                        $('.notify p').text("Server Error, Try Again");
                        $('.notify').addClass("alert-danger").fadeIn();
                    }else if(output == 'userExists'){
                        $('.notify p').text("Security [Guard] Already Exists");
                        $('.notify').addClass("alert-danger").fadeIn();
                        $('#securityForm')[0].reset();
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

    //edit [security] validation
    var validator = $('#editSecurityForm').validate({
        rules : {
            idNo:{
                required: true,
                number: true,
                minlength: 8        
            },
            firstName: {
                required : true,
                minlength: 4
            },
            lastName: {
                required : true,
                minlength: 3
            },
        },
        messages : {
            idNo:{
                required: "ID Number is required",
                number: "Enter a Valid ID:  Numeric",
                minlength: jQuery.validator.format("ID No  should be at least {0} characters")        
            },
            firstName: {
                required: "First Name is required",
                minlength: jQuery.validator.format("First Name should be at least {0} characters")
            },
            lastName: {
                required: "Last Name is required",
                minlength: jQuery.validator.format("Last Name should be at least {0} characters")
            },
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.next().next());
        },
        submitHandler: function (form) {
            $.ajax({
                url: "php/edit_security.php",
                type: "POST",
                data: $("#editSecurityForm").serialize(),
                success: function (output) {
                    output = $.trim(output);
                    if (output == 'success'){
                        $('.notify p').text("Security [Guard] updated successfully");
                        $('.notify').addClass("alert-success").fadeIn();
                        $('#editSecurityForm')[0].reset();
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

    //change password [security] validation
    var validator = $('#passSecurityForm').validate({
        rules : {
            currentPass:{
                required: true,
                minlength: 8        
            },
            newPass:{
                required: true,
                minlength: 8        
            },
            confirmPass:{
                required: true,
                minlength: 8,
                equalTo: "#newPass"        
            },
        },
        messages : {
            currentPass:{
                required: "Current Password is required",
                minlength: jQuery.validator.format("Password should be at least {0} characters")        
            },
            newPass:{
                required: "New Password is required",
                minlength: jQuery.validator.format("Password should be at least {0} characters")        
            },
            confirmPass:{
                required: "Confirm the new password",
                minlength: jQuery.validator.format("Password should be at least {0} characters"),
                equalTo: "Passwords do not match"       
            },
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.next().next());
        },
        submitHandler: function (form) {
            $.ajax({
                url: "php/reset_security_password.php",
                type: "POST",
                data: $("#passSecurityForm").serialize(),
                success: function (output) {
                    output = $.trim(output);
                    if (output == 'success'){
                        $('.notify p').text("Security [Guard] password changed successfully");
                        $('.notify').addClass("alert-success").fadeIn();
                        $('#passSecurityForm')[0].reset();
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


    //edit device validation
    var validator = $("#editDeviceForm").validate({
        rules : {
            serialNo: {
                required: true,
                minlength: 8
            },
            model: {
                required: true,
            },
            status:{
                required: true,      
            },
        },
        messages : {
            serialNo: {
                required: "Device Serial Number is required",
                minlength: jQuery.validator.format("Enter at least {0} characters")
            },
            model: {
                required: "Device Model is required",
            },
            status:{
                required: "Device Status is required",     
            },
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.next().next());
        },
        submitHandler: function (form) {
            $.ajax({
                url: "php/edit_devices.php",
                type: "POST",
                data: $("#editDeviceForm").serialize(),
                success: function (output) {
                    output = $.trim(output);
                    if (output == 'success'){
                        $('.notify p').text("Student [Device] update successfully");
                        $('.notify').addClass("alert-success").fadeIn();
                        $('#editDeviceForm')[0].reset();
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