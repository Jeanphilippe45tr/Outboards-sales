<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();


define('BASE_URL', $_ENV['APP_URL']);
define('ADMIN_URL', BASE_URL . 'admin/');
?>