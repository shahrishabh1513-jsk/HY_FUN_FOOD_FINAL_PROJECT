<?php
$pageTitle = "Premium Online Ordering";
$additionalCss = "order.css";
$additionalJs = ""; // Don't load external order.js - we'll use inline

require_once 'includes/functions.php';
$products = getProducts();
$productsJson = json_encode($products);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HyFun Foods - Premium Online Ordering</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/order.css">
    <link rel="icon" type="image/x-icon" href="./assets/image/hyfun_logo.png">
    <style>
        /* Additional styles for better visibility */
        .cart-sidebar-modern.active { right: 0; }
        .cart-sidebar-modern { position: fixed; top: 80px; right: -400px; width: 380px; height: calc(100vh - 80px); background: white; z-index: 999; transition: right 0.3s ease; box-shadow: -5px 0 30px rgba(0,0,0,0.15); }
        .btn-checkout-modern:disabled { opacity: 0.5; cursor: not-allowed; }
        .product-card-modern { cursor: pointer; transition: transform 0.3s, box-shadow 0.3s; }
        .product-card-modern:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
        .cart-badge { position: absolute; top: -5px; right: -5px; background: #ff4757; color: white; border-radius: 50%; width: 20px; height: 20px; font-size: 12px; display: flex; align-items: center; justify-content: center; }
        .cart-btn { position: relative; }
    </style>
</head>
<body>
    <input type="hidden" id="productsData" value='<?php echo htmlspecialchars($productsJson, ENT_QUOTES); ?>'>

    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="gradient-sphere"></div>
        <div class="gradient-sphere-2"></div>
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    </div>

    <!-- Sticky Header -->
    <header class="modern-header">
        <div class="header-container">
            <div class="header-left">
                <a href="index.php" class="logo-wrapper">
                    <img src="./assets/image/hyfun_logo.png" alt="HyFun Foods" class="logo-img" style="height: 50px;">
                </a>
            </div>
            <div class="header-right">
                <div class="user-profile" id="userProfile">
                    <div class="user-avatar"><i class="fas fa-user-circle"></i></div>
                    <span class="user-name" id="userName">Guest</span>
                </div>
                <div class="cart-preview" id="cartPreview">
                    <button class="cart-btn" id="cartToggleBtn" style="background: #78B04B; border: none; width: 50px; height: 50px; border-radius: 50%; cursor: pointer;">
                        <i class="fas fa-shopping-bag" style="color: white; font-size: 1.2rem;"></i>
                        <span class="cart-badge" id="cartCount">0</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- SECTION 1: Hero Landing -->
        <section id="section-hero" class="content-section active">
            <div class="hero-modern">
                <div class="hero-content-wrapper">
                    <div class="hero-badge"><span class="badge-pulse">🔥 Fresh & Crispy</span></div>
                    <h1 class="hero-title-modern"><span class="title-line">Delicious Potato</span><span class="title-line highlight">Snacks Delivered</span></h1>
                    <p class="hero-description">Experience the crunch of perfectly prepared potato snacks, made from the finest ingredients and delivered to your doorstep</p>
                    <div class="hero-stats-modern">
                        <div class="stat-item"><i class="fas fa-clock"></i><div class="stat-info"><span class="stat-value">30-45</span><span class="stat-label">min delivery</span></div></div>
                        <div class="stat-item"><i class="fas fa-leaf"></i><div class="stat-info"><span class="stat-value">100%</span><span class="stat-label">Vegetarian</span></div></div>
                        <div class="stat-item"><i class="fas fa-star"></i><div class="stat-info"><span class="stat-value">4.8</span><span class="stat-label">Rating</span></div></div>
                    </div>
                    <button class="btn-start-order" id="startOrderBtn"><span>Start Ordering</span><i class="fas fa-arrow-right"></i><div class="btn-glow"></div></button>
                    <div class="trust-badges"><div class="trust-item"><i class="fas fa-shield-alt"></i><span>Secure Payment</span></div><div class="trust-item"><i class="fas fa-truck"></i><span>Free Delivery</span></div><div class="trust-item"><i class="fas fa-undo-alt"></i><span>Easy Returns</span></div></div>
                </div>
                <div class="hero-visual">
                    <div class="floating-card card-1"><img src="./assets/image/french_fries.png" alt="French Fries" style="width:100%;height:100%;object-fit:cover;"></div>
                    <div class="floating-card card-2"><img src="./assets/image/Potato Wedges.png" alt="Potato Wedges" style="width:100%;height:100%;object-fit:cover;"></div>
                    <div class="floating-card card-3"><img src="./assets/image/Aloo_Tikki.png" alt="Aloo Tikki" style="width:100%;height:100%;object-fit:cover;"></div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: Authentication -->
        <section id="section-auth" class="content-section">
            <div class="auth-modern">
                <div class="auth-header"><h2>Welcome Back!</h2><p>Sign in to continue your food journey</p></div>
                <div class="auth-tabs-modern"><button class="auth-tab-btn active" data-tab="login">Login</button><button class="auth-tab-btn" data-tab="signup">Sign Up</button></div>
                <div class="auth-form-container active" id="loginFormContainer">
                    <form id="loginForm">
                        <div class="input-group-modern"><i class="fas fa-envelope"></i><input type="text" id="loginEmail" placeholder="Email or Phone" required><div class="input-focus-effect"></div></div>
                        <div class="input-group-modern"><i class="fas fa-lock"></i><input type="password" id="loginPassword" placeholder="Password" required><button type="button" class="password-toggle"><i class="fas fa-eye"></i></button><div class="input-focus-effect"></div></div>
                        <div class="form-options"><label class="checkbox-modern"><input type="checkbox"><span class="checkmark"></span>Remember me</label><a href="#" class="forgot-link">Forgot Password?</a></div>
                        <button type="submit" class="btn-auth-modern"><span>Login</span><i class="fas fa-arrow-right"></i></button>
                    </form>
                    <div class="auth-divider-modern"><span>or continue with</span></div>
                    <div class="social-login"><button class="social-btn google"><i class="fab fa-google"></i><span>Google</span></button><button class="social-btn facebook"><i class="fab fa-facebook-f"></i><span>Facebook</span></button></div>
                </div>
                <div class="auth-form-container" id="signupFormContainer">
                    <form id="signupForm">
                        <div class="input-group-modern"><i class="fas fa-user"></i><input type="text" id="signupName" placeholder="Full Name" required><div class="input-focus-effect"></div></div>
                        <div class="input-group-modern"><i class="fas fa-envelope"></i><input type="email" id="signupEmail" placeholder="Email Address" required><div class="input-focus-effect"></div></div>
                        <div class="input-group-modern"><i class="fas fa-phone-alt"></i><input type="tel" id="signupPhone" placeholder="Phone Number" required><div class="input-focus-effect"></div></div>
                        <div class="input-group-modern"><i class="fas fa-lock"></i><input type="password" id="signupPassword" placeholder="Password" required minlength="6"><button type="button" class="password-toggle"><i class="fas fa-eye"></i></button><div class="input-focus-effect"></div></div>
                        <div class="input-group-modern"><i class="fas fa-lock"></i><input type="password" id="confirmPassword" placeholder="Confirm Password" required><button type="button" class="password-toggle"><i class="fas fa-eye"></i></button><div class="input-focus-effect"></div></div>
                        <div class="terms-checkbox"><label class="checkbox-modern"><input type="checkbox" required><span class="checkmark"></span>I agree to the <a href="#">Terms & Conditions</a></label></div>
                        <button type="submit" class="btn-auth-modern"><span>Create Account</span><i class="fas fa-user-plus"></i></button>
                    </form>
                </div>
            </div>
        </section>

        <!-- SECTION 3: Products Menu -->
        <section id="section-products" class="content-section">
            <div class="products-modern">
                <div class="products-header-modern">
                    <div class="header-left"><h2>Our Delicious <span>Menu</span></h2><p>Choose from our wide variety of crispy snacks</p></div>
                    <div class="header-right"><div class="search-box-modern"><i class="fas fa-search"></i><input type="text" id="searchProducts" placeholder="Search snacks..."></div><div class="filter-dropdown"><button class="filter-btn" id="filterBtn"><i class="fas fa-filter"></i>Filter</button><div class="filter-menu" id="filterMenu"><div class="filter-option" data-filter="all"><i class="fas fa-th-large"></i>All Items</div><div class="filter-option" data-filter="popular"><i class="fas fa-fire"></i>Popular</div><div class="filter-option" data-filter="veg"><i class="fas fa-leaf"></i>Veggie</div><div class="filter-option" data-filter="new"><i class="fas fa-star"></i>New Arrivals</div></div></div></div>
                </div>
                <div class="category-scroll"><button class="category-chip active" data-category="all"><i class="fas fa-utensils"></i>All</button><button class="category-chip" data-category="french-fries"><i class="fas fa-french-fries"></i>French Fries</button><button class="category-chip" data-category="potato-specialties"><i class="fas fa-potato"></i>Potato Specials</button><button class="category-chip" data-category="veggie-specialties"><i class="fas fa-carrot"></i>Veggie</button><button class="category-chip" data-category="indian-ethnic"><i class="fas fa-flag"></i>Indian</button><button class="category-chip" data-category="baked-snacks"><i class="fas fa-bread-slice"></i>Baked</button></div>
                <div class="products-grid-modern" id="productsGrid"></div>
            </div>
        </section>

        <!-- SECTION 4: Delivery Details -->
        <section id="section-details" class="content-section">
            <div class="details-modern">
                <div class="details-header"><h2>Delivery <span>Details</span></h2><p>Where should we deliver your delicious order?</p></div>
                <form id="deliveryForm" class="delivery-form">
                    <div class="form-grid">
                        <div class="form-field"><label>Full Name *</label><div class="field-input"><i class="fas fa-user"></i><input type="text" id="fullName" placeholder="John Doe" required></div></div>
                        <div class="form-field"><label>Phone Number *</label><div class="field-input"><i class="fas fa-phone-alt"></i><input type="tel" id="phoneNumber" placeholder="9876543210" required></div></div>
                        <div class="form-field full-width"><label>Email Address *</label><div class="field-input"><i class="fas fa-envelope"></i><input type="email" id="email" placeholder="john@example.com" required></div></div>
                        <div class="form-field full-width"><label>Delivery Address *</label><div class="field-input"><i class="fas fa-map-marker-alt"></i><textarea id="address" rows="3" placeholder="House/Flat No., Street, Area" required></textarea></div></div>
                        <div class="form-field"><label>Landmark</label><div class="field-input"><i class="fas fa-flag"></i><input type="text" id="landmark" placeholder="Nearby landmark"></div></div>
                        <div class="form-field"><label>City *</label><div class="field-input"><i class="fas fa-city"></i><input type="text" id="city" placeholder="Mumbai" required></div></div>
                        <div class="form-field"><label>Pin Code *</label><div class="field-input"><i class="fas fa-map-pin"></i><input type="text" id="pincode" placeholder="400001" required></div></div>
                        <div class="form-field"><label>Preferred Time</label><div class="field-input"><i class="fas fa-clock"></i><select id="deliveryTime"><option value="asap">ASAP (30-45 min)</option><option value="1hr">Within 1 hour</option><option value="2hr">Within 2 hours</option><option value="specific">Schedule for later</option></select></div></div>
                    </div>
                    <div class="form-actions-modern"><button type="button" class="btn-secondary" id="backToMenuBtn"><i class="fas fa-arrow-left"></i>Back to Menu</button><button type="submit" class="btn-primary">Proceed to Payment <i class="fas fa-arrow-right"></i></button></div>
                </form>
            </div>
        </section>

        <!-- SECTION 5: Payment -->
        <section id="section-payment" class="content-section">
            <div class="payment-modern">
                <div class="payment-grid">
                    <div class="summary-card"><div class="card-header"><i class="fas fa-receipt"></i><h3>Order Summary</h3></div><div class="summary-items" id="paymentSummaryItems"></div><div class="summary-breakdown"><div class="breakdown-row"><span>Subtotal</span><span id="subtotal">₹0</span></div><div class="breakdown-row"><span>Delivery Fee</span><span>₹40</span></div><div class="breakdown-row"><span>Tax (5%)</span><span id="taxAmount">₹0</span></div><div class="breakdown-row total"><span>Total</span><span id="totalAmount">₹0</span></div></div></div>
                    <div class="payment-card">
                        <div class="card-header"><i class="fas fa-credit-card"></i><h3>Payment Method</h3></div>
                        <div class="payment-methods-grid"><div class="method-card active" data-method="card"><div class="method-icon"><i class="fas fa-credit-card"></i></div><span>Card</span><div class="method-check"></div></div><div class="method-card" data-method="upi"><div class="method-icon"><i class="fas fa-mobile-alt"></i></div><span>UPI</span></div><div class="method-card" data-method="cod"><div class="method-icon"><i class="fas fa-money-bill-wave"></i></div><span>Cash on Delivery</span></div></div>
                        <div class="payment-form-container active" id="cardPaymentForm"><div class="card-icons"><i class="fab fa-cc-visa"></i><i class="fab fa-cc-mastercard"></i><i class="fab fa-cc-amex"></i><i class="fab fa-cc-discover"></i></div><div class="form-field"><label>Card Number</label><div class="field-input"><i class="fas fa-credit-card"></i><input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19"></div></div><div class="form-row"><div class="form-field"><label>Expiry Date</label><div class="field-input"><i class="fas fa-calendar"></i><input type="text" id="expiryDate" placeholder="MM/YY" maxlength="5"></div></div><div class="form-field"><label>CVV</label><div class="field-input"><i class="fas fa-lock"></i><input type="password" id="cvv" placeholder="123" maxlength="3"></div></div></div><div class="form-field"><label>Name on Card</label><div class="field-input"><i class="fas fa-user"></i><input type="text" id="cardName" placeholder="John Doe"></div></div></div>
                        <div class="payment-form-container" id="upiPaymentForm"><div class="upi-apps-grid"><div class="upi-app-card active" data-app="gpay"><i class="fab fa-google-pay"></i><span>Google Pay</span></div><div class="upi-app-card" data-app="phonepe"><i class="fas fa-phone"></i><span>PhonePe</span></div><div class="upi-app-card" data-app="paytm"><i class="fas fa-wallet"></i><span>Paytm</span></div></div><div class="form-field"><label>UPI ID</label><div class="field-input"><i class="fas fa-at"></i><input type="text" id="upiId" placeholder="username@upi"></div></div></div>
                        <div class="payment-form-container" id="codPaymentForm"><div class="cod-message-modern"><i class="fas fa-info-circle"></i><div class="cod-content"><h4>Cash on Delivery</h4><p>Pay when your order arrives. Please keep exact change ready.</p></div></div></div>
                        <div class="payment-actions-modern"><button type="button" class="btn-secondary" id="backToDetailsBtn"><i class="fas fa-arrow-left"></i>Back</button><button class="btn-pay" id="processPaymentBtn"><span>Pay ₹<span id="payAmount">0</span></span><i class="fas fa-lock"></i></button></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 6: Order Tracking -->
        <section id="section-tracking" class="content-section">
            <div class="tracking-modern">
                <div class="tracking-header"><div class="success-animation"><div class="checkmark-circle"><i class="fas fa-check"></i></div></div><h2>Order Confirmed!</h2><p class="order-id-text">Order ID: <span id="orderId">HYFUN-123456</span></p><button class="btn-print-receipt" id="printReceiptBtn"><i class="fas fa-print"></i>Print Receipt</button></div>
                <div class="tracking-progress-modern">
                    <div class="live-tracking-map"><div class="map-background"><div class="map-grid"></div><div class="map-streets"></div><div class="map-buildings"></div></div><div class="map-container"><div class="delivery-bike"><i class="fas fa-motorcycle"></i><div class="bike-trail"></div></div><div class="map-marker start"><i class="fas fa-store"></i></div><div class="map-marker end"><i class="fas fa-home"></i></div><div class="route-line" id="routeLine"></div></div></div>
                    <div class="tracking-timeline"><div class="timeline-step active"><div class="step-dot"><i class="fas fa-check"></i></div><div class="step-content"><h4>Order Confirmed</h4><p>We've received your order</p><span class="step-time" id="timeConfirmed">Just now</span></div></div><div class="timeline-step"><div class="step-dot"><i class="fas fa-utensils"></i></div><div class="step-content"><h4>Preparing Food</h4><p>Our chefs are cooking</p><span class="step-time" id="timePreparing">--:--</span></div></div><div class="timeline-step"><div class="step-dot"><i class="fas fa-motorcycle"></i></div><div class="step-content"><h4>Out for Delivery</h4><p>Your food is on the way</p><span class="step-time" id="timeDelivery">09:40 am</span></div></div><div class="timeline-step"><div class="step-dot"><i class="fas fa-home"></i></div><div class="step-content"><h4>Delivered</h4><p>Enjoy your meal!</p><span class="step-time" id="timeDelivered">09:55 am</span></div></div></div>
                    <div class="delivery-info"><div class="info-item"><i class="fas fa-bicycle"></i><div class="info-text"><span>Delivery Partner</span><strong>Rahul - 2 mins away</strong></div></div><div class="info-item"><i class="fas fa-phone-alt"></i><div class="info-text"><span>Contact</span><strong>+91 98765 43210</strong></div></div></div>
                    <div class="tracking-actions-modern"><button class="btn-secondary" id="trackOrderBtn"><i class="fas fa-sync-alt"></i>Track Order</button><button class="btn-primary" id="rateExperienceBtn">Rate Experience <i class="fas fa-star"></i></button></div>
                </div>
            </div>
        </section>

        <!-- SECTION 7: Review -->
        <section id="section-review" class="content-section">
            <div class="review-modern-enhanced">
                <div class="review-header-enhanced"><h2>Share Your <span>Experience</span></h2><p>Your feedback helps us serve you better</p></div>
                <div class="review-card-enhanced">
                    <div class="rating-section-enhanced"><div class="rating-circle-enhanced" id="ratingCircle"><div class="circle-progress"><svg width="140" height="140"><circle cx="70" cy="70" r="64" fill="none" stroke="#E9ECEF" stroke-width="8"/><circle class="progress-ring-enhanced" cx="70" cy="70" r="64" fill="none" stroke="#78B04B" stroke-width="8" stroke-dasharray="402.123" stroke-dashoffset="402.123" stroke-linecap="round"/></svg><span class="rating-number-enhanced" id="ratingNumber">0</span></div><div class="rating-label">Your Rating</div></div><div class="rating-stars-enhanced" id="ratingStars"><i class="fas fa-star" data-rating="1"></i><i class="fas fa-star" data-rating="2"></i><i class="fas fa-star" data-rating="3"></i><i class="fas fa-star" data-rating="4"></i><i class="fas fa-star" data-rating="5"></i><div class="stars-glow"></div></div><div class="rating-messages" id="ratingMessages"><div class="rating-message" data-rating="1">Poor</div><div class="rating-message" data-rating="2">Fair</div><div class="rating-message" data-rating="3">Good</div><div class="rating-message" data-rating="4">Very Good</div><div class="rating-message" data-rating="5">Excellent</div></div></div>
                    <form id="reviewForm" class="review-form-enhanced"><div class="form-field-enhanced"><label>Review Title</label><div class="field-input-enhanced"><i class="fas fa-heading"></i><input type="text" id="reviewTitle" placeholder="Summarize your experience"></div></div><div class="form-field-enhanced"><label>Your Review</label><div class="field-input-enhanced"><i class="fas fa-pencil-alt"></i><textarea id="reviewText" rows="4" placeholder="Tell us more about your experience..."></textarea></div></div><div class="feedback-tags"><span class="feedback-tag" data-tag="taste">😋 Delicious Taste</span><span class="feedback-tag" data-tag="packaging">📦 Great Packaging</span><span class="feedback-tag" data-tag="delivery">⚡ Fast Delivery</span><span class="feedback-tag" data-tag="quantity">👍 Good Quantity</span><span class="feedback-tag" data-tag="value">💰 Value for Money</span></div><div class="form-actions-enhanced"><button type="button" class="btn-secondary-enhanced" id="backToTrackingBtn"><i class="fas fa-arrow-left"></i>Back</button><button type="submit" class="btn-primary-enhanced">Submit Review <i class="fas fa-paper-plane"></i><span class="btn-shine"></span></button></div></form>
                    <div class="review-success-enhanced" id="reviewSuccess"><div class="success-animation-enhanced"><div class="checkmark-circle-enhanced"><i class="fas fa-check"></i></div></div><h3>Thank You!</h3><p>Your feedback means the world to us</p><div class="thankyou-message"><i class="fas fa-heart"></i><span>You're awesome!</span><i class="fas fa-heart"></i></div><button class="btn-home-enhanced" id="homeBtn"><i class="fas fa-home"></i>Back to Home</button></div>
                </div>
            </div>
        </section>
    </main>

    <!-- Cart Sidebar -->
    <div class="cart-sidebar-modern" id="cartSidebar">
        <div class="cart-sidebar-header">
            <h3>Your Cart (<span id="cartItemCount">0</span> items)</h3>
            <button class="close-cart" id="closeCartBtn"><i class="fas fa-times"></i></button>
        </div>
        <div class="cart-items-list" id="cartItemsList">
            <div class="empty-cart" id="emptyCart">
                <i class="fas fa-shopping-bag"></i>
                <p>Your cart is empty</p>
                <button class="btn-secondary" id="browseMenuBtn">Browse Menu</button>
            </div>
        </div>
        <div class="cart-sidebar-footer">
            <div class="cart-total-modern">
                <span>Total</span>
                <span class="total-amount" id="sidebarTotal">₹0</span>
            </div>
            <button class="btn-checkout-modern" id="checkoutBtn" disabled>Checkout <i class="fas fa-arrow-right"></i></button>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div class="loading-overlay-modern" id="loadingOverlay">
        <div class="loading-spinner-modern">
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <i class="fas fa-utensils"></i>
        </div>
        <p>Processing your order...</p>
    </div>

    <div id="notificationContainer"></div>

    <script>
    // ============================================
    // COMPLETE ORDER SYSTEM - ALL IN ONE
    // ============================================
    
    (function() {
        // Global variables
        let cart = JSON.parse(localStorage.getItem('hyfun_cart')) || [];
        let products = [];
        let currentOrder = null;
        let userRating = 0;
        
        // Load products from PHP
        const productsData = document.getElementById('productsData').value;
        if (productsData) {
            try {
                products = JSON.parse(productsData);
                console.log('Products loaded:', products.length);
            } catch(e) {
                console.error('Error parsing products:', e);
            }
        }
        
        // ========== HELPER FUNCTIONS ==========
        function showNotification(message, type = 'info') {
            const container = document.getElementById('notificationContainer');
            if (!container) return;
            
            const notification = document.createElement('div');
            notification.className = `notification-modern ${type}`;
            notification.innerHTML = `
                <div class="notification-icon"><i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i></div>
                <div class="notification-content"><div class="notification-title">${type.toUpperCase()}</div><div class="notification-message">${message}</div></div>
                <button class="notification-close"><i class="fas fa-times"></i></button>
            `;
            container.appendChild(notification);
            
            notification.querySelector('.notification-close').addEventListener('click', () => notification.remove());
            setTimeout(() => notification.remove(), 5000);
        }
        
        function showLoading() {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) overlay.classList.add('active');
        }
        
        function hideLoading() {
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) overlay.classList.remove('active');
        }
        
        function toggleCart() {
            const sidebar = document.getElementById('cartSidebar');
            if (sidebar) sidebar.classList.toggle('active');
        }
        
        function loadSection(sectionName) {
            const sections = ['hero', 'auth', 'products', 'details', 'payment', 'tracking', 'review'];
            sections.forEach(s => {
                const section = document.getElementById(`section-${s}`);
                if (section) section.classList.remove('active');
            });
            const targetSection = document.getElementById(`section-${sectionName}`);
            if (targetSection) targetSection.classList.add('active');
            
            if (sectionName === 'payment') updatePaymentSummary();
            if (sectionName === 'products') renderProducts(products);
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        // ========== CART FUNCTIONS ==========
        function updateCartCount() {
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            const cartCount = document.getElementById('cartCount');
            const cartItemCount = document.getElementById('cartItemCount');
            if (cartCount) cartCount.textContent = totalItems;
            if (cartItemCount) cartItemCount.textContent = totalItems;
            
            const checkoutBtn = document.getElementById('checkoutBtn');
            if (checkoutBtn) checkoutBtn.disabled = cart.length === 0;
            
            localStorage.setItem('hyfun_cart', JSON.stringify(cart));
        }
        
        function addToCart(productId, quantity) {
            const product = products.find(p => p.id == productId);
            if (!product) {
                console.error('Product not found:', productId);
                return;
            }
            
            const existingItem = cart.find(item => item.id == productId);
            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    image: product.image,
                    quantity: quantity,
                    weight: product.weight || '500g'
                });
            }
            
            updateCartCount();
            renderCartItems();
            showNotification(`${quantity}x ${product.name} added to cart!`, 'success');
        }
        
        function renderCartItems() {
            const cartList = document.getElementById('cartItemsList');
            const emptyCart = document.getElementById('emptyCart');
            const sidebarTotal = document.getElementById('sidebarTotal');
            
            if (!cartList) return;
            
            if (cart.length === 0) {
                if (emptyCart) emptyCart.style.display = 'block';
                cartList.innerHTML = '';
                if (sidebarTotal) sidebarTotal.textContent = '₹0';
                return;
            }
            
            if (emptyCart) emptyCart.style.display = 'none';
            
            let itemsHTML = '';
            let total = 0;
            
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                
                itemsHTML += `
                    <div class="cart-item-modern" data-index="${index}">
                        <div class="cart-item-image"><img src="./assets/image/${item.image}" alt="${item.name}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;"></div>
                        <div class="cart-item-info">
                            <h4 class="cart-item-title">${item.name}</h4>
                            <div class="cart-item-price">₹${item.price} × ${item.quantity}</div>
                            <div class="cart-item-controls">
                                <button class="cart-qty-btn minus" data-index="${index}">-</button>
                                <span class="cart-qty-value">${item.quantity}</span>
                                <button class="cart-qty-btn plus" data-index="${index}">+</button>
                                <button class="cart-item-remove" data-index="${index}"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="item-total" style="font-weight:bold;">₹${itemTotal}</div>
                    </div>
                    <hr style="margin:10px 0;">
                `;
            });
            
            cartList.innerHTML = itemsHTML;
            if (sidebarTotal) sidebarTotal.textContent = `₹${total}`;
            
            // Add event listeners to cart buttons
            document.querySelectorAll('.cart-qty-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const index = parseInt(this.getAttribute('data-index'));
                    const isMinus = this.classList.contains('minus');
                    if (isMinus && cart[index].quantity > 1) {
                        cart[index].quantity--;
                    } else if (!isMinus) {
                        cart[index].quantity++;
                    }
                    renderCartItems();
                    updateCartCount();
                    updatePaymentSummary();
                });
            });
            
            document.querySelectorAll('.cart-item-remove').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const index = parseInt(this.getAttribute('data-index'));
                    cart.splice(index, 1);
                    renderCartItems();
                    updateCartCount();
                    updatePaymentSummary();
                });
            });
        }
        
        // ========== PRODUCTS RENDERING ==========
        function renderProducts(productsToRender) {
            const grid = document.getElementById('productsGrid');
            if (!grid) return;
            
            grid.innerHTML = '';
            
            productsToRender.forEach(product => {
                const card = document.createElement('div');
                card.className = 'product-card-modern';
                card.setAttribute('data-id', product.id);
                card.innerHTML = `
                    <div class="product-image-wrapper" style="position:relative;height:200px;overflow:hidden;">
                        <img src="./assets/image/${product.image}" alt="${product.name}" style="width:100%;height:100%;object-fit:cover;">
                        ${product.tag === 'Best Seller' ? '<div class="product-badge-modern" style="position:absolute;top:10px;left:10px;background:#78B04B;color:white;padding:4px12px;border-radius:20px;font-size:12px;">Best Seller</div>' : ''}
                    </div>
                    <div class="product-info-modern" style="padding:15px;">
                        <h3 class="product-name" style="font-size:1.1rem;margin-bottom:5px;">${product.name}</h3>
                        <p class="product-desc-modern" style="color:#666;font-size:0.85rem;margin-bottom:10px;">${product.description || 'Delicious potato snack'}</p>
                        <div class="product-meta-modern" style="display:flex;justify-content:space-between;margin-bottom:15px;">
                            <span class="product-price-modern" style="color:#78B04B;font-size:1.3rem;font-weight:bold;">₹${product.price}</span>
                            <span class="product-weight" style="color:#999;">${product.weight || '500g'}</span>
                        </div>
                        <div class="product-actions-modern" style="display:flex;gap:10px;">
                            <div class="quantity-control-modern" style="display:flex;align-items:center;gap:8px;background:#f5f5f5;border-radius:25px;padding:5px;">
                                <button class="qty-btn minus" data-id="${product.id}" style="width:30px;height:30px;border:none;border-radius:50%;cursor:pointer;">-</button>
                                <span class="qty-value" id="qty-${product.id}" style="min-width:30px;text-align:center;">1</span>
                                <button class="qty-btn plus" data-id="${product.id}" style="width:30px;height:30px;border:none;border-radius:50%;cursor:pointer;">+</button>
                            </div>
                            <button class="add-to-cart-btn" data-id="${product.id}" style="flex:1;background:#78B04B;color:white;border:none;border-radius:25px;padding:8px;cursor:pointer;"><i class="fas fa-cart-plus"></i> Add</button>
                        </div>
                    </div>
                `;
                grid.appendChild(card);
            });
            
            // Add event listeners
            document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const productId = parseInt(this.getAttribute('data-id'));
                    const qtySpan = document.getElementById(`qty-${productId}`);
                    const quantity = parseInt(qtySpan ? qtySpan.textContent : 1);
                    addToCart(productId, quantity);
                });
            });
            
            document.querySelectorAll('.qty-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const productId = parseInt(this.getAttribute('data-id'));
                    const qtySpan = document.getElementById(`qty-${productId}`);
                    let currentQty = parseInt(qtySpan.textContent);
                    if (this.classList.contains('minus') && currentQty > 1) {
                        currentQty--;
                    } else if (this.classList.contains('plus')) {
                        currentQty++;
                    }
                    qtySpan.textContent = currentQty;
                });
            });
        }
        
        // ========== PAYMENT SUMMARY ==========
        function updatePaymentSummary() {
            const summaryItems = document.getElementById('paymentSummaryItems');
            const subtotalEl = document.getElementById('subtotal');
            const taxEl = document.getElementById('taxAmount');
            const totalEl = document.getElementById('totalAmount');
            const payAmountEl = document.getElementById('payAmount');
            
            if (!summaryItems) return;
            
            if (cart.length === 0) {
                summaryItems.innerHTML = '<p class="text-center" style="text-align:center;padding:20px;">Your cart is empty</p>';
                if (subtotalEl) subtotalEl.textContent = '₹0';
                if (taxEl) taxEl.textContent = '₹0';
                if (totalEl) totalEl.textContent = '₹0';
                if (payAmountEl) payAmountEl.textContent = '0';
                return;
            }
            
            let itemsHTML = '';
            let subtotal = 0;
            
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;
                itemsHTML += `
                    <div class="summary-item-modern" style="display:flex;gap:15px;margin-bottom:15px;padding-bottom:10px;border-bottom:1px solid #eee;">
                        <div class="item-image" style="width:50px;height:50px;"><img src="./assets/image/${item.image}" alt="${item.name}" style="width:100%;height:100%;object-fit:cover;border-radius:8px;"></div>
                        <div class="item-details" style="flex:1;"><h4 style="font-size:0.9rem;">${item.name}</h4><p style="font-size:0.8rem;color:#666;">${item.weight} × ${item.quantity}</p></div>
                        <div class="item-total" style="font-weight:bold;">₹${itemTotal}</div>
                    </div>
                `;
            });
            
            const deliveryFee = 40;
            const tax = subtotal * 0.05;
            const total = subtotal + deliveryFee + tax;
            
            summaryItems.innerHTML = itemsHTML;
            if (subtotalEl) subtotalEl.textContent = `₹${subtotal}`;
            if (taxEl) taxEl.textContent = `₹${tax.toFixed(2)}`;
            if (totalEl) totalEl.textContent = `₹${total.toFixed(2)}`;
            if (payAmountEl) payAmountEl.textContent = total.toFixed(2);
        }
        
        // ========== PROCESS PAYMENT ==========
        async function processPayment() {
            if (cart.length === 0) {
                showNotification('Your cart is empty', 'error');
                return;
            }
            
            const activeMethod = document.querySelector('.method-card.active');
            if (!activeMethod) {
                showNotification('Please select a payment method', 'error');
                return;
            }
            
            const method = activeMethod.getAttribute('data-method');
            
            const orderData = {
                fullName: document.getElementById('fullName')?.value || '',
                phoneNumber: document.getElementById('phoneNumber')?.value || '',
                email: document.getElementById('email')?.value || '',
                address: document.getElementById('address')?.value || '',
                landmark: document.getElementById('landmark')?.value || '',
                city: document.getElementById('city')?.value || '',
                pincode: document.getElementById('pincode')?.value || '',
                deliveryTime: document.getElementById('deliveryTime')?.value || 'asap',
                paymentMethod: method
            };
            
            if (!orderData.fullName || !orderData.phoneNumber || !orderData.email || !orderData.address || !orderData.city || !orderData.pincode) {
                showNotification('Please fill all delivery details', 'error');
                loadSection('details');
                return;
            }
            
            showLoading();
            
            try {
                const response = await fetch('./api/order_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ 
                        action: 'save_order', 
                        orderData: orderData, 
                        cartItems: cart.map(item => ({
                            id: item.id,
                            name: item.name,
                            price: item.price,
                            image: item.image,
                            quantity: item.quantity,
                            weight: item.weight
                        }))
                    })
                });
                
                const result = await response.json();
                console.log('API Response:', result);
                
                if (result.success) {
                    currentOrder = {
                        id: result.orderNumber,
                        orderId: result.orderId,
                        items: [...cart],
                        customer: orderData
                    };
                    
                    const orderIdSpan = document.getElementById('orderId');
                    if (orderIdSpan) orderIdSpan.textContent = result.orderNumber;
                    
                    // Clear cart
                    cart = [];
                    localStorage.setItem('hyfun_cart', JSON.stringify(cart));
                    updateCartCount();
                    renderCartItems();
                    
                    hideLoading();
                    showNotification('Order placed successfully! Order ID: ' + result.orderNumber, 'success');
                    loadSection('tracking');
                } else {
                    hideLoading();
                    showNotification('Error: ' + (result.error || 'Failed to place order'), 'error');
                }
            } catch (error) {
                hideLoading();
                showNotification('Network error: ' + error.message, 'error');
                console.error('Network error:', error);
            }
        }
        
        // ========== REVIEW FUNCTIONS ==========
        function updateRatingStars(rating) {
            const stars = document.querySelectorAll('.rating-stars-enhanced i');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                    star.style.color = '#FFB800';
                } else {
                    star.classList.remove('active');
                    star.style.color = '#E0E0E0';
                }
            });
            document.getElementById('ratingNumber').textContent = rating;
            
            document.querySelectorAll('.rating-message').forEach(msg => {
                msg.classList.remove('active');
                if (parseInt(msg.getAttribute('data-rating')) === rating) {
                    msg.classList.add('active');
                }
            });
            
            const circle = document.querySelector('.progress-ring-enhanced');
            if (circle) {
                const radius = 64;
                const circumference = 2 * Math.PI * radius;
                const offset = circumference - (rating / 5) * circumference;
                circle.style.strokeDashoffset = offset;
            }
        }
        
        async function submitReview() {
            const title = document.getElementById('reviewTitle')?.value || '';
            const text = document.getElementById('reviewText')?.value || '';
            
            if (userRating === 0) {
                showNotification('Please select a rating', 'error');
                return;
            }
            
            if (!text.trim()) {
                showNotification('Please write a review', 'error');
                return;
            }
            
            const reviewData = {
                orderId: currentOrder ? currentOrder.id : 'N/A',
                userName: document.getElementById('fullName')?.value || 'Anonymous',
                rating: userRating,
                title: title,
                reviewText: text,
                tags: []
            };
            
            try {
                const response = await fetch('./api/enquiry_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'save_review', reviewData: reviewData })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    document.getElementById('reviewForm').style.display = 'none';
                    document.getElementById('reviewSuccess').style.display = 'block';
                    showNotification('Thank you for your review!', 'success');
                } else {
                    showNotification('Error saving review', 'error');
                }
            } catch (error) {
                showNotification('Network error', 'error');
            }
        }
        
        // ========== INITIALIZATION ==========
        function init() {
            console.log('Initializing order system...');
            
            // Render products
            if (products.length > 0) {
                renderProducts(products);
            }
            renderCartItems();
            updateCartCount();
            
            // Event Listeners
            document.getElementById('startOrderBtn')?.addEventListener('click', () => loadSection('auth'));
            document.getElementById('cartToggleBtn')?.addEventListener('click', toggleCart);
            document.getElementById('closeCartBtn')?.addEventListener('click', toggleCart);
            document.getElementById('browseMenuBtn')?.addEventListener('click', () => { toggleCart(); loadSection('products'); });
            document.getElementById('backToMenuBtn')?.addEventListener('click', () => loadSection('products'));
            document.getElementById('backToDetailsBtn')?.addEventListener('click', () => loadSection('details'));
            document.getElementById('backToTrackingBtn')?.addEventListener('click', () => loadSection('tracking'));
            document.getElementById('checkoutBtn')?.addEventListener('click', () => { toggleCart(); loadSection('details'); });
            document.getElementById('processPaymentBtn')?.addEventListener('click', processPayment);
            document.getElementById('rateExperienceBtn')?.addEventListener('click', () => loadSection('review'));
            document.getElementById('homeBtn')?.addEventListener('click', () => window.location.href = 'index.php');
            
            // Delivery form
            document.getElementById('deliveryForm')?.addEventListener('submit', (e) => {
                e.preventDefault();
                loadSection('payment');
            });
            
            // Review form
            document.getElementById('reviewForm')?.addEventListener('submit', (e) => {
                e.preventDefault();
                submitReview();
            });
            
            // Rating stars
            document.querySelectorAll('.rating-stars-enhanced i').forEach(star => {
                star.addEventListener('click', function() {
                    userRating = parseInt(this.getAttribute('data-rating'));
                    updateRatingStars(userRating);
                });
            });
            
            // Payment method selection
            document.querySelectorAll('.method-card').forEach(method => {
                method.addEventListener('click', function() {
                    const methodType = this.getAttribute('data-method');
                    document.querySelectorAll('.method-card').forEach(m => m.classList.remove('active'));
                    this.classList.add('active');
                    document.querySelectorAll('.payment-form-container').forEach(f => f.classList.remove('active'));
                    const targetForm = document.getElementById(methodType + 'PaymentForm');
                    if (targetForm) targetForm.classList.add('active');
                });
            });
            
            // Auth tabs
            document.querySelectorAll('.auth-tab-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const tab = this.getAttribute('data-tab');
                    document.querySelectorAll('.auth-tab-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    document.querySelectorAll('.auth-form-container').forEach(f => f.classList.remove('active'));
                    document.getElementById(tab + 'FormContainer').classList.add('active');
                });
            });
            
            // Login form
            document.getElementById('loginForm')?.addEventListener('submit', (e) => {
                e.preventDefault();
                showNotification('Login successful!', 'success');
                loadSection('products');
            });
            
            // Signup form
            document.getElementById('signupForm')?.addEventListener('submit', (e) => {
                e.preventDefault();
                showNotification('Account created! Please login.', 'success');
                document.querySelector('.auth-tab-btn[data-tab="login"]').click();
            });
            
            // Password toggle
            document.querySelectorAll('.password-toggle').forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    this.querySelector('i').classList.toggle('fa-eye');
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            });
            
            console.log('Order system initialized. Cart items:', cart.length);
        }
        
        // Start when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
    </script>
</body>
</html>