<?php
    require_once '../vendor/autoload.php';

    // import and register all business logic files (services) to FlightPHP
    require_once __DIR__ . '/services/UserService.php';
    
    Flight::register('userService',"UserService");

    // import routes
    require_once __DIR__ . '\routes\UserRoutes.php';


    //custom routes here
    Flight::route("GET /", function(){
        echo "Start page";
    });

    Flight::start();
    
?>