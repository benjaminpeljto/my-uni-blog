var MyblogsService = {

    init: function(){
        MyblogsService.getMyBlogs();
    },

    getMyBlogs: function(){
        RestClient.get(
            "rest/myblogs/" + Utils.getCurrentUserId(),
            function(response){
                MyblogsService.populateMyBlogs(response)
            }
        )
    },

    populateMyBlogs: function(data){
        var myBlogsContainer = $("#my-blogs-container");
        let currentUserId = Utils.getCurrentUserId();
        if(data.length == 0){
            myBlogsContainer.html(
                `<div id="no-favorites-container">
                                    <div id="sad-smiley-box">
                                      <img id="no-favorites-emoji" src="assets/img/sad_smiley-removebg.png" alt="sad smiley face">
                                    </div>
                                    <h1>You have no blogs posted.</h1>
                                    <h6>Start posting by clicking the <span style="font-weight: bold">"CREATE"</span> button.</h6>
                                 </div>`
            )
        }
        else {
            var blogsHtml = "";
            for (var i = 0; i < data.length; i++) {
                var editBlogOption = "";
                var deleteBlogOption = "";
                if (data[i].user_id === currentUserId || Utils.isAdmin()) {
                    editBlogOption = `<li><a class="dropdown-item" onclick="BlogsService.openEditModal(${data[i].id},${data[i].user_id})">Edit</a></li>`;
                    deleteBlogOption = `<li><a class="dropdown-item" onclick="BlogsService.openDeleteModal(${data[i].id},${data[i].user_id})">Delete</a></li>`;
                }

                var likeButtonClass = data[i].liked_by_user ? "liked" : "not-liked";

                var eachBlog = `
                <!-- Post preview -->
                <div class="post-preview position-relative mb-4" id="blog-${data[i].id}">
                    <a class="blog-post" onclick="BlogsService.putBlogId(${data[i].id}); BlogsService.postBlogDetails()">
                        <h2 class="post-title">${data[i].title}</h2>
                        <h3 class="post-subtitle">${BlogsService.getFirstSentence(data[i].content)}</h3>
                        <input id="postId" hidden>
                    </a>
                    <div class="dropdown position-absolute top-0 end-0 mt-2 me-2">
                        <a class="dropdown-toggle" href="#" style="color: black;" role="button" id="postOptionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v" style="color: black;"></i>
                        </a>
                        <ul id="blog-options" class="dropdown-menu" aria-labelledby="postOptionsDropdown">
                            ${editBlogOption}
                            ${deleteBlogOption}
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="d-flex align-items-center">
                            <img src="${data[i].profile_picture}" alt="${data[i].user}'s profile image" class="img-thumbnail profile-img">
                            <p class="post-meta mb-0">
                                <a id="posted_by_user">${data[i].user}</a> on ${BlogsService.formatDate(data[i].create_time)}
                            </p>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="post-meta mb-0">Category: <a id="post-category" onclick="CategoryService.putCategoryId(${data[i].category_id}); CategoryService.openCategory()">${data[i].category}</a></p>
                            <div class="d-flex align-items-center ms-3">
                                <button class="btn btn-link like-button ${likeButtonClass}" onclick="BlogsService.toggleLike(${data[i].id})">
                                    <i class="fas fa-thumbs-up"></i>
                                </button>
                                <span class="likes-count ms-1">${data[i].likes_num}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Divider -->
                <hr class="mb-4 mt-1" />`;

                blogsHtml += eachBlog;
            }

            myBlogsContainer.html(blogsHtml);
        }
    }
}