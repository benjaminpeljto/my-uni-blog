# Web-Programming2023_Blog
Mandatory project for "Introduction to Web Development" course on International Burch University.

Made by: @benjaminpeljto & @Tarik-7 & @dzelilatin

Instructions for running the app on a device:

1. Create config.php file in "Web-Programming2023_Blog/rest" and write the following in it:

<?php

class Config{

    public static $host = 'localhost';
    public static $database = 'database_name'; 
    public static $username = 'connection_username';
    public static $password = 'connection_password';
    public static $port = '3306';
}

?>

2. If error 404, change the .htaccess file code to the following:
  
  RewriteEngine On
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule ^(.*)$ index.php [QSA,L]
