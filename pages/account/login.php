<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once(__DIR__ . '/../../includes/config.php');
require_once(__DIR__ . '/../../includes/database.php');
require_once(__DIR__ . '/../../includes/auth.php');
require_once(__DIR__ . '/../../includes/functions.php');

// Redirect if already logged in
if (isLoggedIn()) {
    $redirect = isAdmin() ? '../admin/dashboard.php' : 'dashboard.php';
    header('Location: ' . $redirect);
    exit();
}

$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = 'Please fill in all fields';
    } else {
        $user = loginUser($email, $password);

        if ($user) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['is_admin'] = $user['is_admin'];

            // Redirect based on user type
            if ($user['is_admin']) {
                header('Location: ../admin/dashboard.php');
            } else {
                header('Location: dashboard.php');
            }
            exit();
        } else {
            $error = 'Invalid email or password';
        }
    }
}

// Include header
$page_title = 'Login - WaveMaster Outboards';
include(__DIR__ . '/../../includes/header.php');
?>

<div class="auth-container">
    <div class="wave-bg"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="auth-card">
                    <div class="card-header">
                        <div class="logo-container">
                            <img src="/assets/images/logo.png" alt="WaveMaster Outboards" class="logo">
                            <h1>WaveMaster Outboards</h1>
                        </div>
                        <h2 class="animate-float">Welcome Back</h2>
                        <p>Sign in to access your account</p>
                    </div>

                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger animate-shake">
                                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="" class="auth-form">
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i> Email Address
                                </label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo htmlspecialchars($email); ?>" required
                                    placeholder="Enter your email">
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Password
                                </label>
                                <input type="password" class="form-control" id="password" name="password" required
                                    placeholder="Enter your password">
                                <div class="password-toggle">
                                    <i class="fas fa-eye" id="togglePassword"></i>
                                </div>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block waves-effect">
                                <i class="fas fa-sign-in-alt"></i> Sign In
                            </button>
                        </form>

                        <div class="auth-links">
                            <a href="register.php" class="link-sea">
                                <i class="fas fa-user-plus"></i> Create New Account
                            </a>
                            <a href="forgot-password.php" class="link-sea">
                                <i class="fas fa-key"></i> Forgot Password?
                            </a>
                        </div>
                    </div>

                    <div class="card-footer">
                        <p>&copy; <?php echo date('Y'); ?> WaveMaster Outboards. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Password visibility toggle
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

<?php include 'includes/footer.php'; ?>