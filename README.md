# MyUniBlog

This repository contains the mandatory project for the "Introduction to Web Development" course, which has been extended for use in the "Software Engineering" course at International Burch University.

## Project Description

The project is a dynamic blog application that was initially developed over four months in 2023 and later extended and upgraded in 2024. Although it serves as an educational example in the context of my coursework, it's mainly a team project where we've been improving web development skills and applying software engineering principles practically.

## Tech stack
* MySQL
* PHP (w/ FlightPHP)
* HTML
* CSS
* JS (w/ additional libraries)

## Installation
### Prerequisites
* PHP Server Environment (XAMP, MAMP, WAMP, or equivalent)
* MySQL Database
* Composer as a DMT

### Setup instructions
1. Clone the Repository
   ```
   git clone https://github.com/benjaminpeljto/my-uni-blog2024.git
   ```
2. Install Dependencies
```
composer install
```
3. Database Configuration
Create a new empty database and run the provided .sql script in your DBMT in order to populate the newly created database.
4. Configure the Application
* Navigate to `my-uni-blog/rest`
* In `Config.class.php` file add in each function's return statement as second parameter the database connection detail.
* Modify `.htaccess` for your environment if encountering a 404 error:
```
RewriteEngine On
RewriteBase /my-uni-blog/rest/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```
5. Run the application
Access the application by navigating to the following location in the desired browser:
```
http://localhost/my-uni-blog/index.html
```
