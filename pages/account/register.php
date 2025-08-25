<?php
require_once __DIR__ . '/../includes/auth';

if (isLoggedIn()) {
    header("Location: " . (isAdmin() ? ADMIN_URL : BASE_URL . "user/dashboard.php"));
    exit();
}

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $phone = trim($_POST['phone'] ?? '');

    // Validate inputs
    if (empty($username)) {
        $errors['username'] = 'Username is required';
    } elseif (strlen($username) < 4) {
        $errors['username'] = 'Username must be at least 4 characters';
    }

    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

    if (empty($first_name)) {
        $errors['first_name'] = 'First name is required';
    }

    if (empty($last_name)) {
        $errors['last_name'] = 'Last name is required';
    }

    // Check if username or email already exists
    if (empty($errors)) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT user_id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);

        if ($stmt->fetch()) {
            $errors['general'] = 'Username or email already exists';
        }
    }

    // If no errors, register the user
    if (empty($errors)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERRegisterT INTO users 
            (username, email, password_hash, first_name, last_name, phone, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())");

        if ($stmt->execute([$username, $email, $password_hash, $first_name, $last_name, $phone])) {
            $success = 'Registration successful! You can now login.';
            // Clear form
            $username = $email = $first_name = $last_name = $phone = '';
        } else {
            $errors['general'] = 'Registration failed. Please try again.';
        }
    }
}

$pageTitle = "Register - PowerWave Outboards";
require_once __DIR__ . '/../includes/header.php';
?>


<!-- Wave background elements -->
<div class="wave"></div>
<div class="wave"></div>
<div class="wave"></div>

<div class="register-section">
    <div class="register-container">
        <div class="register-header">
            <div class="register-logo">
                <img src="<?php echo BASE_URL; ?>assets/images/icons/logo-white.png" alt="MarinePower Outboards">
                <span>PowerWave</span>
            </div>
            <h1>Create Your Account</h1>
            <p>Join us to explore our premium outboard motors</p>
        </div>

        <div class="register-body">
            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="progress-bar" style="width: 33%;"></div>
                <div class="step completed">
                    <div class="step-icon">1</div>
                    <div class="step-text">Account</div>
                </div>
                <div class="step active">
                    <div class="step-icon">2</div>
                    <div class="step-text">Details</div>
                </div>
                <div class="step">
                    <div class="step-icon">3</div>
                    <div class="step-text">Complete</div>
                </div>
            </div>

            <!-- Alert messages (will be shown/hidden by PHP) -->
            <div class="alert alert-error" id="error-message">
                Please fix the errors in the form.
            </div>

            <div class="alert alert-success" id="success-message">
                Registration successful! Redirecting to your account...
            </div>

            <form action="<?php echo BASE_URL; ?>includes/register.php" method="POST" id="register-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="username">Username *</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Choose a username" 
                           value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
                    <?php if (!empty($errors['username'])): ?>
                            <small class="error-message"><?php echo htmlspecialchars($errors['username']); ?></small>
                    <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Your email address" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                    <?php if (!empty($errors['email'])): ?>
                            <small class="error-message"><?php echo htmlspecialchars($errors['email']); ?></small>
                    <?php endif; ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Create a password" required>
                        <span class="password-toggle" id="password-toggle">
                            <i class="fas fa-eye"></i>
                        </span>
                        <div class="password-strength">
                            <div class="password-strength-bar" id="password-strength-bar"></div>
                        </div>
                        <div class="password-strength-text" id="password-strength-text">Password strength</div>
                        <?php if (!empty($errors['password'])): ?>
                            <small class="error-message"><?php echo htmlspecialchars($errors['password']); ?></small>
                    <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm Password *</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                            placeholder="Confirm your password" required>
                        <span class="password-toggle" id="confirm-password-toggle">
                            <i class="fas fa-eye"></i>
                        </span>
                        <?php if (!empty($errors['confirm_password'])): ?>
                            <small class="error-message"><?php echo htmlspecialchars($errors['confirm_password']); ?></small>
                    <?php endif; ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                            placeholder="Your first name" value="<?php echo htmlspecialchars($first_name ?? ''); ?>" required>
                    <?php if (!empty($errors['first_name'])): ?>
                            <small class="error-message"><?php echo htmlspecialchars($errors['first_name']); ?></small>
                    <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            placeholder="Your last name" value="<?php echo htmlspecialchars($last_name ?? ''); ?>" required>
                    <?php if (!empty($errors['last_name'])): ?>
                            <small class="error-message"><?php echo htmlspecialchars($errors['last_name']); ?></small>
                    <?php endif; ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone"
                            placeholder="Your phone number"  value="<?php echo htmlspecialchars($phone ?? ''); ?>">>
                    </div>

                    <div class="form-group">
                        <label for="country">Country</label>
                        <select class="form-control" id="country" name="country">
                            <option value="">Select Country</option>
                            <option value="USA" selected>United States</option>
                            <option value="CAN">Canada</option>
                            <option value="UK">United Kingdom</option>
                            <option value="AUS">Australia</option>
                            <!-- More options will be added by PHP -->
                        </select>
                    </div>
                </div>

                <div class="form-group form-group-full">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        placeholder="Your street address">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Your city">
                    </div>

                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="Your state">
                    </div>

                    <div class="form-group">
                        <label for="zip_code">ZIP Code</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code"
                            placeholder="Your ZIP code">
                    </div>
                </div>

                <div class="terms-agree">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to the <a href="<?php echo BASE_URL; ?>pages/terms.php">Terms of
                            Service</a> and <a href="<?php echo BASE_URL; ?>pages/privacy.php">Privacy Policy</a>
                        *</label>
                </div>

                <div class="terms-agree">
                    <input type="checkbox" id="newsletter" name="newsletter" checked>
                    <label for="newsletter">Send me updates about new products, promotions, and boating tips</label>
                </div>

                <button type="submit" class="btn-register" name="register">Create Account</button>
            </form>

            <div class="register-divider">
                <span>Or sign up with</span>
            </div>

            <button class="btn-social">
                <img src="<?php echo BASE_URL; ?>assets/images/icons/google.png" alt="Google">
                Sign up with Google
            </button>

            <button class="btn-social">
                <img src="<?php echo BASE_URL; ?>assets/images/icons/facebook.png" alt="Facebook">
                Sign up with Facebook
            </button>

            <div class="register-footer">
                Already have an account? <a href="<?php echo BASE_URL; ?>pages/account/login.php">Sign in here</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password visibility toggle
        const passwordToggle = document.getElementById('password-toggle');
        const passwordField = document.getElementById('password');
        const confirmPasswordToggle = document.getElementById('confirm-password-toggle');
        const confirmPasswordField = document.getElementById('confirm_password');

        passwordToggle.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordToggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordField.type = 'password';
                passwordToggle.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });

        confirmPasswordToggle.addEventListener('click', function() {
            if (confirmPasswordField.type === 'password') {
                confirmPasswordField.type = 'text';
                confirmPasswordToggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                confirmPasswordField.type = 'password';
                confirmPasswordToggle.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });

        // Password strength indicator
        passwordField.addEventListener('input', function() {
            const password = passwordField.value;
            const strengthBar = document.getElementById('password-strength-bar');
            const strengthText = document.getElementById('password-strength-text');

            // Reset classes
            strengthBar.className = 'password-strength-bar';

            if (password.length === 0) {
                strengthBar.style.width = '0';
                strengthText.textContent = 'Password strength';
                return;
            }

            // Calculate strength
            let strength = 0;

            // Length check
            if (password.length >= 8) strength += 1;

            // Contains lowercase, uppercase, numbers, special chars
            if (password.match(/[a-z]+/)) strength += 1;
            if (password.match(/[A-Z]+/)) strength += 1;
            if (password.match(/[0-9]+/)) strength += 1;
            if (password.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/)) strength += 1;

            // Update UI based on strength
            if (strength < 2) {
                strengthBar.classList.add('password-strength-weak');
                strengthBar.style.width = '33%';
                strengthText.textContent = 'Weak password';
                strengthText.style.color = 'var(--danger)';
            } else if (strength < 4) {
                strengthBar.classList.add('password-strength-medium');
                strengthBar.style.width = '66%';
                strengthText.textContent = 'Medium strength password';
                strengthText.style.color = 'var(--warning)';
            } else {
                strengthBar.classList.add('password-strength-strong');
                strengthBar.style.width = '100%';
                strengthText.textContent = 'Strong password';
                strengthText.style.color = 'var(--success)';
            }
        });

        // Form validation
        const registerForm = document.getElementById('register-form');

        registerForm.addEventListener('submit', function(event) {
            let isValid = true;
            const requiredFields = registerForm.querySelectorAll('[required]');

            // Check all required fields
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    highlightError(field);
                } else {
                    removeHighlight(field);
                }
            });

            // Check password match
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');

            if (password.value !== confirmPassword.value) {
                isValid = false;
                highlightError(confirmPassword);
                document.getElementById('error-message').textContent = 'Passwords do not match.';
                document.getElementById('error-message').style.display = 'block';
            } else {
                removeHighlight(confirmPassword);
            }

            // Check terms agreement
            const terms = document.getElementById('terms');
            if (!terms.checked) {
                isValid = false;
                document.getElementById('error-message').textContent = 'You must agree to the Terms of Service.';
                document.getElementById('error-message').style.display = 'block';
            }

            if (!isValid) {
                event.preventDefault();
                // Show error message if not already shown
                if (!document.getElementById('error-message').style.display ||
                    document.getElementById('error-message').style.display === 'none') {
                    document.getElementById('error-message').textContent = 'Please fill in all required fields.';
                    document.getElementById('error-message').style.display = 'block';
                }
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
</body>

</html>