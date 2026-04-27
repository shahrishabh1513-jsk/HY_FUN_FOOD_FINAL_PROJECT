<?php
$pageTitle = "Home";
$additionalCss = "";
$additionalJs = "";

ob_start();
?>

<!-- Hero Section -->
<section class="hero section-bg" id="home" style="padding: 120px 0 80px; margin-top: 0;">
    <div class="bg-pattern"></div>
    <div class="container hero-content">
        <div class="hero-text">
            <h1>Potatoes for the World</h1>
            <p>At HyFun, we believe in spreading health & happiness to as many countries as we can. Packed with an authentic taste and goodness of potatoes, HyFun offers an extensive range of frozen snacks that is loved & relished by all.</p>
            <a href="products.php" class="btn">Explore Our Range</a>
            <a href="about.php" class="btn btn-outline">Know More</a>
        </div>
        <div class="hero-image">
            <div class="hero-image-container">
                <img src="./assets/image/hyfun_food1.png" alt="Delicious potato snacks" class="hero-img">
                <div class="hero-badge badge-1">Ready in<br>3 Min!</div>
                <div class="hero-badge badge-2">100%<br>Natural</div>
            </div>
        </div>
    </div>
</section>

<!-- Incredibly Tasty Section -->
<section class="incredibly-tasty section-bg">
    <div class="bg-pattern bg-pattern-2"></div>
    <div class="container">
        <div class="section-title">
            <h2>Incredibly Tasty, Amazingly Quick</h2>
            <p>Delicious, simple and oh-so-satisfying, that's what the HyFun experience is all about. Enjoy our wide range of savoury snacks packed with rich taste, exciting flavours and the goodness of potatoes!</p>
            <div class="title-accent"></div>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <img src="./assets/image/french_fries.png" alt="Quick preparation" class="feature-img">
                <h3>Ready in 3 Min!</h3>
                <p>Our frozen snacks are designed to be ready in just 3 minutes, making meal prep quick and easy for busy families and individuals.</p>
            </div>
            <div class="feature-card">
                <img src="./assets/image/Aloo_Tikki.png" alt="Vegetarian food" class="feature-img">
                <h3>100% Vegetarian</h3>
                <p>All our products are made from 100% vegetarian ingredients, ensuring quality, taste, and ethical consumption for everyone.</p>
            </div>
            <div class="feature-card">
                <img src="./assets/image/veg_burger_patties.png" alt="Natural ingredients" class="feature-img">
                <h3>No Preservatives</h3>
                <p>We use natural ingredients with no added preservatives, keeping our snacks healthy, tasty, and wholesome for all ages.</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Potatoes Section -->
<section class="why-potatoes section-bg" id="about">
    <div class="bg-pattern"></div>
    <div class="container">
        <div class="section-title">
            <h2>Why Potatoes?</h2>
            <p>The humble potato is easily the most genius crop ever discovered. Boil them, bake them or fry them, they never disappoint.</p>
            <div class="title-accent"></div>
        </div>
        <div class="potato-center-layout">
            <div class="potato-fact top">
                <div class="fact-content">
                    <div class="fact-icon"><i class="fas fa-apple-alt"></i></div>
                    <h4>Nutrient-Rich</h4>
                    <p>Potatoes are a powerhouse of nutrients including vitamins C and B6, potassium, and fiber for a balanced diet.</p>
                </div>
            </div>
            <div class="potato-fact left">
                <div class="fact-content">
                    <div class="fact-icon"><i class="fas fa-battery-full"></i></div>
                    <h4>Energy Boosting</h4>
                    <p>With complex carbohydrates, potatoes provide sustained energy throughout the day without spikes.</p>
                </div>
            </div>
            <div class="potato-fact right">
                <div class="fact-content">
                    <div class="fact-icon"><i class="fas fa-utensil-spoon"></i></div>
                    <h4>Versatile Ingredient</h4>
                    <p>Potatoes can be prepared in countless ways, making them a kitchen staple worldwide for all cuisines.</p>
                </div>
            </div>
            <div class="potato-fact bottom">
                <div class="fact-content">
                    <div class="fact-icon"><i class="fas fa-heartbeat"></i></div>
                    <h4>Naturally Delicious</h4>
                    <p>With just 110 calories, a medium sized potato provides 30% of your daily value of vitamin C naturally.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Esteemed Clientele -->
<section class="clients section-bg">
    <div class="bg-pattern bg-pattern-2"></div>
    <div class="container">
        <div class="section-title">
            <h2>Our Esteemed Clientele</h2>
            <p>Trusted by the biggest global brands in over 40 countries</p>
            <div class="title-accent"></div>
        </div>
        <div class="logos-scroll-container">
            <div class="logos-track" id="clienteleTrack">
                <div class="logo-scroll-item"><img src="./assets/image/BK.jpg" alt="McDonalds" class="client-logo"></div>
                <div class="logo-scroll-item"><img src="./assets/image/CARLS.png" alt="Burger King" class="client-logo"></div>
                <div class="logo-scroll-item"><img src="./assets/image/kfc.png" alt="KFC" class="client-logo"></div>
                <div class="logo-scroll-item"><img src="./assets/image/WHATABURGER.png" alt="Subway" class="client-logo"></div>
                <div class="logo-scroll-item"><img src="./assets/image/pizza-hut.png" alt="Pizza Hut" class="client-logo"></div>
                <div class="logo-scroll-item"><img src="./assets/image/subway.png" alt="Domino's" class="client-logo"></div>
                <div class="logo-scroll-item"><img src="./assets/image/pvr.png" alt="Dunkin" class="client-logo"></div>
                <div class="logo-scroll-item"><img src="./assets/image/TACOBELL.png" alt="Popeyes" class="client-logo"></div>
                <div class="logo-scroll-item"><img src="./assets/image/thepizza.jpg" alt="Hardees" class="client-logo"></div>
                <div class="logo-scroll-item"><img src="./assets/image/sizzler.png" alt="Wendy's" class="client-logo"></div>
                <div class="logo-scroll-item"><img src="./assets/image/twc.png" alt="Taco Bell" class="client-logo"></div>
            </div>
        </div>
    </div>
</section>

 <!-- Retail Partners -->
    <section class="partners section-bg">
        <div class="bg-pattern bg-pattern-3"></div>
        <div class="container">
            <div class="section-title">
                <h2>Our Retail Partners</h2>
                <p>Available at leading retail chains worldwide</p>
                <div class="title-accent"></div>
            </div>

            <div class="logos-scroll-container">
                <div class="logos-track" id="partnersTrack">
                    <!-- Walmart -->
                <div class="logo-scroll-item">
                    <img src="./assets/image/Dmart.png" 
                         alt="Walmart" 
                         class="client-logo" 
                         loading="lazy">
                </div>
                
                <!-- Amazon -->
                <div class="logo-scroll-item">
                    <img src="./assets/image/swiggy.png" 
                         alt="Amazon" 
                         class="client-logo" 
                         loading="lazy">
                </div>
                
                <!-- Costco -->
                <div class="logo-scroll-item">
                    <img src="./assets/image/blinkit.png" 
                         alt="Costco" 
                         class="client-logo" 
                         loading="lazy">
                </div>
                
                <!-- Target -->
                <div class="logo-scroll-item">
                    <img src="./assets/image/bigbasket.png" 
                         alt="Target" 
                         class="client-logo" 
                         loading="lazy">
                </div>
                
                <!-- Tesco -->
                <div class="logo-scroll-item">
                    <img src="./assets/image/jiomart.jpg" 
                         alt="Tesco" 
                         class="client-logo" 
                         loading="lazy">
                </div>
                
                <!-- Carrefour -->
                <div class="logo-scroll-item">
                    <img src="./assets/image/Reliance.png" 
                         alt="Carrefour" 
                         class="client-logo" 
                         loading="lazy">
                </div>
                
                <!-- Dmart -->
                <div class="logo-scroll-item">
                    <img src="./assets/image/AmazonFresh.jpg" 
                         alt="Dmart" 
                         class="client-logo" 
                         loading="lazy">
                </div>

                 <!-- Walmart -->
                <div class="logo-scroll-item">
                    <img src="./assets/image/Dmart.png" 
                         alt="Walmart" 
                         class="client-logo" 
                         loading="lazy">
                </div>
                
                <!-- Amazon -->
                <div class="logo-scroll-item">
                    <img src="./assets/image/swiggy.png" 
                         alt="Amazon" 
                         class="client-logo" 
                         loading="lazy">
                </div>
                
                <!-- Costco -->
                <div class="logo-scroll-item">
                    <img src="./assets/image/blinkit.png" 
                         alt="Costco" 
                         class="client-logo" 
                         loading="lazy">
                </div>
                
                <!-- Target -->
                <div class="logo-scroll-item">
                    <img src="./assets/image/bigbasket.png" 
                         alt="Target" 
                         class="client-logo" 
                         loading="lazy">
                </div>

                </div>
            </div>
        </div>
    </section>


<?php
$content = ob_get_clean();
include 'includes/header.php';
echo $content;
include 'includes/footer.php';
?>