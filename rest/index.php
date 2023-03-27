<?php
    require '../vendor/autoload.php';
   
    Flight::route("/",function(){
        echo "default route";
    });

    Flight::route("GET /users", function(){
        echo "juzeriii";
    });

    Flight::start();
    
?>