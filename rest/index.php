<?php
    require_once '../vendor/autoload.php';

    // import and register all business logic files (services) to FlightPHP
    require_once 'services/UserService.php';
    Flight::register("userService","UserService");

    // import routes
    require_once 'routes/UserRoutes.php';

    //custom routes here

    Flight::route("GET /", function(){
        echo "Welcome to the homepage";
    });

    Flight::start();
    
?>