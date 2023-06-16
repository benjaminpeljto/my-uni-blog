$.get('rest/blogswithuser', function (data){
    var blogsHtml = "";

    for(var i = 0; i < data.length; i++){
        var eachBlog = "";
        eachBlog = " <!-- Post preview-->\n" +
            "            <div class=\"post-preview\">\n" +
            "                <a href=\"\">\n" +
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
    const formattedDate = `${dateParts[2]}.${dateParts[1]}.${dateParts[0]}`;
    return formattedDate;
}