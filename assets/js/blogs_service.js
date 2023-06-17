
$(function() {

    $.get('rest/blogswithuser', function(data) {
        var blogsHtml = "";

        for (var i = 0; i < data.length; i++) {
            var eachBlog = "";
            eachBlog = `
                <!-- Post preview -->
                <div class="post-preview">
                    <a class="blog-post" onclick="openBlogDetails(${data[i].id})">
                        <h2 class="post-title">${data[i].title}</h2>
                        <h3 class="post-subtitle">${getFirstSentence(data[i].content)}</h3>
                        <input name="postId" value="${data[i].id}" hidden>
                    </a>
                    <p class="post-meta">
                        Posted by
                        <a href="">${data[i].user}</a>
                        on ${formatDate(data[i].create_time)}
                    </p>
                </div>
                <!-- Divider -->
                <hr class="my-4" />
            `;

            blogsHtml += eachBlog;
        }

        $("#blogs").html(blogsHtml);
    });

    // $(document).on("click", ".blog-post", function() {
    //     var blogId = $(this).data("blog-id");
    //     console.log("Clicked blog ID:", blogId);
    //     var currentUrl = window.location.href;
    //     var urlParts = currentUrl.split("/");
    //     urlParts[urlParts.length - 1] = "#blog";
    //     var newUrl = urlParts.join("/");
    //     console.log(newUrl);
    //     window.location.href = newUrl;
    //
    //     $.get('rest/blogwithuser/' + blogId, function(data) {
    //         $(".blog-title").html(data[0].title);
    //         $(".blog-subtitle").html(getFirstSentence(data[0].content));
    //         $(".user").html(data[0].user);
    //         $(".date").html(formatDate(data[0].create_time));
    //         $("#blog-content").html(data[0].content);
    //     });
    // });




});


function openBlogDetails(id){
    var currentUrl = window.location.href;
    var urlParts = currentUrl.split("/");
    urlParts[urlParts.length - 1] = "#blog";
    var newUrl = urlParts.join("/");
    window.location.href = newUrl;

    $.get('rest/blogwithuser/' + id, function(data) {
        $(".blog-title").html(data[0].title);
        $(".blog-subtitle").html(getFirstSentence(data[0].content));
        $(".user").html(data[0].user);
        $(".date").html(formatDate(data[0].create_time));
        $("#blog-content").html(data[0].content);
    });
}

function showCreateModal(){
    $("#createBlogModal").modal("show");
}
function hideCreateModal(){
    $("#createBlogModal").modal("hide");
}




function getFirstSentence(text) {
    const firstSentence = text.match(/(.*?)([.?!])/);
    if (firstSentence) {
        return firstSentence[0];
    }
    return '';
}

function formatDate(dateString) {
    const dateTimeParts = dateString.split(' ');
    const datePart = dateTimeParts[0];
    const dateParts = datePart.split('-');
    const year = dateParts[0];
    const month = new Date(dateString).toLocaleString('default', { month: 'long' });
    const day = dateParts[2];
    const formattedDate = `${month} ${day}, ${year}`;
    return formattedDate;
}