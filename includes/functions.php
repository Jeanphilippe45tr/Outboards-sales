<?php
// functions.php - Utility functions

// Redirect to another page
use JetBrains\PhpStorm\NoReturn;
use Random\RandomException;

#[NoReturn]
function redirect($url): void
{
    header("Location: " . $url);
    exit();
}

// Sanitize input data
function sanitizeInput($data): array|string
{
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }

    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Get current URL
function getCurrentUrl(): string
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

// Format price
function formatPrice($price): string
{
    return '$' . number_format($price, 2);
}

// Generate random token
/**
 * @throws RandomException
 */
function generateToken($length = 32): string
{
    return bin2hex(random_bytes($length));
}

// Check if request is AJAX
function isAjaxRequest(): bool
{
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

// Get pagination parameters
function getPaginationParams($currentPage, $itemsPerPage): array
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
/**
 * @throws Exception
 */
function uploadFile($file, $targetDir, $allowedTypes = [], $maxSize = 2097152): string
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
function deleteFile($filePath): bool
{
    if (file_exists($filePath)) {
        return unlink($filePath);
    }
    return false;
}

// Send JSON response
#[NoReturn]
function sendJsonResponse($data, $statusCode = 200): void
{
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

// Validate email
function isValidEmail($email): bool
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
