var StatsService = {
    init: function (){
        StatsService.getNumberOfBlogs();
        StatsService.getNumberOfUsers();
    },

    getNumberOfBlogs: function (){
        RestClient.get(
            "rest/numberofblogs",
            function (data){
                $("#totalBlogs").html(data);
            }
        )
    },

    getNumberOfUsers: function (){
        RestClient.get(
            "rest/numberofusers",
            function (data){
                $("#totalUsers").html(data);
            }
        )
    }
}