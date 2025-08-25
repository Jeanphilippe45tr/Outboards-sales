<?php
require_once __DIR__ . '/db_connection.php';

function loginUser($username, $password)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        $_SESSION['email'] = $user['email'];

        return true;
    }

    return false;
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function isAdmin()
{
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
}

function redirectIfNotLoggedIn()
{
    if (!isLoggedIn()) {
        header("Location: " . BASE_URL . "auth/login.php");
        exit();
    }
}

function redirectIfNotAdmin()
{
    redirectIfNotLoggedIn();
    if (!isAdmin()) {
        header("Location: " . BASE_URL);
        exit();
    }
}