var FeaturedService = {

    getFeaturedBlogs: function (){
        $("#btnAll").removeClass("active");
        $("#btnFeatured").addClass("active");
        let currentUserId = Utils.getCurrentUserId();
        RestClient.get(
            "rest/featuredblogs",
            function (data){

                var blogsHtml = "";
                for (var i = 0; i < data.length; i++) {
                    var editBlogOption = "";
                    var deleteBlogOption = "";
                    if (data[i].user_id === currentUserId || Utils.isAdmin()) {
                        editBlogOption = `<li><a class="dropdown-item" onclick="BlogsService.openEditModal(${data[i].id},${data[i].user_id})">Edit</a></li>`;
                        deleteBlogOption = `<li><a class="dropdown-item" onclick="BlogsService.openDeleteModal(${data[i].id},${data[i].user_id})">Delete</a></li>`;
                    }
                    var eachBlog = "";
                    eachBlog = `
                        <!-- Post preview -->
                        <div class="post-preview">
                            <a class="blog-post" onclick="BlogsService.putBlogId(${data[i].id}); BlogsService.postBlogDetails()">
                                <h2 class="post-title">${data[i].title}</h2>
                                <h3 class="post-subtitle">${BlogsService.getFirstSentence(data[i].content)}</h3>
                                <input id="postId" hidden>
                            </a>
                            <div class="row">
                            <p class="col-8 post-meta">
                                <img src="${data[i].profile_picture}" alt="${data[i].user}'s profile image" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                Posted by
                                <a id="posted_by_user">${data[i].user}</a>
                                on ${BlogsService.formatDate(data[i].create_time)}
                            </p>
                            <p class="col-3 post-meta">Category: <a id="post-category" onclick="CategoryService.putCategoryId(${data[i].category_id}); CategoryService.openCategory()">${data[i].category}</a></p>
                            <div class="col-1 dropdown d-inline">
                                    <a class="dropdown-toggle" href="#" style="color: black;" role="button" id="postOptionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v" style="color: black;"></i>
                                    </a>
                                    <ul id="blog-options" class="dropdown-menu" aria-labelledby="postOptionsDropdown">
                                        ${editBlogOption}
                                        ${deleteBlogOption}
                                        <li><a class="dropdown-item admin-hide" onclick="Favorite_blogsService.addToFavorites(${data[i].id})">Add to favorites</a></li>
                                        <li><a class="dropdown-item user-hide" onclick="FeaturedService.removeFromFeatured(${data[i].id})">Unfeature</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Divider -->
                        <hr class="mb-4 mt-1" />`;

                    blogsHtml += eachBlog;
                }

                if(blogsHtml === ""){
                    $("#blogs").html(
                        `<div id="no-favorites-container">
                                            <div id="sad-smiley-box">
                                                <img id="no-favorites-emoji" src="assets/img/sad_smiley-removebg.png" alt="sad smiley face">
                                            </div>
                                            <h1>No featured blogs.</h1>
                                        </div>`
                    );
                }
                else{
                    $("#blogs").html(blogsHtml);
                    FeaturedService.optionsForAdmin();
                }
            }
        )
    },

    optionsForAdmin: function (){
        if(Utils.isAdmin()){
            $(".admin-hide").hide();
        }
        else{
            $(".user-hide").hide();
        }
    },

    addToFeatured: function (blog_id){
        FeaturedService.isAlreadyFeatured(blog_id, function (isFeatured){
            if(isFeatured){
                toastr.warning("Blog is already featured.")
            }
            else if(!Utils.isAdmin()){
                toastr.error("Only admin can manage featured.")
            }
            else{
                const featuredEntity = {
                    blog_id: "" + blog_id
                };
                RestClient.post(
                    "rest/featuredblog",
                    featuredEntity,
                    function (){
                        toastr.success("Added to featured.");
                        FeaturedService.getFeaturedBlogs();
                    }
                );
            }
        })
    },

    removeFromFeatured: function (blog_id){
        if(Utils.isAdmin()){
            RestClient.delete(
                "rest/featuredblog/" + blog_id,
                function (){
                    FeaturedService.getFeaturedBlogs();
                    toastr.success("Blog " + blog_id + " removed from featured.")
                }
            );
        }
        else{
            toastr.error("Only admin can manage featured.");
        }

    },

    isAlreadyFeatured: function(blogId, callback) {
        RestClient.get(
            "rest/featuredblogs",
            function(data) {
                if (data.length == 0) {
                    callback(false);
                } else {
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].id == blogId) {
                            callback(true);
                            return;
                        }
                    }
                    callback(false);
                }
            }
        );
    }


}