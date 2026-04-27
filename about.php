<?php
$pageTitle = "About Us | HyFun Foods - Potatoes for the World";
$additionalCss = "";
$additionalJs = "about.js";

ob_start();
?>


<!-- Example - Your about page content starts here -->
<section class="hero section-bg" id="about-hero" style="padding: 120px 0 80px; margin-top: 0;">
    <div class="bg-pattern"></div>
    <div class="container hero-content">
        <div class="hero-text">
            <h1>A LEGACY OF PREMIUM QUALITY AND GREAT TASTE</h1>
            <p>Serving Excellence Since 1962. From a humble beginning to a global leader in potato snacks, our journey is built on quality, innovation, and customer trust.</p>
            <div class="hero-stats">
                <div class="hero-stat"><h3>60+</h3><p>Years Legacy</p></div>
                <div class="hero-stat"><h3>45+</h3><p>Countries</p></div>
                <div class="hero-stat"><h3>Global</h3><p>Standards</p></div>
            </div>
            <div class="hero-buttons"><a href="#journey" class="btn">Our Journey</a><a href="#mission" class="btn btn-outline">Our Values</a></div>
        </div>
        <div class="hero-image">
            <div class="timeline-hero-container">
                <div class="hero-timeline-line"></div>
                <img src="./assets/image/hyfun.jpeg" alt="HyFun Legacy" class="timeline-hero-img">
            </div>
        </div>
    </div>
</section>

<section class="mission-vision section-bg" id="mission">
    <div class="bg-pattern bg-pattern-3"></div>
    <div class="container">
        <div class="section-title"><h2>Our Core Principles</h2><p>Guided by strong values that shape everything we do</p><div class="title-accent"></div></div>
        <div class="principles-grid">
            <div class="principle-card mission-card"><div class="card-icon"><i class="fas fa-bullseye"></i></div><h3>Our Mission</h3><p>To exceed customer expectations by bringing premium quality, pocket-friendly products through innovative practices and improved safety measures in manufacturing and supply.</p><div class="card-tag">Purpose</div></div>
            <div class="principle-card vision-card"><div class="card-icon"><i class="fas fa-eye"></i></div><h3>Our Vision</h3><p>To achieve extensive worldwide presence while maintaining global quality standards through innovative techniques and building a brand acknowledged by client's faith for years to come.</p><div class="card-tag">Aspiration</div></div>
            <div class="principle-card values-card"><div class="card-icon"><i class="fas fa-star"></i></div><h3>Our Values</h3><p>Quality Excellence, Customer Focus, Innovation, Sustainability, Farmer Welfare, and Ethical Business Practices guide every decision we make.</p><div class="card-tag">Foundation</div></div>
        </div>
    </div>
</section>

<section class="legacy-story section-bg">
    <div class="bg-pattern"></div>
    <div class="container">
        <div class="legacy-content-wrapper">
            <div class="legacy-image"><img src="./assets/image/allproducts.png" alt="HyFun Legacy" class="legacy-img"><div class="image-badge"><i class="fas fa-award"></i><span>Make in India Initiative</span></div></div>
            <div class="legacy-text"><h2>The HyFun Legacy</h2><div class="accent-line"></div><p>HyFun is a proud contributor to the <strong>'Make in India'</strong> initiative. Today we export our products to more than 45 countries across the globe. We can proudly claim that we are an <strong>'Indian Company with Global Standards'</strong>.</p><p>Our persistent passion for delivering international quality food has brought us even closer to our consumers. Having successfully launched our products in the retail market, we are now expanding our presence on B2C platforms.</p><div class="legacy-highlights"><div class="highlight"><i class="fas fa-globe-asia"></i><div><h4>Global Presence</h4><p>45+ countries served</p></div></div><div class="highlight"><i class="fas fa-users"></i><div><h4>Farmers First</h4><p>Contract farming model</p></div></div><div class="highlight"><i class="fas fa-leaf"></i><div><h4>Sustainable</h4><p>Green practices implemented</p></div></div></div></div>
        </div>
    </div>
</section>

<section class="green-practices section-bg" id="green">
    <div class="bg-pattern bg-pattern-2"></div>
    <div class="container">
        <div class="section-title"><h2>Our Green Commitment</h2><p>Implementing environment-positive practices across all operations</p><div class="title-accent"></div></div>
        <div class="green-practices-grid">
            <div class="green-practice-card"><div class="green-icon"><i class="fas fa-tint-slash"></i></div><h4>Zero Liquid Discharge</h4><p>Advanced water treatment systems ensuring no environmental discharge</p></div>
            <div class="green-practice-card"><div class="green-icon"><i class="fas fa-cloud-rain"></i></div><h4>Rainwater Harvesting</h4><p>Comprehensive systems for sustainable water management</p></div>
            <div class="green-practice-card"><div class="green-icon"><i class="fas fa-tree"></i></div><h4>Green Surroundings</h4><p>Lush landscapes and biodiversity promotion</p></div>
            <div class="green-practice-card"><div class="green-icon"><i class="fas fa-recycle"></i></div><h4>Waste Management</h4><p>Efficient recycling and waste reduction systems</p></div>
            <div class="green-practice-card"><div class="green-icon"><i class="fas fa-solar-panel"></i></div><h4>Energy Efficient</h4><p>Optimized energy consumption and renewable energy use</p></div>
            <div class="green-practice-card"><div class="green-icon"><i class="fas fa-seedling"></i></div><h4>Sustainable Farming</h4><p>Eco-friendly agricultural practices with farmers</p></div>
        </div>
        <div class="green-commitment"><h3>Our Sustainability Promise</h3><p>At HyFun, we commit to environment positive practices in all our operations and in everyday actions. We have a clear roadmap that ties business intelligence with green initiatives for a better tomorrow.</p></div>
    </div>
</section>

<section class="connect-section section-bg">
    <div class="bg-pattern bg-pattern-3"></div>
    <div class="container">
        <div class="connect-content"><h2>Join Our Journey</h2><p>Be part of our story as we continue to bring premium potato snacks to the world</p><div class="connect-options"><a href="#careers" class="connect-option"><i class="fas fa-briefcase"></i><h4>Careers</h4><p>Join our growing team</p></a><a href="#partnerships" class="connect-option"><i class="fas fa-handshake"></i><h4>Partnerships</h4><p>Collaborate with us</p></a><a href="#contact" class="connect-option"><i class="fas fa-envelope"></i><h4>Contact</h4><p>Get in touch</p></a><a href="#follow" class="connect-option"><i class="fas fa-share-alt"></i><h4>Follow Us</h4><p>Stay updated</p></a></div></div>
    </div>
</section>

<?php
$content = ob_get_clean();
include 'includes/header.php';
echo $content;
include 'includes/footer.php';
?>