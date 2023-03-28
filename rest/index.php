<?php
    require '../vendor/autoload.php';
    require 'dao/UsersDao.class.php';


    Flight::register("userDao","UsersDao");

    Flight::route("GET /users",function(){
        Flight::json(Flight::userDao()->get_all());  
    });

    Flight::route("GET /users/@id", function($id){
        Flight::json(Flight::userDao()->get_by_id($id));
    });

    Flight::start();
    
?>