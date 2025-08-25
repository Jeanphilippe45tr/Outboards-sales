<?php
// auth.php - Authentication functions

class Auth
{
    private $db;
    private $user;

    public function __construct($database)
    {
        $this->db = $database;
    }

    // User registration
    public function register($userData)
    {
        try {
            // Validate input
            if (empty($userData['username']) || empty($userData['email']) || empty($userData['password'])) {
                throw new Exception("All fields are required.");
            }

            if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format.");
            }

            if (strlen($userData['password']) < 6) {
                throw new Exception("Password must be at least 6 characters long.");
            }

            // Check if user already exists
            if ($this->userExists($userData['email'], $userData['username'])) {
                throw new Exception("Username or email already exists.");
            }

            // Hash password
            $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);

            // Insert user
            $query = "INSERT INTO users (username, password, email, first_name, last_name, phone, address, city, state, zip_code, country, created_at) 
                     VALUES (:username, :password, :email, :first_name, :last_name, :phone, :address, :city, :state, :zip_code, :country, NOW())";

            $params = [
                ':username' => $userData['username'],
                ':password' => $hashedPassword,
                ':email' => $userData['email'],
                ':first_name' => $userData['first_name'] ?? '',
                ':last_name' => $userData['last_name'] ?? '',
                ':phone' => $userData['phone'] ?? '',
                ':address' => $userData['address'] ?? '',
                ':city' => $userData['city'] ?? '',
                ':state' => $userData['state'] ?? '',
                ':zip_code' => $userData['zip_code'] ?? '',
                ':country' => $userData['country'] ?? 'USA'
            ];

            $this->db->executeQuery($query, $params);
            $userId = $this->db->lastInsertId();

            return $userId;

        } catch (Exception $e) {
            error_log("Registration error: " . $e->getMessage());
            throw $e;
        }
    }

    // User login
    public function login($username, $password)
    {
        try {
            // Get user by username or email
            $query = "SELECT * FROM users WHERE (username = :identifier OR email = :identifier) AND is_active = 1";
            $stmt = $this->db->executeQuery($query, [':identifier' => $username]);
            $user = $stmt->fetch();

            if (!$user) {
                throw new Exception("Invalid username/email or password.");
            }

            // Verify password
            if (!password_verify($password, $user['password'])) {
                throw new Exception("Invalid username/email or password.");
            }

            // Update last login
            $this->updateLastLogin($user['id']);

            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_admin'] = $user['is_admin'];
            $_SESSION['logged_in'] = true;
            $_SESSION['login_time'] = time();

            return true;

        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            throw $e;
        }
    }

    // Check if user is logged in
    public function isLoggedIn()
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    // Check if user is admin
    public function isAdmin()
    {
        return $this->isLoggedIn() && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
    }

    // Get current user data
    public function getCurrentUser()
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        try {
            $query = "SELECT id, username, email, first_name, last_name, phone, address, city, state, zip_code, country, is_admin 
                     FROM users WHERE id = :id";
            $stmt = $this->db->executeQuery($query, [':id' => $_SESSION['user_id']]);
            return $stmt->fetch();
        } catch (Exception $e) {
            error_log("Get user error: " . $e->getMessage());
            return null;
        }
    }

    // Logout user
    public function logout()
    {
        session_unset();
        session_destroy();
        session_start();
    }

    // Check if user exists
    private function userExists($email, $username)
    {
        try {
            $query = "SELECT id FROM users WHERE email = :email OR username = :username";
            $stmt = $this->db->executeQuery($query, [
                ':email' => $email,
                ':username' => $username
            ]);
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            error_log("User exists check error: " . $e->getMessage());
            return false;
        }
    }

    // Update last login
    private function updateLastLogin($userId)
    {
        try {
            $query = "UPDATE users SET updated_at = NOW() WHERE id = :id";
            $this->db->executeQuery($query, [':id' => $userId]);
        } catch (Exception $e) {
            error_log("Update last login error: " . $e->getMessage());
        }
    }

    // Password reset request
    public function requestPasswordReset($email)
    {
        // Implementation for password reset
        // This would typically generate a token and send an email
    }

    // Validate password reset token
    public function validateResetToken($token)
    {
        // Implementation for token validation
    }

    // Update password
    public function updatePassword($userId, $newPassword)
    {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password = :password, updated_at = NOW() WHERE id = :id";
            $this->db->executeQuery($query, [
                ':password' => $hashedPassword,
                ':id' => $userId
            ]);
            return true;
        } catch (Exception $e) {
            error_log("Update password error: " . $e->getMessage());
            return false;
        }
    }
}
// Check if user is logged in
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

// Check if user is admin
function isAdmin()
{
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
}

// Login user
function loginUser($email, $password)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
    }

    return false;
}

// Register new user
function registerUser($data, $password)
{
    global $pdo;

    try {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password, email, first_name, last_name, phone, address, city, state, zip_code, country, created_at) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

        return $stmt->execute([
            $data['username'],
            $hashedPassword,
            $data['email'],
            $data['first_name'],
            $data['last_name'],
            $data['phone'] ?? null,
            $data['address'] ?? null,
            $data['city'] ?? null,
            $data['state'] ?? null,
            $data['zip_code'] ?? null,
            $data['country'] ?? 'USA'
        ]);

    } catch (PDOException $e) {
        error_log("Registration error: " . $e->getMessage());
        return false;
    }
}

// Check if username exists
function usernameExists($username)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetch() !== false;
}

// Check if email exists
function emailExists($email)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch() !== false;
}

// Redirect to login if not authenticated
function requireAuth()
{
    if (!isLoggedIn()) {
        header('Location: ../account/login.php');
        exit();
    }
}

// Redirect to admin dashboard if not admin
function requireAdmin()
{
    requireAuth();

    if (!isAdmin()) {
        header('Location: ../account/dashboard.php');
        exit();
    }
}
?>