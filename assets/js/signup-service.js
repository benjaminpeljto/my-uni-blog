var SignupService = {

    init: function(){
        $("#signupForm").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                age:{
                    required: true,
                    range:[15,99],
                    digits: true
                },
                email:{
                    required: true,
                    email: true
                },
                password:{
                    required: true,
                    minlength: 8,
                    maxlength: 16,
                },
                password2:{
                    required: true,
                    equalTo: "#signup-password"
                }
            },
            messages:{
                first_name: "Please enter your first name.",
                last_name: "Please enter your last name.",
                email: "Please enter a valid email address.",
                password2: {
                    equalTo: "Passwords don't match"
                }
            },
            submitHandler: function (form) {
                var userData = Object.fromEntries(new FormData(form).entries());
                SignupService.signUp(userData);
            }
        });
    },

    signUp: function(userData){
        $.ajax({
            url: "rest/register",
            type: "POST",
            data: JSON.stringify(userData),
            contentType: "application/json",
            dataType: "json",
            success: function (response){
                $("#signUpModal").modal("toggle");
                toastr.success("Signed up successfully! Login now.", "", { positionClass: "toast-top-center" });
                SignupService.resetForm();
            },
            error: function (response){
                toastr.error("Email already exists. Please log in.");
                SignupService.resetForm();
            }
        });
    },

    openSignupModal: function (){
        $("#loginModal").modal("hide");
        $("#signUpModal").modal("show");
    },

    closeSignupModal: function (){
        $("#signUpModal").modal("hide");
    },

    resetForm: function(){
        $("#signupForm")[0].reset();
    }


}



