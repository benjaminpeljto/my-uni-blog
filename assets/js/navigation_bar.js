const nav_login = "<li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" href=\"#login\">Login</a></li>\n" +
    "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" href=\"#about\">About</a></li>\n" +
    "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" href=\"#contact\">Contact</a></li>";

const nav_logged = "<li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" href=\"\">Create</a></li>\n" +
    "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" href=\"#favorites\">Favorites</a></li>\n" +
    "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" href=\"#home\">Home</a></li>\n" +
    "                    <li class=\"nav-item\"><a class=\"nav-link px-lg-3 py-3 py-lg-4\" href=\"#profile\">Profile</a></li>";
$("#tabs").html(nav_logged);

// Collapse navbar on link click
$('.nav-link').on('click', function () {
    $('.navbar-collapse').collapse('hide');
});