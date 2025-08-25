<?php
// functions.php - Utility functions for outboard sales system

/**
 * Sanitize input data
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Format price with currency
 */
function format_price($price) {
    return '$' . number_format($price, 2);
}

/**
 * Generate product URL slug
 */
function create_slug($string) {
    $slug = strtolower($string);
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    return trim($slug, '-');
}

/**
 * Check if user is admin
 */
function is_admin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

/**
 * Check if user is logged in
 */
function is_logged_in() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Redirect with message
 */
function redirect($url, $message = '', $type = 'info') {
    if (!empty($message)) {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
    }
    header("Location: $url");
    exit();
}

/**
 * Display flash messages
 */
function display_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        $type = $_SESSION['flash_type'] ?? 'info';
        echo "<div class='alert alert-$type'>$message</div>";
        unset($_SESSION['flash_message'], $_SESSION['flash_type']);
    }
}

/**
 * Upload product image
 */
function upload_product_image($file, $product_id) {
    $target_dir = "assets/uploads/products/";
    $file_extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $new_filename = "product_" . $product_id . "_" . time() . "." . $file_extension;
    $target_file = $target_dir . $new_filename;
    
    // Check if image file is valid
    $allowed_types = array("jpg", "jpeg", "png", "gif");
    if (!in_array($file_extension, $allowed_types)) {
        throw new Exception("Only JPG, JPEG, PNG & GIF files are allowed");
    }
    
    // Check file size (5MB max)
    if ($file["size"] > 5000000) {
        throw new Exception("File is too large. Maximum size is 5MB");
    }
    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $new_filename;
    } else {
        throw new Exception("Failed to upload image");
    }
}

/**
 * Get cart item count
 */
function get_cart_count() {
    return isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
}

/**
 * Calculate cart total
 */
function calculate_cart_total($pdo) {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        return 0;
    }
    
    $total = 0;
    $product_ids = implode(',', array_keys($_SESSION['cart']));
    $stmt = $pdo->prepare("SELECT id, price FROM products WHERE id IN ($product_ids)");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($products as $product) {
        $quantity = $_SESSION['cart'][$product['id']];
        $total += $product['price'] * $quantity;
    }
    
    return $total;
}

/**
 * Generate order number
 */
function generate_order_number() {
    return 'ORD' . date('Ymd') . rand(1000, 9999);
}

/**
 * Send email notification
 */
function send_email($to, $subject, $body) {
    // This would integrate with PHPMailer
    require_once 'lib/PHPMailer/PHPMailer.php';
    // Email sending logic here
    return true; // simplified for example
}

/**
 * Log admin actions
 */
function log_admin_action($action, $details = '') {
    global $pdo;
    $user_id = $_SESSION['user_id'] ?? 0;
    $stmt = $pdo->prepare("INSERT INTO admin_logs (user_id, action, details, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$user_id, $action, $details]);
}

/**
 * Require admin access
 */
function require_admin() {
    if (!is_logged_in() || !is_admin()) {
        redirect('/pages/account/login.php', 'Admin access required', 'error');
    }
}

/**
 * Get product categories
 */
function get_categories($pdo) {
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Format date for display
 */
function format_date($date) {
    return date('M j, Y', strtotime($date));
}
?>