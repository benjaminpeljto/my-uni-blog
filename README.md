# MyUniBlog

A full-stack blog application built as a mandatory project for the "Introduction to Web Development" course and extended for the "Software Engineering" course at International Burch University.

## Project Description

MyUniBlog is a single-page application (SPA) with a PHP REST API backend. Users can create, browse, like, and favorite blog posts across multiple categories. The app supports both traditional email/password authentication and Google Single Sign-On (SSO), with JWT-based session management. An admin system allows managing featured posts and moderating users.

### Features

- User registration and login (email/password + Google SSO)
- Create, edit, and delete blog posts
- Browse blogs by category (Fashion, Lifestyle, Fitness, Cars, Music, Travel, Sports, Food)
- Like and favorite blog posts
- User profiles with Imgur-hosted profile pictures
- Admin panel: feature/unfeature posts, ban/unban users, view statistics
- Swagger/OpenAPI documentation

## Tech Stack

- **Backend:** PHP 7.4+ with [FlightPHP](http://flightphp.com/) micro-framework
- **Frontend:** HTML5, CSS3, JavaScript (jQuery 3.7, Bootstrap 5.3, SPApp)
- **Database:** MySQL 8.0+
- **Authentication:** JWT ([firebase/php-jwt](https://github.com/firebase/php-jwt)) + Google OAuth 2.0
- **Image Hosting:** Imgur API
- **API Docs:** Swagger UI ([zircote/swagger-php](https://github.com/zircote/swagger-php))
- **Testing:** PHPUnit 11

## Project Structure

```
my-uni-blog/
├── index.html                  # Main SPA entry point (authenticated)
├── login.html                  # Login/signup page
├── composer.json               # PHP dependencies
├── phpunit.xml                 # Test configuration
├── cacert.pem                  # SSL certificate for Google API
├── isrgrootx1.pem              # SSL root certificate
├── rest/                       # Backend REST API
│   ├── index.php               # FlightPHP router entry point
│   ├── Config.class.php        # Configuration (DB, JWT, Google, Imgur)
│   ├── google-config.php       # Google OAuth client setup
│   ├── .htaccess               # URL rewriting
│   ├── routes/                 # API route definitions
│   ├── services/               # Business logic layer
│   ├── dao/                    # Data access objects (database layer)
│   └── docs/                   # Swagger UI documentation
├── assets/
│   ├── css/                    # Stylesheets
│   ├── js/                     # Frontend JavaScript services
│   └── img/                    # Image assets
├── tpl/                        # SPA HTML templates (views)
└── tests/                      # PHPUnit tests
```

## Installation

### Prerequisites

- PHP 7.4 or higher
- A PHP server environment (XAMPP, MAMP, WAMP, or equivalent)
- MySQL 8.0+
- [Composer](https://getcomposer.org/) (PHP dependency manager)

### Setup Instructions

#### 1. Clone the Repository

```bash
git clone https://github.com/benjaminpeljto/my-uni-blog2024.git
cd my-uni-blog
```

#### 2. Install PHP Dependencies

```bash
composer install
```

#### 3. Set Up the Database

1. Open your MySQL client (phpMyAdmin, MySQL Workbench, or CLI).
2. Create a new database:
   ```sql
   CREATE DATABASE web_blog_08_07_2023;
   ```
3. Import the provided SQL dump to populate tables and sample data:
   ```bash
   mysql -u root -p web_blog_08_07_2023 < dump-myuniblog-db-202406032004.sql
   ```

#### 4. Configure the Application

All configuration is managed in `rest/Config.class.php`. Each setting reads from environment variables first and falls back to a default value. You can either set environment variables or edit the defaults directly.

| Setting | Env Variable | Default | Description |
|---------|-------------|---------|-------------|
| Database Host | `DB_HOST` | `localhost` | MySQL server host |
| Database Name | `DB_SCHEME` | `web_blog_08_07_2023` | Database name |
| Database User | `DB_USERNAME` | `web_project_user` | MySQL username |
| Database Password | `DB_PASSWORD` | `71000Sarajevo` | MySQL password |
| Database Port | `DB_PORT` | `3306` | MySQL port |
| JWT Secret | `JWT_SECRET` | `benjamin` | Secret key for JWT signing |
| Imgur Client ID | `IMGUR_CLIENT_ID` | *(placeholder)* | Imgur API client ID |
| Google Client ID | `GOOGLE_CLIENT_ID` | *(placeholder)* | Google OAuth client ID |
| Google Client Secret | `GOOGLE_CLIENT_SECRET` | *(placeholder)* | Google OAuth client secret |
| Google Redirect URI | `GOOGLE_REDIRECT_URI` | `http://localhost/my-uni-blog/rest/google-callback` | OAuth callback URL |
| App Base URL | `APP_BASE_URL` | `http://localhost/my-uni-blog` | Application base URL |

**Important:** For production, change `JWT_SECRET` and `DB_PASSWORD` to strong, unique values and use environment variables instead of hardcoding credentials.

#### 5. Configure URL Rewriting

If you encounter 404 errors, update `rest/.htaccess` to match your server path:

```apache
RewriteEngine On
RewriteBase /my-uni-blog/rest/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

#### 6. Run the Application

Start your PHP server environment (e.g., XAMPP Apache + MySQL) and navigate to:

```
http://localhost/my-uni-blog/login.html
```

## Setting Up Google SSO

Google Single Sign-On allows users to log in with their Google account. Follow these steps to configure it:

### 1. Create a Google Cloud Project

1. Go to the [Google Cloud Console](https://console.cloud.google.com/).
2. Create a new project (or select an existing one).
3. Navigate to **APIs & Services > OAuth consent screen**.
4. Configure the consent screen:
   - Choose **External** user type.
   - Fill in the app name, user support email, and developer contact.
   - Add the scopes: `email` and `profile`.
   - Add your email as a test user (required while in "Testing" mode).

### 2. Create OAuth 2.0 Credentials

1. Go to **APIs & Services > Credentials**.
2. Click **Create Credentials > OAuth client ID**.
3. Select **Web application** as the application type.
4. Under **Authorized redirect URIs**, add:
   ```
   http://localhost/my-uni-blog/rest/google-callback
   ```
   For production, add your production callback URL as well.
5. Copy the **Client ID** and **Client Secret**.

### 3. Add Credentials to the App

Set the values in `rest/Config.class.php` or via environment variables:

- `GOOGLE_CLIENT_ID` - Your OAuth client ID
- `GOOGLE_CLIENT_SECRET` - Your OAuth client secret
- `GOOGLE_REDIRECT_URI` - Must match exactly what you entered in Google Cloud Console
- `APP_BASE_URL` - Your app's base URL (used for redirecting after login)

### 4. SSL Certificates

The Google API client requires SSL verification. The project includes `cacert.pem` and `isrgrootx1.pem` for this purpose. These are referenced in `rest/google-config.php` and `rest/dao/BaseDao.class.php`. If they expire, download an updated CA bundle from [curl.se](https://curl.se/docs/caextract.html).

### How Google SSO Works

1. User clicks "Sign in with Google" on the login page.
2. The frontend calls `GET /google-login`, which returns a Google authorization URL.
3. The user is redirected to Google's consent screen.
4. After granting access, Google redirects back to `GET /google-callback?code=...`.
5. The backend exchanges the authorization code for an access token.
6. The backend fetches the user's email, first name, and last name from Google.
7. If the user already exists, they are logged in. If not, a new account is automatically created.
8. A JWT token is generated and the user is redirected to `index.html?token=<JWT>`.

## API Documentation

Swagger UI is available at:

```
http://localhost/my-uni-blog/rest/docs/
```

### Key API Endpoints

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| `POST` | `/register` | Register a new user | No |
| `POST` | `/login` | Login with email/password | No |
| `GET` | `/google-login` | Initiate Google SSO | No |
| `GET` | `/google-callback` | Google OAuth callback | No |
| `GET` | `/blogswithuser` | List all blogs with author info | Yes |
| `POST` | `/blogs` | Create a new blog post | Yes |
| `PUT` | `/blogs/{id}` | Update a blog post | Yes |
| `DELETE` | `/blogs/{id}` | Delete a blog post | Yes |
| `POST` | `/blogs/{id}/like` | Like a blog post | Yes |
| `DELETE` | `/blogs/{id}/like` | Remove like | Yes |
| `GET` | `/favorites` | Get user's favorite blogs | Yes |
| `POST` | `/favorites` | Add blog to favorites | Yes |
| `GET` | `/category` | List all categories | Yes |
| `GET` | `/profile/{id}` | Get user profile | Yes |
| `PUT` | `/profile/{id}` | Update profile | Yes |

## Running Tests

```bash
./vendor/bin/phpunit
```
