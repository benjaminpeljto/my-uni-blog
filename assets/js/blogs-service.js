
var BlogsService = {

    init:function (){
        BlogsService.getBlogs();
        BlogsService.createBlog();
        BlogsService.editBlog();
    },

    getBlogs: function () {
        $.get('rest/blogswithuser', function (data) {

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
                            <a href="">${data[i].user}</a>
                            on ${BlogsService.formatDate(data[i].create_time)}
                        </p>
                        <div class="col-1 dropdown d-inline">
                                <a class="dropdown-toggle" href="#" style="color: black;" role="button" id="postOptionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v" style="color: black;"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="postOptionsDropdown">
                                    <li><a class="dropdown-item" onclick="BlogsService.openEditModal(${data[i].id},${data[i].user_id})">Edit</a></li>
                                    <li><a class="dropdown-item" onclick="BlogsService.openDeleteModal(${data[i].id},${data[i].user_id})">Delete</a></li>
                                    <li><a class="dropdown-item" onclick="Favorite_blogsService.addToFavorites(${data[i].id})">Add to favorites</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Divider -->
                    <hr class="my-4" />`;

                    blogsHtml += eachBlog;
            }

            $("#blogs").html(blogsHtml);
        });
    },


    openBlogDetails: function(id){
        var currentUrl = window.location.href;
        var urlParts = currentUrl.split("/");
        urlParts[urlParts.length - 1] = "#blog";
        var newUrl = urlParts.join("/");
        window.location.href = newUrl;

        window.scrollTo({
            top: 0,
            behavior: 'auto'
        });

        $.get('rest/blogwithuser/' + id, function(data) {
            $(".blog-title").html(data[0].title);
            $(".blog-subtitle").html(BlogsService.getFirstSentence(data[0].content));
            $(".user").html(data[0].user);
            $(".date").html(BlogsService.formatDate(data[0].create_time));
            $("#blog-content").html(data[0].content);
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
        if(writer_id === Utils.getCurrentUserId()) {
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
            console.log($("#edit_blog_id").val());
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
        RestClient.put(
            "rest/blogs/" + entity.id,
                entity,
            function (){
                toastr.info("Blog has been updated");
                BlogsService.closeEditModal();
                BlogsService.getBlogs();
                BlogsService.resetEditBlogForm();
            }
        )

    },


    deleteBlog: function(){
        var postId = $("#postId").val();
        RestClient.delete(
            "rest/blogs/" + postId,
            function (result){
                    toastr.success("Blog no. " + postId + " deleted.")
                    BlogsService.closeDeleteModal();
                    BlogsService.getBlogs();
                }
        )
    },


    createBlog: function (){
        $.validator.addMethod("minThreeSentences", function(value, element) {
            var sentences = value.split('.');
            sentences = sentences.filter(function(sentence) {
                return sentence.trim() !== '';
            });
            return sentences.length >= 3;
        }, "Please enter at least three sentences.");

        $("#createBlogForm").validate({
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
                    BlogsService.postBlog(entity);
                }
                else{
                    toastr.error("You need to be logged in to post a blog.");
                }

            }
        })
    },

    postBlog: function(entity){
        RestClient.post(
            "rest/blogs",
            entity,
            function(result){
                toastr.success("Blog successfully posted!");
                BlogsService.closeCreateModal();
                BlogsService.getBlogs();
                BlogsService.resetCreateBlogForm();
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
}