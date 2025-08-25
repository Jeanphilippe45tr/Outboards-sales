<?php
// functions.php - Utility functions

// Redirect to another page
function redirect($url)
{
    header("Location: " . $url);
    exit();
}

// Sanitize input data
function sanitizeInput($data)
{
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

    return $data;
}

// Get current URL
function getCurrentUrl()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

// Format price
function formatPrice($price)
{
    return '$' . number_format($price, 2);
}

// Generate random token
function generateToken($length = 32)
{
    return bin2hex(random_bytes($length));
}

// Check if request is AJAX
function isAjaxRequest()
{
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

// Get pagination parameters
function getPaginationParams($currentPage, $itemsPerPage)
{
    $currentPage = max(1, (int) $currentPage);
    $offset = ($currentPage - 1) * $itemsPerPage;

    return [
        'current_page' => $currentPage,
        'offset' => $offset,
        'limit' => $itemsPerPage
    ];
}

// Upload file with validation
function uploadFile($file, $targetDir, $allowedTypes = [], $maxSize = 2097152)
{
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("File upload error: " . $file['error']);
    }

    // Check file size
    if ($file['size'] > $maxSize) {
        throw new Exception("File is too large. Maximum size: " . ($maxSize / 1024 / 1024) . "MB");
    }

    // Check file type
    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!empty($allowedTypes) && !in_array($fileExt, $allowedTypes)) {
        throw new Exception("Invalid file type. Allowed: " . implode(', ', $allowedTypes));
    }

    // Generate unique filename
    $fileName = uniqid() . '_' . time() . '.' . $fileExt;
    $targetPath = $targetDir . $fileName;

    // Create directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        throw new Exception("Failed to move uploaded file.");
    }

    return $fileName;
}

// Delete file
function deleteFile($filePath)
{
    if (file_exists($filePath)) {
        return unlink($filePath);
    }
    return false;
}

// Send JSON response
function sendJsonResponse($data, $statusCode = 200)
{
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

// Validate email
function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Get client IP address
function getClientIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
?>