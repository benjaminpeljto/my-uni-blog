<?php
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// import and register all business logic files (services) to FlightPHP
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/BlogService.php';
require_once __DIR__ . '/services/CommentService.php';
require_once __DIR__ . '/services/FavoriteService.php';
require_once __DIR__ . '/services/CategoryService.php';

Flight::register('userService', "UserService");
Flight::register('blogService', "BlogService");
Flight::register('commentService', "CommentService");
Flight::register('favoriteService', "FavoriteService");
Flight::register('categoryService', "CategoryService");

// middleware
Flight::route('/*', function(){
    //perform JWT decode
    $path = Flight::request()->url;
    if ($path == '/login' || $path =='/register' || $path == '/docs.json') return TRUE;

    $headers = getallheaders();
    if (!isset($headers['Authentication'])){
        Flight::json(["message" => "Authorization is missing"], 403);
        return FALSE;
    }
    else{
        try {
            $decoded = (array)JWT::decode($headers['Authentication'], new Key(Config::JWT_SECRET(), 'HS256'));
            Flight::set('user', $decoded);
            return TRUE;
        } catch (\Exception $e) {
            Flight::json(["message" => "Authorization token is not valid"], 403);
            return FALSE;
        }
    }
});

// import routes
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/BlogRoutes.php';
require_once __DIR__ . '/routes/CommentRoutes.php';
require_once __DIR__ . '/routes/FavoriteBlogRoutes.php';
require_once __DIR__ . '/routes/CategoryRoutes.php';

//custom routes here
Flight::route("GET /", function () {
    echo "Start page";
});



Flight::start();
