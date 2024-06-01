var ProfileService = {
    init: function (){
        ProfileService.getProfileData();
        ProfileService.changeProfileImage();
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
    }


}