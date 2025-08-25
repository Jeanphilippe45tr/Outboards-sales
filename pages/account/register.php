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
$success = '';
$formData = [
    'username' => '',
    'email' => '',
    'first_name' => '',
    'last_name' => '',
    'phone' => '',
    'address' => '',
    'city' => '',
    'state' => '',
    'zip_code' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $formData = array_map('trim', $_POST);

    $username = $formData['username'];
    $email = $formData['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $first_name = $formData['first_name'];
    $last_name = $formData['last_name'];
    $phone = $formData['phone'];

    // Validate input
    if (
        empty($username) || empty($email) || empty($password) || empty($confirm_password) ||
        empty($first_name) || empty($last_name)
    ) {
        $error = 'Please fill in all required fields';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters long';
    } else {
        // Check if username or email already exists
        if (usernameExists($username)) {
            $error = 'Username already taken';
        } elseif (emailExists($email)) {
            $error = 'Email already registered';
        } else {
            // Register user
            $userId = registerUser($formData, $password);

            if ($userId) {
                $success = 'Registration successful! You can now login.';
                // Clear form data
                $formData = array_fill_keys(array_keys($formData), '');
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}

// Include header
$page_title = 'Register - WaveMaster Outboards';
include(__DIR__ . '/../../includes/header.php');
?>

<div class="auth-container">
    <div class="wave-bg"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="auth-card">
                    <div class="card-header">
                        <div class="logo-container">
                            <img src="../assets/images/logo.png" alt="WaveMaster Outboards" class="logo">
                            <h1>WaveMaster Outboards</h1>
                        </div>
                        <h2 class="animate-float">Create Your Account</h2>
                        <p>Join our community of boating enthusiasts</p>
                    </div>

                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger animate-shake">
                                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($success): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="" class="auth-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username" class="form-label">
                                            <i class="fas fa-user"></i> Username *
                                        </label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            value="<?php echo htmlspecialchars($formData['username']); ?>" required
                                            placeholder="Choose a username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope"></i> Email Address *
                                        </label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="<?php echo htmlspecialchars($formData['email']); ?>" required
                                            placeholder="Enter your email">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-lock"></i> Password *
                                        </label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required placeholder="At least 8 characters">
                                        <div class="password-toggle">
                                            <i class="fas fa-eye" id="togglePassword"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_password" class="form-label">
                                            <i class="fas fa-lock"></i> Confirm Password *
                                        </label>
                                        <input type="password" class="form-control" id="confirm_password"
                                            name="confirm_password" required placeholder="Confirm your password">
                                        <div class="password-toggle">
                                            <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" class="form-label">
                                            <i class="fas fa-id-card"></i> First Name *
                                        </label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="<?php echo htmlspecialchars($formData['first_name']); ?>" required
                                            placeholder="Your first name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name" class="form-label">
                                            <i class="fas fa-id-card"></i> Last Name *
                                        </label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="<?php echo htmlspecialchars($formData['last_name']); ?>" required
                                            placeholder="Your last name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">
                                            <i class="fas fa-phone"></i> Phone Number
                                        </label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            value="<?php echo htmlspecialchars($formData['phone']); ?>"
                                            placeholder="Your phone number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address" class="form-label">
                                            <i class="fas fa-home"></i> Address
                                        </label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="<?php echo htmlspecialchars($formData['address']); ?>"
                                            placeholder="Your address">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city" class="form-label">
                                            <i class="fas fa-city"></i> City
                                        </label>
                                        <input type="text" class="form-control" id="city" name="city"
                                            value="<?php echo htmlspecialchars($formData['city']); ?>"
                                            placeholder="Your city">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state" class="form-label">
                                            <i class="fas fa-map-marker-alt"></i> State
                                        </label>
                                        <input type="text" class="form-control" id="state" name="state"
                                            value="<?php echo htmlspecialchars($formData['state']); ?>"
                                            placeholder="Your state">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="zip_code" class="form-label">
                                            <i class="fas fa-mail-bulk"></i> ZIP Code
                                        </label>
                                        <input type="text" class="form-control" id="zip_code" name="zip_code"
                                            value="<?php echo htmlspecialchars($formData['zip_code']); ?>"
                                            placeholder="Your ZIP code">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="../terms.php" class="link-sea">Terms of Service</a> and <a
                                        href="../privacy.php" class="link-sea">Privacy Policy</a>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block waves-effect">
                                <i class="fas fa-user-plus"></i> Create Account
                            </button>
                        </form>

                        <div class="auth-links">
                            <a href="login.php" class="link-sea">
                                <i class="fas fa-sign-in-alt"></i> Already have an account? Sign In
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

    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('confirm_password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function (e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Passwords do not match!');
            return false;
        }

        if (password.length < 8) {
            e.preventDefault();
            alert('Password must be at least 8 characters long!');
            return false;
        }
    });
</script>

<?php include(__DIR__ . '/../../includes/footer.php'); ?>