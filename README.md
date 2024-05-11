# Web-Programming2023_Blog

Mandatory project for "Introduction to Web Development" course on International Burch University.

Made by: @benjaminpeljto, @Tarik-7 & @emirkugic

Instructions for running the app on a device:

1. Create config.php file in "Web-Programming2023_Blog/rest" and write the following in it:

```hack
<?php

class Config{

    public static $host = 'localhost';
    public static $database = 'database_name';
    public static $username = 'connection_username';
    public static $password = 'connection_password';
    public static $port = '3306';
}

?>
```

2. If error 404, change the .htaccess file code to the following:

```ApacheConf
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

But for me, I need to add this route in order to work (ofcourse this just works for me)

```ApacheConf
RewriteEngine On
RewriteBase /web-Programming2023_Blog/rest/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

3.

## Getting Started

To run this application locally, follow these steps:

1. Clone this repository to your local machine.
   ```
   git clone https://github.com/benjaminpeljto/my-uni-blog2024.git
   ```
2. Install the dependencies.
   ```
   composer install
   ```
3. Ensure you have WAMP or XAMPP installed on your machine.
4. Run the database script to create and populate the database.
   ```
   run database.sql script in DBMS
   ```
5. Update your MySQL credentials.
   ```
   update /rest/Config.class.php with mysql credentials
   ```
6. To access the application in your web browser visit:
   ```
   http://localhost/my-uni-blog2024/index.html
   ```


