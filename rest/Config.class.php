<?php

class Config
{

    public static function DB_HOST()
    {
        return Config::get_env('DB_HOST', 'localhost');
    }

    public static function DB_SCHEME()
    {
        return Config::get_env('DB_SCHEME', 'web_blog_08_07_2023');
    }

    public static function DB_USERNAME()
    {
        return Config::get_env('DB_USERNAME', 'web_project_user');
    }

    public static function DB_PASSWORD()
    {
        return Config::get_env('DB_PASSWORD', '71000Sarajevo');
    }

    public static function DB_PORT()
    {
        return Config::get_env('DB_PORT', '3306');
    }

    public static function JWT_SECRET()
    {
        return Config::get_env('JWT_SECRET', 'benjamin');
    }

    public static function IMGUR_CLIENT_ID()
    {
        return Config::get_env('IMGUR_CLIENT_ID', 'your_imgur_id');
    }

    public static function GOOGLE_CLIENT_ID()
    {
        return Config::get_env('GOOGLE_CLIENT_ID', 'your_google_console_id');
    }

    public static function GOOGLE_CLIENT_SECRET()
    {
        return Config::get_env('GOOGLE_CLIENT_SECRET', 'your_google_console_secret');
    }

    public static function GOOGLE_REDIRECT_URI()
    {
        return Config::get_env('GOOGLE_REDIRECT_URI', 'http://localhost/my-uni-blog/rest/google-callback');
    }

    public static function APP_BASE_URL()
    {
        return Config::get_env('APP_BASE_URL', 'http://localhost/my-uni-blog');
    }

    public static function get_env($name, $default)
    {
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
    }

}
