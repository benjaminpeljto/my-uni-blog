$.get('rest/blogswithuser', function (data){
    var blogsHtml = "";

    for(var i = 0; i < data.length; i++){
        var eachBlog = "";
        eachBlog = " <!-- Post preview-->\n" +
            "            <div class=\"post-preview\" data-blog-id=\"" + data[i].id + "\">\n" +
            "                <a class=\"blog-post\">\n" +
            "                    <h2 class=\"post-title\">" + data[i].title + "</h2>\n" +
            "                    <h3 class=\"post-subtitle\">" + getFirstSentence(data[i].content) + "</h3>\n" +
            "                </a>\n" +
            "                <p class=\"post-meta\">\n" +
            "                    Posted by\n" +
            "                    <a href=\"\">" + data[i].user + "</a>\n" +
            "                    on " + formatDate(data[i].create_time) + "\n" +
            "                </p>\n" +
            "            </div>\n" +
            "            <!-- Divider-->\n" +
            "            <hr class=\"my-4\" /> \n"

        blogsHtml += eachBlog;
    }

    $("#blogs").html(blogsHtml);

});




$(document).on("click", ".post-preview", function() {
    var blogId = $(this).data("blog-id");
    console.log("Clicked blog ID:", blogId);
    var currentUrl = window.location.href;
    var urlParts = currentUrl.split("/");
    urlParts[urlParts.length - 1] = "#blog";
    var newUrl = urlParts.join("/");
    console.log(newUrl);
    window.location.href = newUrl;

    $.get('rest/blogwithuser/' + blogId, function(data){
        $(".blog-title").html(data[0].title);
        $(".blog-subtitle").html(getFirstSentence(data[0].content));
        $(".user").html(data[0].user);
        $(".date").html(formatDate(data[0].create_time));
        $("#blog-content").html(data[0].content);
    });
});




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