<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set default timezone
date_default_timezone_set('UTC');

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
$username = $isLoggedIn ? $_SESSION['username'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PowerWave Outboards - Premium Outboard Motors</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/responsive.css">
    <title><?php echo htmlspecialchars($pageTitle ?? 'MarinePower Outboards - Premium Outboard Motors'); ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/login.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Top Announcement Bar -->
    <div class="announcement-bar">
        <div class="container">
            <p>Free shipping on orders over $500! | Expert advice: 1-800-MARINE-1</p>
        </div>
    </div>

    <!-- Header Section -->
    <header class="main-header">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <div class="logo">
                    <<<<<<< Updated upstream <a href="<?php echo $base_url; ?>index.php">
                        <img src="<?php echo $base_url; ?>assets/images/icons/logo.png" alt="MarinePower Outboards">
                        <span>PowerWave</span>
                        =======
                        <a href="<?php echo BASE_URL; ?>index.php">
                            <img src="<?php echo BASE_URL; ?>assets/images/icons/logo.png" alt="MarinePower Outboards">
                            <span>MarinePower</span>
                            >>>>>>> Stashed changes
                        </a>
                </div>

                <!-- Main Navigation -->
                <nav class="main-nav">
                    <ul>
                        <li><a href="<?php echo BASE_URL; ?>index.php">Home</a></li>
                        <li class="has-dropdown">
                            <a href="<?php echo BASE_URL; ?>pages/products/">Products <i
                                    class="fas fa-chevron-down"></i></a>
                            <div class="dropdown-menu">
                                <div class="dropdown-content">
                                    <div class="dropdown-column">
                                        <h4>By Type</h4>
                                        <a href="<?php echo BASE_URL; ?>pages/products/category.php?type=2-stroke">2-Stroke
                                            Motors</a>
                                        <a href="<?php echo BASE_URL; ?>pages/products/category.php?type=4-stroke">4-Stroke
                                            Motors</a>
                                        <a href="<?php echo BASE_URL; ?>pages/products/category.php?type=electric">Electric
                                            Motors</a>
                                        <a href="<?php echo BASE_URL; ?>pages/products/category.php?type=portable">Portable
                                            Motors</a>
                                    </div>
                                    <div class="dropdown-column">
                                        <h4>By Horsepower</h4>
                                        <a href="<?php echo BASE_URL; ?>pages/products/category.php?hp=low">Low HP
                                            (2-25)</a>
                                        <a href="<?php echo BASE_URL; ?>pages/products/category.php?hp=mid">Mid HP
                                            (30-100)</a>
                                        <a href="<?php echo BASE_URL; ?>pages/products/category.php?hp=high">High HP
                                            (115-300)</a>
                                    </div>
                                    <div class="dropdown-column">
                                        <h4>By Brand</h4>
                                        <a
                                            href="<?php echo BASE_URL; ?>pages/products/category.php?brand=yamaha">Yamaha</a>
                                        <a
                                            href="<?php echo BASE_URL; ?>pages/products/category.php?brand=mercury">Mercury</a>
                                        <a
                                            href="<?php echo BASE_URL; ?>pages/products/category.php?brand=suzuki">Suzuki</a>
                                        <a href="<?php echo BASE_URL; ?>pages/products/category.php?brand=other">Other
                                            Brands</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="<?php echo BASE_URL; ?>pages/contact.php">Contact</a></li>
                        <li><a href="<?php echo BASE_URL; ?>pages/about.php">About Us</a></li>
                    </ul>
                </nav>

                <!-- Header Actions -->
                <div class="header-actions">
                    <!-- Search -->
                    <div class="search-box">
                        <form action="<?php echo BASE_URL; ?>search.php" method="GET">
                            <input type="text" name="q" placeholder="Search products...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

                    <!-- User Account -->
                    <div class="account-dropdown">
                        <a href="#" class="account-icon"><i class="fas fa-user"></i></a>
                        <div class="dropdown-menu account-menu">
                            <?php if ($isLoggedIn): ?>
                                <p>Hello, <?php echo htmlspecialchars($username); ?></p>
                                <a href="<?php echo BASE_URL; ?>pages/account/dashboard.php">Dashboard</a>
                                <a href="<?php echo BASE_URL; ?>pages/account/orders.php">My Orders</a>
                                <a href="<?php echo BASE_URL; ?>pages/account/profile.php">Profile</a>
                                <?php if ($isAdmin): ?>
                                    <a href="<?php echo ADMIN_URL; ?>dashboard.php">Admin Panel</a>
                                <?php endif; ?>
                                <a href="<?php echo BASE_URL; ?>includes/logout.php">Logout</a>
                            <?php else: ?>
                                <a href="<?php echo BASE_URL; ?>pages/account/login.php">Login</a>
                                <a href="<?php echo BASE_URL; ?>pages/account/register.php">Register</a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Wishlist -->
                    <a href="<?php echo BASE_URL; ?>pages/account/wishlist.php" class="wishlist-icon">
                        <i class="fas fa-heart"></i>
                        <span class="count-badge">0</span>
                    </a>

                    <!-- Cart -->
                    <div class="cart-dropdown">
                        <a href="<?php echo BASE_URL; ?>pages/cart.php" class="cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="count-badge">0</span>
                        </a>
                        <div class="dropdown-menu cart-menu">
                            <div class="cart-items">
                                <p>Your cart is empty</p>
                            </div>
                            <div class="cart-footer">
                                <a href="<?php echo BASE_URL; ?>pages/cart.php" class="view-cart-btn">View Cart</a>
                                <a href="<?php echo BASE_URL; ?>pages/checkout.php" class="checkout-btn">Checkout</a>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Toggle -->
                    <button class="mobile-menu-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Navigation -->
    <div class="mobile-nav">
        <div class="mobile-nav-content">
            <ul>
                <li><a href="<?php echo BASE_URL; ?>index.php">Home</a></li>
                <li class="has-submenu">
                    <a href="#">Products <i class="fas fa-chevron-down"></i></a>
                    <ul class="submenu">
                        <li><a href="<?php echo BASE_URL; ?>pages/products/">All Products</a></li>
                        <li><a href="<?php echo BASE_URL; ?>pages/products/category.php?type=2-stroke">2-Stroke
                                Motors</a></li>
                        <li><a href="<?php echo BASE_URL; ?>pages/products/category.php?type=4-stroke">4-Stroke
                                Motors</a></li>
                        <li><a href="<?php echo BASE_URL; ?>pages/products/category.php?type=electric">Electric
                                Motors</a></li>
                        <li><a href="<?php echo BASE_URL; ?>pages/products/category.php?type=portable">Portable
                                Motors</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo BASE_URL; ?>pages/contact.php">Contact</a></li>
                <li><a href="<?php echo BASE_URL; ?>pages/about.php">About Us</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="<?php echo BASE_URL; ?>pages/account/dashboard.php">My Account</a></li>
                    <li><a href="<?php echo BASE_URL; ?>includes/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?php echo BASE_URL; ?>pages/account/login.php">Login</a></li>
                    <li><a href="<?php echo BASE_URL; ?>pages/account/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Main Content Container -->
    <main class="main-content"></main>