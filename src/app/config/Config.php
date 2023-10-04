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