const nav_logged = "<li class=\"nav-item\"><a class=\"createbuttonnavlink nav-link px-lg-3 py-3 py-lg-4\" onclick=\"BlogsService.openCreateModal()\">Create</a></li>\n" +
    "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" onclick=\"Favorite_blogsService.init()\" href=\"#favorites\">Favorites</a></li>\n" +
    "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" href=\"#home\">Home</a></li>\n" +
    "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" href=\"#profile\">Profile</a></li>\n" +
    "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" onclick=\"LoginService.logout()\">Log Out</a></li>";
$("#tabs").html(nav_logged);

// Collapse navbar on link click
$('.nav-link').on('click', function () {
    $('.navbar-collapse').collapse('hide');
});