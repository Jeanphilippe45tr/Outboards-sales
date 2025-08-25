<?php
require_once __DIR__ . '/../includes/auth.php';

if (isLoggedIn()) {
    header("Location: " . (isAdmin() ? ADMIN_URL : BASE_URL . "user/dashboard.php"));
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = 'Please fill in all fields';
    } elseif (loginUser($email, $password)) {
        header("Location: " . (isAdmin() ? ADMIN_URL : BASE_URL . "admin/dashboard.php"));
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}

$pageTitle = "Login - MarinePower Outboards";
require_once __DIR__ . '/../includes/header.php';
?>
<!-- Wave background elements -->
<div class="wave"></div>
<div class="wave"></div>
<div class="wave"></div>

<div class="login-section">
    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">
                <img src="<?php echo BASE_URL; ?>assets/images/icons/logo-white.png" alt="MarinePower Outboards">
                <span>MarinePower</span>
            </div>
            <h1>Welcome Back</h1>
            <p>Sign in to access your account</p>
        </div>

        <div class="login-body">
            <!-- Alert messages (will be shown/hidden by PHP) -->
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <div class="alert alert-success" id="success-message">
                Login successful! Redirecting to your account...
            </div>

            <form action="login.php" method="POST" id="login-form">
                <div class="form-group">
                    <label for="username">Username or Email</label>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Enter your username or email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your password" required>
                    <span class="password-toggle" id="password-toggle">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="<?php echo BASE_URL; ?>pages/account/forgot-password.php"
                        class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-login" name="login">Sign In</button>
            </form>

            <div class="login-divider">
                <span>Or continue with</span>
            </div>

            <button class="btn-social">
                <img src="<?php echo BASE_URL; ?>assets/images/icons/google.png" alt="Google">
                Sign in with Google
            </button>

            <button class="btn-social">
                <img src="<?php echo BASE_URL; ?>assets/images/icons/facebook.png" alt="Facebook">
                Sign in with Facebook
            </button>

            <div class="login-footer">
                Don't have an account? <a href="register.php">Create one
                    here</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password visibility toggle
        const passwordToggle = document.getElementById('password-toggle');
        const passwordField = document.getElementById('password');

        passwordToggle.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordToggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordField.type = 'password';
                passwordToggle.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });

        // Form validation
        const loginForm = document.getElementById('login-form');

        loginForm.addEventListener('submit', function(event) {
            let isValid = true;
            const username = document.getElementById('username');
            const password = document.getElementById('password');

            // Basic validation
            if (username.value.trim() === '') {
                isValid = false;
                highlightError(username);
            } else {
                removeHighlight(username);
            }

            if (password.value === '') {
                isValid = false;
                highlightError(password);
            } else {
                removeHighlight(password);
            }

            if (!isValid) {
                event.preventDefault();
                // Show error message
                const errorMessage = document.getElementById('error-message');
                errorMessage.textContent = 'Please fill in all required fields.';
                errorMessage.style.display = 'block';
            }
        });

        function highlightError(element) {
            element.style.borderColor = 'var(--danger)';
            element.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.2)';
        }

        function removeHighlight(element) {
            element.style.borderColor = '';
            element.style.boxShadow = '';
        }
    });
</script>

<!-- Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>