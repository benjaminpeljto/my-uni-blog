var Favorite_blogsService = {

    init: function (){
        Favorite_blogsService.getFavoriteBlogs();
    },

    addToFavorites: function(blogId){
        var userId = Utils.getCurrentUserId();
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

    getFavoriteBlogs: function (){
        RestClient.get(
            "rest/favoriteblogs/" + Utils.getCurrentUserId(),
            function (data){
                if(data.length == 0){
                    Favorite_blogsService.postNoFavorites();
                }
                else {
                    Favorite_blogsService.postFavoriteBlogs(data);
                }
            }
        )
    },

    postNoFavorites: function (){
        $("#favorite-blogs").html(
`<img src="../img/sad_smiley_face.png" alt="sad smiley face">
                <h1>No favorite blogs added.</h1>`
        )
    },

    postFavoriteBlogs: function (data){
        var blogsHtml = "";

        for (var i = 0; i < data.length; i++) {
            var eachBlog = "";
            eachBlog = `
                    <!-- Post preview -->
                    <div class="post-preview">
                        <a class="blog-post" onclick="BlogsService.openBlogDetails(${data[i].id})">
                            <h2 class="post-title">${data[i].title}</h2>
                            <h3 class="post-subtitle">${BlogsService.getFirstSentence(data[i].content)}</h3>
                            <input id="postId" hidden>
                        </a>
                        <div class="row">
                        <p class="col-11 post-meta">
                            Posted by
                            <a id="posted_by_user">${data[i].user}</a>
                            on ${BlogsService.formatDate(data[i].create_time)}
                        </p>
                        <div class="col-1 dropdown d-inline">
                                <a class="dropdown-toggle" href="#" style="color: black;" role="button" id="postOptionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v" style="color: black;"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="postOptionsDropdown">
                                    <li><a class="dropdown-item" onclick="Favorite_blogsService.openRemoveFromFavModal(${data[i].id})">Remove from favorites</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Divider -->
                    <hr class="my-4" />`;

            blogsHtml += eachBlog;
        }

        $("#favorite-blogs").html(blogsHtml);
    },

    openRemoveFromFavModal: function (blogId){
        $("#removeFromFavoritesModal").modal("show");
        $("#remove_fav_blog_id").val(blogId);
    },

    closeRemoveFromFavModal: function (){
        $("#removeFromFavoritesModal").modal("hide");
    },

    removeFavoriteBlog: function (){
        var blogId = $("#remove_fav_blog_id").val();
        var userId = Utils.getCurrentUserId();
        var entity = {
            blog_id: "" + blogId,
            user_id: "" + userId
        }

        $.ajax({
            url: "rest/favoriteblog",
            type: "DELETE",
            data: JSON.stringify(entity),
            contentType: "application/json",
            success: function (response){
                toastr.info("Blog removed from favorites.")
                Favorite_blogsService.closeRemoveFromFavModal();
                Favorite_blogsService.getFavoriteBlogs();
            },
            error: function (response){
                console.log("smth went wrong")
            }
        })
    },





}