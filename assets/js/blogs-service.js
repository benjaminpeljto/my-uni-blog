
var BlogsService = {

    init:function (){
        $(document).ready(function () {
            const urlParams = new URLSearchParams(window.location.search);
            const sortType = urlParams.get('sort') || 'all';
            BlogsService.getAllBlogs(sortType);
            BlogsService.createBlog();
            BlogsService.editBlog();
            BlogsService.sortTypeListener();
        });
    },

    getAllBlogs: function (sortType) {
        $("#btnAll").addClass("active");
        $("#btnFeatured").removeClass("active");
        let currentUserId = Utils.getCurrentUserId();
        let sortTypes = ['all', 'newest', 'oldest', 'most-liked', 'least-liked']
        if(!sortTypes.includes(sortType)) sortType='newest';
        RestClient.get(
            "rest/blogswithuser/" + sortType +"/" + currentUserId,
            function (data) {
                if(data.length == 0){
                    BlogsService.postNoBlogs();
                } else {
                    $(".filter-blogs-dropdown-container-class").show()
                    var blogsHtml = "";
                for (var i = 0; i < data.length; i++) {
                    var editBlogOption = "";
                    var deleteBlogOption = "";
                    var addToFavoritesOption = "<li><a class=\"dropdown-item admin-hide\" onclick=\"Favorite_blogsService.addToFavorites(${data[i].id})\">Add to favorites</a></li>\n";
                    if (data[i].user_id === currentUserId || Utils.isAdmin()) {
                        editBlogOption = `<li><a class="dropdown-item" onclick="BlogsService.openEditModal(${data[i].id},${data[i].user_id})">Edit</a></li>`;
                        deleteBlogOption = `<li><a class="dropdown-item" onclick="BlogsService.openDeleteModal(${data[i].id},${data[i].user_id})">Delete</a></li>`;
                        addToFavoritesOption = "";
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
                            ${addToFavoritesOption}
                            <li><a class="dropdown-item user-hide" onclick="FeaturedService.addToFeatured(${data[i].id})">Feature</a></li>
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

                $("#blogs").html(blogsHtml);
                BlogsService.optionsForAdmin();
            }
            }
        );
    },




    optionsForAdmin: function (){
        if(Utils.isAdmin()){
            $(".admin-hide").hide();
        }
        else{
            $(".user-hide").hide();
        }
    },

    putBlogId: function (id){
        localStorage.setItem("blog_details", "" + id);
        BlogsService.changeToBlogDetails();

    },

    postBlogDetails: function(){
        var blogId = parseInt(localStorage.getItem("blog_details"));
            RestClient.get(
                "rest/blogwithuser/" + blogId,
                function (data){
                    $(".blog-title").html(data[0].title);
                    $(".blog-subtitle").html(BlogsService.getFirstSentence(data[0].content));
                    $(".user").html(data[0].user);
                    $(".date").html(BlogsService.formatDate(data[0].create_time));
                    $("#blog-content").html(data[0].content);
                }
            );
    },

    postNoBlogs: function(){
        $(".filter-blogs-dropdown-container-class").hide()
        $("#blogs").html(`<div id="no-favorites-container" class="mt-4">
            <div id="sad-smiley-box">
              <img id="no-favorites-emoji" src="assets/img/sad_smiley-removebg.png" alt="sad smiley face">
            </div>
            <h1>Currently there are no blogs posted.</h1>
            <h6>Be first to post your university experience by clicking on the <span style="font-weight: bold">"CREATE"</span> button.</h6>
          </div>`);

    },

    changeToBlogDetails: function (data){
        var currentUrl = window.location.href;
        var urlParts = currentUrl.split("/");
        urlParts[urlParts.length - 1] = "#blog";
        var newUrl = urlParts.join("/");
        window.location.href = newUrl;

        window.scrollTo({
            top: 0,
            behavior: 'auto'
        });
    },

    openCreateModal: function(){
        $("#createBlogModal").modal("show");
    },

    closeCreateModal: function(){
        BlogsService.resetCreateBlogForm();
        $("#createBlogModal").modal("hide");
    },

    openDeleteModal: function(blog_id, writer_id){
        if(writer_id === Utils.getCurrentUserId() || Utils.isAdmin()) {
            $("#deleteBlogModal").modal("show");
            $("#postId").val(blog_id);
        }
        else{
            toastr.error("Insufficient Permissions")
        }
    },

    closeDeleteModal: function() {
        $("#deleteBlogModal").modal("hide");
    },

    openEditModal: function(blog_id, writer_id){
        if(writer_id === Utils.getCurrentUserId()) {
            RestClient.get(
                "rest/blog/" + blog_id,
                function (blog){
                    $("#editBlogModal").modal("show");
                    $("#edit_blog_id").val(blog_id);
                    $("#edit_blog_title").val(blog[0].title);
                    $("#edit_blog_content").val(blog[0].content);
                }
            )
        }
        else{
            toastr.error("Insufficient Permissions")
        }
    },

    closeEditModal: function (){
        $("#editBlogModal").modal("hide");
    },



    editBlog: function (){
        $.validator.addMethod("minThreeSentences", function(value, element) {
            var sentences = value.split('.');
            sentences = sentences.filter(function(sentence) {
                return sentence.trim() !== '';
            });
            return sentences.length >= 3;
        }, "Please enter at least three sentences.");

        $("#editBlogForm").validate({
            rules:{
                title:{
                    required:true,
                    minlength: 5,
                    maxlength: 50
                },
                content:{
                    required:true,
                    minThreeSentences: true,
                    minlength: 100,
                    maxlength: 10000
                },
            },
            submitHandler: function (form, event){
                event.preventDefault();
                var token = localStorage.getItem("user_token");
                if(token){
                    var entity = Utils.form2json(form);
                    entity['create_time'] = BlogsService.getCurrentDateTime();
                    var user = Utils.parseJwt(token);
                    entity['user_id'] = user.id;
                    BlogsService.postEditedBlog(entity);
                }
                else{
                    toastr.error("You need to be logged in to post a blog.");
                }

            }
        })
    },

    postEditedBlog: function(entity){
        var fromPage = entity['page'];
        delete entity.page
        RestClient.put(
            "rest/blogs/" + entity.id,
                entity,
            function (){
                toastr.info("Blog has been updated");
                fromPage === 'home' ? BlogsService.getAllBlogs() : MyblogsService.getMyBlogs();
                BlogsService.closeEditModal();
                BlogsService.resetEditBlogForm();
            }
        )
    },


    deleteBlog: function(){
        var postId = $("#postId").val();
        var fromPage = $("#from-page-delete").val();
        RestClient.delete(
            "rest/blogs/" + postId,
            function (result){
                    toastr.success("Blog no. " + postId + " deleted.")
                    BlogsService.closeDeleteModal();
                    fromPage === "home" ? BlogsService.getAllBlogs() : MyblogsService.getMyBlogs();
                }
        )
    },


    createBlog: function (){
        $.validator.addMethod("minThreeSentences", function(value, element) {
            // Split the content into sentences using period, exclamation mark, and question mark as delimiters
            var sentences = value.split(/[.!?]+/);
            // Filter out empty sentences
            sentences = sentences.filter(function(sentence) {
                return sentence.trim().length > 0;
            });
            // Check if there are at least three sentences
            return sentences.length >= 3;
        }, "Please enter at least three sentences.");

        $.validator.addMethod("categorySelected", function(value, element) {
            return value !== "0";
        }, "Category needs to be selected");


        $("#createBlogForm").validate({
            rules: {
                title: {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                },
                content: {
                    required: true,
                    minThreeSentences: true,
                    minlength: 100,
                    maxlength: 10000
                },
                category_id: {
                    required: true,
                    min: 1 // Ensures a category other than "Choose.." is selected
                }
            },
            messages: {
                title: {
                    required: "Please enter a blog title.",
                    minlength: "Title must be at least 5 characters long.",
                    maxlength: "Title cannot be longer than 50 characters."
                },
                content: {
                    required: "Please enter blog content.",
                    minThreeSentences: "Content must have at least three sentences.",
                    minlength: "Content must be at least 100 characters long.",
                    maxlength: "Content cannot be longer than 10000 characters."
                },
                category_id: {
                    required: "Please select a category.",
                    min: "Please select a valid category."
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                var token = localStorage.getItem("user_token");
                if (token) {
                    var entity = Utils.form2json(form);

                    // Sanitize the blog content
                    entity.content = DOMPurify.sanitize(entity.content);

                    entity['create_time'] = BlogsService.getCurrentDateTime();
                    var user = Utils.parseJwt(token);
                    entity['user_id'] = user.id;
                    if (entity['category_id'] == "null") {
                        delete entity.category_id;
                    }
                    BlogsService.postBlog(entity);
                } else {
                    toastr.error("You need to be logged in to post a blog.");
                }
            }
        });
    },

    postBlog: function(entity){
        RestClient.post(
            "rest/blogs",
            entity,
            function(result){
                toastr.success("Blog successfully posted!");
                BlogsService.closeCreateModal();
                BlogsService.resetCreateBlogForm();
                const hash = window.location.hash;
                const page = hash.split('/').pop();
                console.log(page)
                page === '#myblogs' ? MyblogsService.getMyBlogs() : BlogsService.getAllBlogs();
            }
        )
    },

    getCurrentDateTime: function(){
        var now = new Date();
        var year = now.getFullYear();
        var month = String(now.getMonth() + 1).padStart(2, '0');
        var day = String(now.getDate()).padStart(2, '0');
        var hours = String(now.getHours()).padStart(2, '0');
        var minutes = String(now.getMinutes()).padStart(2, '0');
        var seconds = String(now.getSeconds()).padStart(2, '0');

        return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
    },

    resetCreateBlogForm: function(){
        $("#createBlogForm")[0].reset();
    },

    resetEditBlogForm: function(){
        $("#editBlogForm")[0].reset();
    },

    getFirstSentence: function(text) {
        const firstSentence = text.match(/(.*?)([.?!])/);
        if (firstSentence) {
            return firstSentence[0];
        }
        return '';
    },

    formatDate: function(dateString) {
        const dateTimeParts = dateString.split(' ');
        const datePart = dateTimeParts[0];
        const dateParts = datePart.split('-');
        const year = dateParts[0];
        const month = new Date(dateString).toLocaleString('default', { month: 'long' });
        const day = dateParts[2];
        const formattedDate = `${month} ${day}, ${year}`;
        return formattedDate;
    },

    toggleLike: function(blogId){
        const likeButton = $(`#blog-${blogId} .like-button`);
        const likeCount = $(`#blog-${blogId} .likes-count`);
        RestClient.post(
            "rest/like/" + blogId + "/" + Utils.getCurrentUserId(),
            null,
            function (response){
                if(!response.success){
                    toastr.error(response.message);
                }
                else{
                    toastr.success(response.message);
                    // Toggle the like button state
                    if (likeButton.hasClass("liked")) {
                        likeButton.removeClass("liked").addClass("not-liked");
                        likeCount.html(Number(likeCount.html())-1)
                    } else {
                        likeButton.removeClass("not-liked").addClass("liked");
                        likeCount.html(Number(likeCount.html())+1)
                    }
                }
            }
        )
    },


    sortTypeListener: function(){
        $(document).off('click', '.filter-blogs-dropdown-item'); // Remove any previously attached click handlers
        $(document).on('click', '.filter-blogs-dropdown-item', function (event) {
            event.preventDefault();
            const sortType = $(this).data('sort');
            const url = new URL(window.location);
            url.searchParams.set('sort', sortType);
            window.history.pushState({}, '', url);
            console.log("sort listener")
            BlogsService.getAllBlogs(sortType);
        });

    }
}