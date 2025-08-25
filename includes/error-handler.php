<?php
// error-handler.php - Centralized error handling for outboard sales system

// Set error reporting based on environment
if ($_ENV['APP_ENV'] === 'development') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
}

/**
 * Custom error handler function
 */
function custom_error_handler($errno, $errstr, $errfile, $errline) {
    $error_types = array(
        E_ERROR => 'Fatal Error',
        E_WARNING => 'Warning',
        E_PARSE => 'Parse Error',
        E_NOTICE => 'Notice',
        E_CORE_ERROR => 'Core Error',
        E_CORE_WARNING => 'Core Warning',
        E_USER_ERROR => 'User Error',
        E_USER_WARNING => 'User Warning',
        E_USER_NOTICE => 'User Notice',
        E_STRICT => 'Strict Notice',
        E_RECOVERABLE_ERROR => 'Recoverable Error'
    );

    $error_type = isset($error_types[$errno]) ? $error_types[$errno] : 'Unknown Error';
    $error_message = "[$error_type] $errstr in $errfile on line $errline";
    
    // Log error to file
    log_error($error_message);
    
    // Display error based on environment
    if ($_ENV['APP_ENV'] === 'development') {
        echo "<div class='error-message'>";
        echo "<h3>Error Occurred:</h3>";
        echo "<p><strong>Type:</strong> $error_type</p>";
        echo "<p><strong>Message:</strong> $errstr</p>";
        echo "<p><strong>File:</strong> $errfile</p>";
        echo "<p><strong>Line:</strong> $errline</p>";
        echo "</div>";
    } else {
        // In production, show generic error to users
        if ($errno === E_ERROR || $errno === E_USER_ERROR) {
            show_error_page();
        }
    }
    
    // Don't execute PHP's internal error handler
    return true;
}

/**
 * Exception handler
 */
function custom_exception_handler($exception) {
    $error_message = "Uncaught Exception: " . $exception->getMessage() . 
                    " in " . $exception->getFile() . 
                    " on line " . $exception->getLine();
    
    log_error($error_message);
    log_error("Stack trace: " . $exception->getTraceAsString());
    
    if ($_ENV['APP_ENV'] === 'development') {
        echo "<div class='error-message'>";
        echo "<h3>Uncaught Exception:</h3>";
        echo "<p><strong>Message:</strong> " . $exception->getMessage() . "</p>";
        echo "<p><strong>File:</strong> " . $exception->getFile() . "</p>";
        echo "<p><strong>Line:</strong> " . $exception->getLine() . "</p>";
        echo "<pre>" . $exception->getTraceAsString() . "</pre>";
        echo "</div>";
    } else {
        show_error_page();
    }
}

/**
 * Fatal error handler
 */
function fatal_error_handler() {
    $last_error = error_get_last();
    
    if ($last_error !== null && $last_error['type'] === E_ERROR) {
        $error_message = "Fatal Error: " . $last_error['message'] . 
                        " in " . $last_error['file'] . 
                        " on line " . $last_error['line'];
        
        log_error($error_message);
        
        if ($_ENV['APP_ENV'] === 'production') {
            show_error_page();
        }
    }
}

/**
 * Log errors to file
 */
function log_error($message) {
    $log_file = 'temp/error_log.txt';
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[$timestamp] $message" . PHP_EOL;
    
    // Ensure temp directory exists
    if (!file_exists('temp')) {
        mkdir('temp', 0755, true);
    }
    
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
}

/**
 * Database error handler
 */
function handle_db_error($pdo_exception) {
    $error_message = "Database Error: " . $pdo_exception->getMessage();
    log_error($error_message);
    
    if ($_ENV['APP_ENV'] === 'development') {
        echo "<div class='db-error'>";
        echo "<h3>Database Error:</h3>";
        echo "<p>" . $pdo_exception->getMessage() . "</p>";
        echo "</div>";
    } else {
        show_error_page("We're experiencing technical difficulties. Please try again later.");
    }
}

/**
 * File upload error handler
 */
function handle_upload_error($upload_error_code) {
    $upload_errors = array(
        UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload'
    );
    
    $error_message = isset($upload_errors[$upload_error_code]) ? 
                    $upload_errors[$upload_error_code] : 'Unknown upload error';
    
    throw new Exception($error_message);
}

/**
 * Show generic error page
 */
function show_error_page($message = "An unexpected error occurred. Please try again later.") {
    // Clear any previous output
    if (ob_get_level()) {
        ob_clean();
    }
    
    http_response_code(500);
    include 'includes/header.php';
    ?>
    <div class="error-page">
        <div class="container">
            <h1>Oops! Something went wrong</h1>
            <p><?php echo htmlspecialchars($message); ?></p>
            <a href="/" class="btn btn-primary">Return to Home</a>
            <a href="/pages/contact.php" class="btn btn-secondary">Contact Support</a>
        </div>
    </div>
    <?php
    include 'includes/footer.php';
    exit;
}

/**
 * Validate and handle admin actions
 */
function handle_admin_error($action, $error) {
    log_error("Admin Error in $action: $error");
    
    if ($_ENV['APP_ENV'] === 'development') {
        $_SESSION['flash_message'] = "Debug: $error";
        $_SESSION['flash_type'] = 'danger';
    } else {
        $_SESSION['flash_message'] = "An error occurred while performing this action.";
        $_SESSION['flash_type'] = 'danger';
    }
}

// Set custom error handlers
set_error_handler('custom_error_handler');
set_exception_handler('custom_exception_handler');
register_shutdown_function('fatal_error_handler');

// Example usage in application files:
/*
// In admin/products/add.php:
try {
    $stmt = $pdo->prepare("INSERT INTO products (name, price) VALUES (?, ?)");
    $stmt->execute([$name, $price]);
} catch (PDOException $e) {
    handle_db_error($e);
}

// In any file handling uploads:
if ($_FILES['product_image']['error'] !== UPLOAD_ERR_OK) {
    handle_upload_error($_FILES['product_image']['error']);
}
*/
?>