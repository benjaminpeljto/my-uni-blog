var Favorite_blogsService = {

    addToFavorites: function(blogId){
        var userId = BlogsService.getCurrentUserId();
        var favoriteEntity = {
            user_id: "" + userId,
            blog_id: "" + blogId
        }
        RestClient.post(
            "rest/favoriteblog",
            favoriteEntity,
            function (){
                toastr.success("Added to favorites");
            }
        );
    },




}