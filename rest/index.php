<?php
require_once '../vendor/autoload.php';

// import and register all business logic files (services) to FlightPHP
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/BlogService.php';
require_once __DIR__ . '/services/CommentService.php';
require_once __DIR__ . '/services/FavoriteService.php';

Flight::register('userService', "UserService");
Flight::register('blogService', "BlogService");
Flight::register('commentService', "CommentService");
Flight::register('favoriteService', "FavoriteService");

// import routes
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/BlogRoutes.php';
require_once __DIR__ . '/routes/CommentRoutes.php';
require_once __DIR__ . '/routes/FavoriteBlogRoutes.php';

//custom routes here
Flight::route("GET /", function () {
    echo "Start page";
});

Flight::start();
