var CategoryService = {

    init: function (){
        CategoryService.postBlogs();
    },

    openCategory: function (){
        const categoryId = parseInt(localStorage.getItem("blog_category"));
        if(categoryId == null){
            toastr.error("Category for this blog is not assigned.")
        }
        else {
            CategoryService.postBlogs()
        }
    },

    putCategoryId: function (id){
        if(id == null){
            toastr.error("Category for this blog is not assigned.")
        }
        else {
            localStorage.setItem("blog_category", "" + id);
            CategoryService.changeToCategories();
        }
    },



    changeToCategories: function (){
        var currentUrl = window.location.href;
        var urlParts = currentUrl.split("/");
        urlParts[urlParts.length - 1] = "#category";
        var newUrl = urlParts.join("/");
        window.location.href = newUrl;
    },

    postBlogs: function (){
        const categoryId = parseInt(localStorage.getItem("blog_category"));
        RestClient.get(
            "rest/category/" + categoryId,
            function (data) {
                var blogsHtml = "";

                for (var i = 0; i < data.length; i++) {
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
                                            <li><a class="dropdown-item" onclick="Favorite_blogsService.addToFavorites(${data[i].id})">Add to favorites</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Divider -->
                            <hr class="my-4" />`;

                    blogsHtml += eachBlog;
                }
                $("#category-title").html(data[0].category);
                $("#category-blogs").html(blogsHtml);
            }
        )
    }
}