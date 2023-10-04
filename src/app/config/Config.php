<?php

// URL
define('BASE_URL', 'http://localhost:8080/public');

// Database
define('HOST', $_ENV['MYSQL_HOST']);
define('DBNAME', $_ENV['MYSQL_DATABASE']);
define('USER', $_ENV['MYSQL_USER'] ?? 'root');
define('PASSWORD', $_ENV['MYSQL_PASSWORD']);
define('PORT', $_ENV['MYSQL_PORT']);

define('MAX_SIZE', 10 * 1024 * 1024);
define('ALLOWED_IMAGES', [
    'image/jpeg' => '.jpeg',
    'image/png' => '.png'
]);
define('MAX_SIZE_VIDEO', 1024 * 1024 * 1024);
define('ALLOWED_VIDEOS', [
    'image/jpeg' => '.mp4',
    'image/png' => '.mkv'
]);

// Admin
define('ADMIN_EMAIL', $_ENV['ADMIN_EMAIL']);
define('ADMIN_USERNAME', $_ENV['ADMIN_USERNAME']);
define('ADMIN_PASSWORD', $_ENV['ADMIN_PASSWORD']);

// Storage
define('DEFAULT_STORAGE', 1000);    // in MB

// Bcrypt
define('BCRYPT_COST', 10);

// Session
define('COOKIES_LIFETIME', 24 * 60 * 60);
define('SESSION_EXPIRATION_TIME', 24 * 60 * 60);
define('SESSION_REGENERATION_TIME', 30 * 60);

// Debounce
define('DEBOUNCE_TIMEOUT', 500);