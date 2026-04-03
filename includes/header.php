<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | HyFun Foods' : 'HyFun Foods - Potatoes for the World'; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <?php if (isset($additionalCss)): ?>
        <link rel="stylesheet" href="./assets/css/<?php echo $additionalCss; ?>">
    <?php endif; ?>
</head>
<body>
    <div class="mobile-menu-btn" id="mobileMenuBtn">
        <i class="fas fa-bars"></i>
    </div>
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>
    <div class="mobile-menu-content" id="mobileMenuContent">
        <div class="mobile-menu-header">
            <div class="logo">
                <a href="index.php">
                    <img src="./assets/image/hyfun_logo.png" alt="HyFun Foods Logo" class="logo-image">
                </a>
            </div>
            <button class="close-menu-btn" id="closeMenuBtn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="mobile-nav">
            <ul>
                <li><a href="index.php" class="mobile-nav-link">Home</a></li>
                <li class="mobile-dropdown">
                    <a href="about.php" class="mobile-nav-link">About Us <i class="fas fa-chevron-down"></i></a>
                    <div class="mobile-dropdown-content">
                        <a href="culture.php">Our Culture</a>
                    </div>
                </li>
                <li class="mobile-dropdown">
                    <a href="products.php" class="mobile-nav-link">Products <i class="fas fa-chevron-down"></i></a>
                    <div class="mobile-dropdown-content">
                        <a href="products.php#french-fries">French Fries</a>
                        <a href="products.php#potato-specialties">Potato Specialties</a>
                        <a href="products.php#veggie-specialties">Veggie Specialties</a>
                        <a href="products.php#indian-ethnic">Indian Ethnic</a>
                    </div>
                </li>
                <li><a href="seedtoshelf.php" class="mobile-nav-link">Seed to Shelf</a></li>
                <li><a href="exports.php" class="mobile-nav-link">Exports</a></li>
                <li><a href="recipes.php" class="mobile-nav-link">Recipes</a></li>
                <li><a href="order.php" class="mobile-nav-link">Order Now😋</a></li>
                <li><a href="connect.php" class="mobile-nav-link">Connect</a></li>
            </ul>
        </nav>
    </div>
    <header>
        <div class="container header-container">
            <div class="logo">
                <a href="index.php">
                    <img src="./assets/image/hyfun_logo.png" alt="HyFun Foods Logo" class="logo-image">
                </a>
            </div>
            <nav class="desktop-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="dropdown">
                        <a href="about.php">About Us <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="culture.php">Our Culture</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="products.php">Products <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="products.php#french-fries">French Fries</a>
                            <a href="products.php#potato-specialties">Potato Specialties</a>
                            <a href="products.php#veggie-specialties">Veggie Specialties</a>
                            <a href="products.php#indian-ethnic">Indian Ethnic</a>
                        </div>
                    </li>
                    <li><a href="seedtoshelf.php">Seed to Shelf</a></li>
                    <li><a href="exports.php">Exports</a></li>
                    <li><a href="recipes.php">Recipes</a></li>
                    <li><a href="order.php">Order Now😋</a></li>
                    <li><a href="connect.php">Connect</a></li>
                </ul>
            </nav>
        </div>
    </header>