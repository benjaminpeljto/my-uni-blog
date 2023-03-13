<?php
    require 'vendor/autoload.php';

    Flight::route('/', function(){
        echo 'Hello';

    });

    Flight::route('/page/@id', function($id){
        echo 'This is page '.$id.'!';
    });

    Flight::start();
?>
