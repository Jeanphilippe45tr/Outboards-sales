<?php
// config.php - Main configuration file

// Site Configuration
define('SITE_NAME', 'Outboard Sales');
define('SITE_URL', 'http://localhost/outboard_sales');
define('ADMIN_URL', 'http://localhost/outboard_sales/admin');
define('SITE_EMAIL', 'info@outboardsales.com');
define('ADMIN_EMAIL', 'admin@outboardsales.com');

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'outboard_sales');
define('DB_USER', 'root');
define('DB_PASS', '');

// File Paths
define('BASE_PATH', dirname(__DIR__));
define('UPLOAD_PATH', BASE_PATH . '/assets/uploads/');
define('PRODUCT_IMAGE_PATH', UPLOAD_PATH . 'products/');
define('BRAND_IMAGE_PATH', UPLOAD_PATH . 'brands/');

// Application Settings
define('MAX_LOGIN_ATTEMPTS', 5);
define('SESSION_TIMEOUT', 3600); // 1 hour
define('ITEMS_PER_PAGE', 12);

// Error Reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Timezone
date_default_timezone_set('UTC');
?>