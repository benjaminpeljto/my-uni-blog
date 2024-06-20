var ProfileService = {
    init: function (){
        ProfileService.getProfileData();
        ProfileService.changeProfileImage();
        ProfileService.editProfileDataSubmitter();
        ProfileService.changeProfilePasswordSubmitter();
    },

    getProfileData: function (){
        RestClient.get(
            "rest/profile/" + Utils.getCurrentUserId(),
            function (data){
                ProfileService.setProfileData(data);
            }
        )
    },

    setProfileData: function (data){
        $("#profile-first-name").html(data.first_name);
        $("#profile-last-name").html(data.last_name);
        $("#profile-age").html(data.age);
        $("#profile-email").html(data.email);
        $("#profile-profile-image").attr("src", data.profile_picture)
    },

    openImageChangeModal: function (){
        $("#uploadImageModal").modal("show");
    },

    closeImageChangeModal: function (){
        $("#uploadImageModal").modal("hide");
    },

    changeProfileImage: function(){
        $("#profilePictureChangeForm").validate({
            rules: {
                image_file: {
                    required: true
                }
            },
            submitHandler: function(form, event){
                event.preventDefault();
                var formData = new FormData(form);
                ProfileService.uploadNewProfilePicture(formData);
            }
        })
    },

    uploadNewProfilePicture: function (formData) {
        $.ajax({
            url: 'rest/profile/image-change/' + Utils.getCurrentUserId(), // Change this to your API endpoint
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(xhr){
                if (localStorage.getItem("user_token")){
                    xhr.setRequestHeader('Authentication', localStorage.getItem("user_token"));
                }
            },
            success: function (response) {
                $("#profile-profile-image").attr("src", response.image_url);

                // Close the modal
                ProfileService.closeImageChangeModal();
                toastr.success(response.message)
            },
            error: function (xhr, status, error) {
                toastr.error(error);
            }
        });
    },

    openEditProfileDataModal: function(){
        $("#editProfileDataModal").modal("show");
        ProfileService.populateEditProfileDataModalFields();
    },

    closeEditProfileDataModal: function(){
        $("#editProfileDataModal").modal("hide");
        ProfileService.resetEditProfileDataForm();
    },

    resetEditProfileDataForm: function(){
        $("#editProfileDataForm").trigger("reset");
    },

    resetChangeProfilePasswordForm: function(){
        $("#changeProfilePasswordForm").trigger("reset");
    },

    openChangeProfilePasswordModal: function(){
        $("#changeProfilePasswordModal").modal("show");
    },

    closeChangeProfilePasswordModal: function(){
        $("#changeProfilePasswordModal").modal("hide");
        ProfileService.resetChangeProfilePasswordForm();
    },

    populateEditProfileDataModalFields: function(){
        $("#editProfileFirstName").val($("#profile-first-name").html());
        $("#editProfileLastName").val($("#profile-last-name").html());
        $("#editProfileAge").val($("#profile-age").html());
        $("#editProfileEmail").val($("#profile-email").html());
    },

    editProfileDataSubmitter: function(){
        $("#editProfileDataForm").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                age: {
                    required: true,
                    range: [15, 99],
                    digits: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                }
            },
            messages: {
                first_name: "This field cannot be empty.",
                last_name: "This field cannot be empty.",
                age: {
                    required: "This field cannot be empty.",
                    range: "Please enter an age between 15 and 99.",
                    digits: "Please enter a valid age."
                },
                email: "Please enter a valid email address.",
                password: {
                    required: "Please confirm with your password.",
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                ProfileService.updateProfileData(Utils.form2json(form));
            }
        });
    },

    updateProfileData(formJson){
        RestClient.put(
            "rest/profile/" + Utils.getCurrentUserId(),
            formJson,
            function(response){
                    if(response.success){
                        toastr.success(response.message);
                        ProfileService.getProfileData();
                        ProfileService.closeEditProfileDataModal();
                    }
                    else{
                        toastr.error(response.message);
                    }
                }
            )
    },

    changeProfilePasswordSubmitter: function(){
        $("#changeProfilePasswordForm").validate({
            rules: {
                profileCurrentPassword: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 16
                },
                password2: {
                    required: true,
                    equalTo: "#profileNewPassword"
                }
            },
            messages: {
                profileCurrentPassword: {
                    required: "Please enter your current password."
                },
                password: {
                    required: "Please enter a new password.",
                    minlength: "Your password must be at least 8 characters long.",
                    maxlength: "Your password cannot be longer than 16 characters."
                },
                password2: {
                    required: "Please confirm your new password.",
                    equalTo: "Passwords don't match."
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                ProfileService.changePassword(Utils.form2json(form));
            }
        });
    },

    changePassword: function(data){
        RestClient.put("rest/profile/change-password/" + Utils.getCurrentUserId(),
            data,
            function(response){
                    if(response.success){
                        toastr.success(response.message);
                        ProfileService.closeChangeProfilePasswordModal();
                    }
                    else{
                        toastr.error(response.message);
                    }
            });
    }
}