var StatsService = {
    init: function (){
        StatsService.getNumberOfBlogs();
    },

    getNumberOfBlogs: function (){
        RestClient.get(
            "rest/numberofblogs",
            function (data){
                $("#totalBlogs").html(data);
            }
        )
    }
}