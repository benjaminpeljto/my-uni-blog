var ProfileService = {
    init: function (){
        ProfileService.getProfileData();
    },

    getProfileData: function (){
        RestClient.get(
            "rest/users/" + Utils.getCurrentUserId(),
            function (data){
                ProfileService.updateProfileData(data);
            }
        )
    },

    updateProfileData: function (data){
        $("#profile-first-name").html(data[0].first_name);
        $("#profile-last-name").html(data[0].last_name);
        $("#profile-age").html(data[0].age);
        $("#profile-email").html(data[0].email);
    }
}