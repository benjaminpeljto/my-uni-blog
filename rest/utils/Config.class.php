<?php


class Config
{

    public static function DB_HOST(){
        return Config::get_env('DB_HOST', 'db-mysql-fra1-72051-do-user-13671971-0.b.db.ondigitalocean.com');
    }

    public static function DB_SCHEME(){
        return Config::get_env('DB_NAME', 'blog_database');
    }

    public static function DB_USERNAME(){
        return Config::get_env('DB_USER', 'doadmin');
    }

    public static function DB_PASSWORD(){
        return Config::get_env('DB_PASSWORD', 'AVNS_bAPPIGBnUv-BIhQTBiS');
    }

    public static function DB_PORT(){
        return Config::get_env('DB_PORT', '25060');
    }


    public static function get_env($name, $default){
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
    }
    /*
    public static $host = 'db-mysql-fra1-72051-do-user-13671971-0.b.db.ondigitalocean.com';
    public static $database = 'blog_database';
    public static $username = 'doadmin';
    public static $password = 'AVNS_bAPPIGBnUv-BIhQTBiS';
    public static $port = '25060';
    */
}
