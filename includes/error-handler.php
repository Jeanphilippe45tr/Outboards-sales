<?php
// error-handler.php - Custom error handling

// Set custom error handler
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return false;
    }

    $errorTypes = [
        E_ERROR => 'ERROR',
        E_WARNING => 'WARNING',
        E_PARSE => 'PARSE',
        E_NOTICE => 'NOTICE',
        E_CORE_ERROR => 'CORE_ERROR',
        E_CORE_WARNING => 'CORE_WARNING',
        E_COMPILE_ERROR => 'COMPILE_ERROR',
        E_COMPILE_WARNING => 'COMPILE_WARNING',
        E_USER_ERROR => 'USER_ERROR',
        E_USER_WARNING => 'USER_WARNING',
        E_USER_NOTICE => 'USER_NOTICE',
        E_STRICT => 'STRICT',
        E_RECOVERABLE_ERROR => 'RECOVERABLE_ERROR',
        E_DEPRECATED => 'DEPRECATED',
        E_USER_DEPRECATED => 'USER_DEPRECATED'
    ];

    $errorType = isset($errorTypes[$errno]) ? $errorTypes[$errno] : 'UNKNOWN';

    $errorMessage = sprintf(
        "[%s] %s in %s on line %d",
        $errorType,
        $errstr,
        $errfile,
        $errline
    );

    error_log($errorMessage);

    // Don't display errors in production
    if (ini_get('display_errors')) {
        printf(
            '<div style="color: red; padding: 10px; margin: 10px; border: 1px solid red;">%s</div>',
            htmlspecialchars($errorMessage)
        );
    }

    return true;
});

// Set exception handler
set_exception_handler(function ($exception) {
    $errorMessage = sprintf(
        "Uncaught Exception: %s in %s on line %d\nStack trace:\n%s",
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine(),
        $exception->getTraceAsString()
    );

    error_log($errorMessage);

    // User-friendly error message
    if (ini_get('display_errors')) {
        printf(
            '<div style="color: red; padding: 10px; margin: 10px; border: 1px solid red;">%s</div>',
            'An unexpected error occurred. Please try again later.'
        );
    } else {
        // Log detailed error but show generic message
        error_log($errorMessage);
        if (!headers_sent()) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        echo 'An unexpected error occurred. Please try again later.';
    }
});

// Shutdown function for fatal errors
register_shutdown_function(function () {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        $errorMessage = sprintf(
            "Fatal Error: %s in %s on line %d",
            $error['message'],
            $error['file'],
            $error['line']
        );

        error_log($errorMessage);

        if (!headers_sent()) {
            header('HTTP/1.1 500 Internal Server Error');
        }
        echo 'A fatal error occurred. Please try again later.';
    }
});
?>