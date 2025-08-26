<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PowerWave Outboards</title>
    <style>
        /* Base Styles and Variables */
        :root {
            --primary-color: #006994;
            --secondary-color: #003b5c;
            --accent-color: #00a0df;
            --light-color: #e6f2ff;
            --dark-color: #00263b;
            --text-color: #333;
            --text-light: #777;
            --white: #ffffff;
            --gray-light: #f5f5f5;
            --gray: #ddd;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --font-primary: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            --transition: all 0.3s ease;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --border-radius: 4px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-primary);
            color: var(--text-color);
            line-height: 1.6;
            background-color: var(--white);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow-x: hidden;
        }

        /* Water-themed background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--light-color) 0%, var(--primary-color) 100%);
            z-index: -1;
            opacity: 0.9;
        }

        /* Animated wave effect */
        .wave {
            position: absolute;
            width: 100%;
            height: 15vh;
            bottom: 0;
            left: 0;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" fill="%23006994"><path d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z" opacity=".25" /></svg>');
            background-size: 1200px 100%;
            animation: wave 12s linear infinite;
            z-index: -1;
        }

        .wave:nth-child(2) {
            animation-delay: -5s;
            animation-duration: 15s;
            opacity: 0.5;
            background-position-y: 10px;
        }

        .wave:nth-child(3) {
            animation-delay: -2s;
            animation-duration: 18s;
            opacity: 0.7;
            background-position-y: 15px;
        }

        @keyframes wave {
            0% {
                background-position-x: 0;
            }

            100% {
                background-position-x: 1200px;
            }
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Register Section */
        .register-section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            padding: 40px 0;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 15px 30px rgba(0, 105, 148, 0.2);
            width: 100%;
            max-width: 800px;
            overflow: hidden;
            animation: fadeIn 0.5s ease-out;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            padding: 30px 20px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .register-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 60%);
            transform: rotate(30deg);
            animation: shine 8s infinite linear;
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%) rotate(30deg);
            }

            100% {
                transform: translateX(100%) rotate(30deg);
            }
        }

        .register-logo {
            display: inline-flex;
            align-items: center;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .register-logo img {
            height: 50px;
            margin-right: 10px;
        }

        .register-logo span {
            font-size: 24px;
            font-weight: bold;
        }

        .register-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            position: relative;
            z-index: 1;
        }

        .register-header p {
            font-size: 14px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .register-body {
            padding: 30px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .form-group {
            flex: 1 0 calc(50% - 20px);
            margin: 0 10px 20px;
            position: relative;
            min-width: 250px;
        }

        .form-group-full {
            flex: 1 0 calc(100% - 20px);
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-color);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--gray);
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: var(--transition);
            background-color: var(--gray-light);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(0, 160, 223, 0.2);
            background-color: var(--white);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 40px;
            cursor: pointer;
            color: var(--text-light);
        }

        .password-strength {
            height: 5px;
            margin-top: 8px;
            border-radius: 5px;
            background: var(--gray);
            overflow: hidden;
            position: relative;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
            border-radius: 5px;
        }

        .password-strength-weak {
            background-color: var(--danger);
            width: 33%;
        }

        .password-strength-medium {
            background-color: var(--warning);
            width: 66%;
        }

        .password-strength-strong {
            background-color: var(--success);
            width: 100%;
        }

        .password-strength-text {
            font-size: 12px;
            margin-top: 4px;
            color: var(--text-light);
        }

        .terms-agree {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .terms-agree input {
            margin-top: 5px;
            margin-right: 10px;
        }

        .terms-agree label {
            font-size: 14px;
            line-height: 1.4;
        }

        .terms-agree a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .terms-agree a:hover {
            text-decoration: underline;
        }

        .btn-register {
            display: block;
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 105, 148, 0.3);
        }

        .register-divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: var(--text-light);
        }

        .register-divider::before,
        .register-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: var(--gray);
        }

        .register-divider span {
            padding: 0 15px;
            font-size: 14px;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid var(--gray);
            border-radius: var(--border-radius);
            background: var(--white);
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-social:hover {
            background: var(--gray-light);
        }

        .btn-social img {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

        .register-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: var(--text-light);
        }

        .register-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }

        /* Alert Messages */
        .alert {
            padding: 12px 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            display: none;
        }

        .alert-error {
            background-color: #fde8e8;
            color: var(--danger);
            border-left: 4px solid var(--danger);
        }

        .alert-success {
            background-color: #e8f5e9;
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--gray);
            z-index: 1;
        }

        .progress-bar {
            position: absolute;
            top: 15px;
            left: 0;
            height: 2px;
            background: var(--primary-color);
            z-index: 2;
            transition: width 0.5s ease;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 3;
        }

        .step-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--gray);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            font-weight: bold;
            transition: var(--transition);
        }

        .step.active .step-icon {
            background: var(--primary-color);
        }

        .step.completed .step-icon {
            background: var(--success);
        }

        .step-text {
            font-size: 12px;
            color: var(--text-light);
        }

        .step.active .step-text {
            color: var(--primary-color);
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-group {
                flex: 1 0 calc(100% - 20px);
            }

            .register-container {
                margin: 20px;
                width: calc(100% - 40px);
            }

            .register-body {
                padding: 20px;
            }

            .progress-steps {
                margin-bottom: 20px;
            }

            .step-text {
                display: none;
            }
        }

        /* Animation for form elements */
        .form-group {
            animation: slideIn 0.5s ease-out;
            animation-fill-mode: both;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.1s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.2s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.3s;
        }

        .form-group:nth-child(4) {
            animation-delay: 0.4s;
        }

        .form-group:nth-child(5) {
            animation-delay: 0.5s;
        }

        .form-group:nth-child(6) {
            animation-delay: 0.6s;
        }

        .terms-agree {
            animation-delay: 0.7s;
            animation: slideIn 0.5s ease-out both;
        }

        .btn-register {
            animation-delay: 0.8s;
            animation: slideIn 0.5s ease-out both;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    <!-- Wave background elements -->
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>

    <div class="register-section">
        <div class="register-container">
            <div class="register-header">
                <div class="register-logo">
                    <img src="<?php echo $base_url; ?>assets/images/icons/logo-white.png" alt="MarinePower Outboards">
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

                <form action="<?php echo $base_url; ?>includes/register.php" method="POST" id="register-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="username">Username *</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Choose a username" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Your email address" required>
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
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm Password *</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="Confirm your password" required>
                            <span class="password-toggle" id="confirm-password-toggle">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name *</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="Your first name" required>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name *</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Your last name" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                placeholder="Your phone number">
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
                        <label for="terms">I agree to the <a href="<?php echo $base_url; ?>pages/terms.php">Terms of
                                Service</a> and <a href="<?php echo $base_url; ?>pages/privacy.php">Privacy Policy</a>
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
                    <img src="<?php echo $base_url; ?>assets/images/icons/google.png" alt="Google">
                    Sign up with Google
                </button>

                <button class="btn-social">
                    <img src="<?php echo $base_url; ?>assets/images/icons/facebook.png" alt="Facebook">
                    Sign up with Facebook
                </button>

                <div class="register-footer">
                    Already have an account? <a href="<?php echo $base_url; ?>login.php">Sign in here</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Password visibility toggle
            const passwordToggle = document.getElementById('password-toggle');
            const passwordField = document.getElementById('password');
            const confirmPasswordToggle = document.getElementById('confirm-password-toggle');
            const confirmPasswordField = document.getElementById('confirm_password');

            passwordToggle.addEventListener('click', function () {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    passwordToggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    passwordField.type = 'password';
                    passwordToggle.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });

            confirmPasswordToggle.addEventListener('click', function () {
                if (confirmPasswordField.type === 'password') {
                    confirmPasswordField.type = 'text';
                    confirmPasswordToggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    confirmPasswordField.type = 'password';
                    confirmPasswordToggle.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });

            // Password strength indicator
            passwordField.addEventListener('input', function () {
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

            registerForm.addEventListener('submit', function (event) {
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