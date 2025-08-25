<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MarinePower Outboards</title>
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

        /* Login Section */
        .login-section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            padding: 40px 0;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 15px 30px rgba(0, 105, 148, 0.2);
            width: 100%;
            max-width: 450px;
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

        .login-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            padding: 30px 20px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
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

        .login-logo {
            display: inline-flex;
            align-items: center;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .login-logo img {
            height: 50px;
            margin-right: 10px;
        }

        .login-logo span {
            font-size: 24px;
            font-weight: bold;
        }

        .login-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            position: relative;
            z-index: 1;
        }

        .login-header p {
            font-size: 14px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .login-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
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

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 5px;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn-login {
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

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 105, 148, 0.3);
        }

        .login-divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: var(--text-light);
        }

        .login-divider::before,
        .login-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: var(--gray);
        }

        .login-divider span {
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

        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: var(--text-light);
        }

        .login-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .login-footer a:hover {
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

        /* Responsive Design */
        @media (max-width: 576px) {
            .login-container {
                margin: 20px;
                width: calc(100% - 40px);
            }

            .login-body {
                padding: 20px;
            }

            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
            }

            .forgot-password {
                margin-top: 10px;
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

        .remember-forgot {
            animation-delay: 0.3s;
            animation: slideIn 0.5s ease-out both;
        }

        .btn-login {
            animation-delay: 0.4s;
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

    <div class="login-section">
        <div class="login-container">
            <div class="login-header">
                <div class="login-logo">
                    <img src="<?php echo $base_url; ?>assets/images/icons/logo-white.png" alt="MarinePower Outboards">
                    <span>MarinePower</span>
                </div>
                <h1>Welcome Back</h1>
                <p>Sign in to access your account</p>
            </div>

            <div class="login-body">
                <!-- Alert messages (will be shown/hidden by PHP) -->
                <div class="alert alert-error" id="error-message">
                    Invalid username or password. Please try again.
                </div>

                <div class="alert alert-success" id="success-message">
                    Login successful! Redirecting to your account...
                </div>

                <form action="<?php echo $base_url; ?>includes/auth.php" method="POST" id="login-form">
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
                        <a href="<?php echo $base_url; ?>pages/account/forgot-password.php"
                            class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-login" name="login">Sign In</button>
                </form>

                <div class="login-divider">
                    <span>Or continue with</span>
                </div>

                <button class="btn-social">
                    <img src="<?php echo $base_url; ?>assets/images/icons/google.png" alt="Google">
                    Sign in with Google
                </button>

                <button class="btn-social">
                    <img src="<?php echo $base_url; ?>assets/images/icons/facebook.png" alt="Facebook">
                    Sign in with Facebook
                </button>

                <div class="login-footer">
                    Don't have an account? <a href="<?php echo $base_url; ?>pages/account/register.php">Create one
                        here</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Password visibility toggle
            const passwordToggle = document.getElementById('password-toggle');
            const passwordField = document.getElementById('password');

            passwordToggle.addEventListener('click', function () {
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

            loginForm.addEventListener('submit', function (event) {
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
</body>

</html>