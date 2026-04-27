<?php
$pageTitle = "Connect With Us";
$additionalCss = "connect.css";
$additionalJs = "connect.js";

ob_start();
?>

<section class="connect-hero section-bg" style="padding: 120px 0 80px; margin-top: 0;">
    <div class="bg-pattern bg-pattern-connect"></div>
    <div class="container">
        <div class="connect-hero-content">
            <h1 class="connect-hero-title">Let's Connect & Create Together</h1>
            <p class="connect-hero-subtitle">Building relationships that grow from seed to success. Join us in shaping the future of food.</p>
            <div class="hero-connections">
                <div class="connection-stat"><i class="fas fa-handshake"></i><div><h3>500+</h3><p>Global Partners</p></div></div>
                <div class="connection-stat"><i class="fas fa-users"></i><div><h3>10,000+</h3><p>Happy Customers</p></div></div>
                <div class="connection-stat"><i class="fas fa-globe"></i><div><h3>45+</h3><p>Countries</p></div></div>
            </div>
        </div>
    </div>
</section>

<section class="contact-channels section-bg">
    <div class="container">
        <div class="section-title"><h2>Multiple Ways to Reach Us</h2><p>Choose your preferred channel to connect with our dedicated teams</p><div class="title-accent"></div></div>
        <div class="channels-grid">
            <div class="channel-card"><div class="channel-icon"><i class="fas fa-headset"></i></div><h3>Customer Support</h3><p>For product inquiries, orders, and general assistance</p><div class="channel-contacts"><div class="contact-item"><i class="fas fa-phone"></i><span>+91 75750 02999</span></div><div class="contact-item"><i class="fas fa-envelope"></i><span>customerservice@hyfunfoods.com</span></div></div><a href="#customer-form" class="btn-channel"><i class="fas fa-comment-dots"></i>Chat Now</a></div>
            <div class="channel-card"><div class="channel-icon"><i class="fas fa-globe"></i></div><h3>Export Enquiries</h3><p>For international trade and business partnerships</p><div class="channel-contacts"><div class="contact-item"><i class="fas fa-phone"></i><span>+91 75750 02999 (Ext. 2)</span></div><div class="contact-item"><i class="fas fa-envelope"></i><span>exports@hyfunfoods.com</span></div></div><a href="exports.php#enquiry" class="btn-channel"><i class="fas fa-paper-plane"></i>Send Enquiry</a></div>
            <div class="channel-card"><div class="channel-icon"><i class="fas fa-briefcase"></i></div><h3>Business Partnerships</h3><p>For distributors, retailers, and corporate alliances</p><div class="channel-contacts"><div class="contact-item"><i class="fas fa-phone"></i><span>+91 75750 02999 (Ext. 3)</span></div><div class="contact-item"><i class="fas fa-envelope"></i><span>partnerships@hyfunfoods.com</span></div></div><a href="#partnership-form" class="btn-channel"><i class="fas fa-handshake"></i>Partner With Us</a></div>
            <div class="channel-card"><div class="channel-icon"><i class="fas fa-lightbulb"></i></div><h3>Innovation & R&D</h3><p>For new product ideas and collaboration opportunities</p><div class="channel-contacts"><div class="contact-item"><i class="fas fa-phone"></i><span>+91 75750 02999 (Ext. 4)</span></div><div class="contact-item"><i class="fas fa-envelope"></i><span>innovation@hyfunfoods.com</span></div></div><a href="#innovation-form" class="btn-channel"><i class="fas fa-flask"></i>Share Idea</a></div>
        </div>
    </div>
</section>

<section class="connect-form-section section-bg" id="customer-form">
    <div class="container">
        <div class="form-container">
            <div class="form-intro"><h2>Send Us a Message</h2><p>We'd love to hear from you. Fill out the form below and our team will get back to you within 24 hours.</p><div class="form-highlights"><div class="highlight"><i class="fas fa-clock"></i><span>24-hour response time</span></div><div class="highlight"><i class="fas fa-user-check"></i><span>Dedicated support agent</span></div><div class="highlight"><i class="fas fa-shield-alt"></i><span>Secure & confidential</span></div></div></div>
            <form id="connectForm" class="connect-form">
                <div class="form-header"><div class="form-progress"><div class="progress-step active" data-step="1"><span class="step-number">1</span><span class="step-label">Purpose</span></div><div class="progress-step" data-step="2"><span class="step-number">2</span><span class="step-label">Details</span></div><div class="progress-step" data-step="3"><span class="step-number">3</span><span class="step-label">Contact</span></div></div></div>
                <div class="form-step active" id="step-1"><h3>What brings you to us today?</h3><div class="purpose-options"><label class="purpose-option"><input type="radio" name="purpose" value="product-inquiry"><div class="option-content"><i class="fas fa-shopping-cart"></i><h4>Product Inquiry</h4><p>Questions about our products or want to place an order</p></div></label><label class="purpose-option"><input type="radio" name="purpose" value="business-partnership"><div class="option-content"><i class="fas fa-handshake"></i><h4>Business Partnership</h4><p>Interested in becoming a distributor or retail partner</p></div></label><label class="purpose-option"><input type="radio" name="purpose" value="feedback"><div class="option-content"><i class="fas fa-comment-alt"></i><h4>Feedback & Suggestions</h4><p>Share your experience or suggest improvements</p></div></label><label class="purpose-option"><input type="radio" name="purpose" value="other"><div class="option-content"><i class="fas fa-ellipsis-h"></i><h4>Other Inquiry</h4><p>Any other questions or concerns</p></div></label></div><div class="form-navigation"><button type="button" class="btn-next" data-next="2">Next <i class="fas fa-arrow-right"></i></button></div></div>
                <div class="form-step" id="step-2"><h3>Tell us more about your inquiry</h3><div class="form-group"><label for="subject">Subject</label><input type="text" id="subject" name="subject" placeholder="Brief summary of your inquiry"></div><div class="form-group"><label for="message">Message Details</label><textarea id="message" name="message" rows="5" placeholder="Please provide detailed information about your inquiry..."></textarea></div><div class="form-row"><div class="form-group"><label for="product-category">Product Category (if applicable)</label><select id="product-category" name="productCategory"><option value="">Select Category</option><option value="french-fries">French Fries</option><option value="potato-specialties">Potato Specialties</option><option value="veggie-specialties">Veggie Specialties</option><option value="indian-ethnic">Indian Ethnic Snacks</option><option value="all">All Products</option></select></div><div class="form-group"><label for="urgency">Urgency Level</label><select id="urgency" name="urgency"><option value="normal">Normal</option><option value="important">Important</option><option value="urgent">Urgent</option></select></div></div><div class="form-navigation"><button type="button" class="btn-prev" data-prev="1"><i class="fas fa-arrow-left"></i>Previous</button><button type="button" class="btn-next" data-next="3">Next <i class="fas fa-arrow-right"></i></button></div></div>
                <div class="form-step" id="step-3"><h3>How can we reach you?</h3><div class="form-row"><div class="form-group"><label for="fullName">Full Name *</label><input type="text" id="fullName" name="fullName" required></div><div class="form-group"><label for="company">Company/Organization</label><input type="text" id="company" name="company"></div></div><div class="form-row"><div class="form-group"><label for="email">Email Address *</label><input type="email" id="email" name="email" required></div><div class="form-group"><label for="phone">Phone Number *</label><input type="tel" id="phone" name="phone" required></div></div><div class="form-group"><label for="country">Country *</label><select id="country" name="country" required><option value="">Select Country</option><option value="India">India</option><option value="USA">United States</option><option value="UK">United Kingdom</option><option value="UAE">United Arab Emirates</option><option value="Australia">Australia</option><option value="Germany">Germany</option><option value="Other">Other</option></select></div><div class="form-group"><label class="checkbox-option"><input type="checkbox" name="newsletter" checked><span>Subscribe to our newsletter for updates and offers</span></label></div><div class="form-navigation"><button type="button" class="btn-prev" data-prev="2"><i class="fas fa-arrow-left"></i>Previous</button><button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i>Send Message</button></div></div>
                <div class="form-progress-indicator"><div class="progress-bar"><div class="progress-fill"></div></div><span class="progress-text">Step <span id="current-step">1</span> of 3</span></div>
            </form>
        </div>
    </div>
</section>

<section class="social-connect section-bg">
    <div class="container">
        <div class="section-title"><h2>Stay Connected</h2><p>Follow us for updates, recipes, and more</p><div class="title-accent"></div></div>
        <div class="social-grid">
            <a href="https://www.facebook.com/share/1AY6vLqord/" class="social-card facebook"><div class="social-icon"><i class="fab fa-facebook-f"></i></div><h3>Facebook</h3><p>Join our community of food lovers</p><span class="social-handle">HyFun Foods</span></a>
            <a href="https://www.instagram.com/hyfun_foods/" class="social-card instagram"><div class="social-icon"><i class="fab fa-instagram"></i></div><h3>Instagram</h3><p>Recipes, behind-the-scenes & more</p><span class="social-handle">@hyfun_foods</span></a>
            <a href="https://www.linkedin.com/company/asandasandsonspvtltd/" class="social-card linkedin"><div class="social-icon"><i class="fab fa-linkedin-in"></i></div><h3>LinkedIn</h3><p>Business updates & career opportunities</p><span class="social-handle">HyFun Foods</span></a>
            <a href="https://www.youtube.com/@hyfun_foods" class="social-card youtube"><div class="social-icon"><i class="fab fa-youtube"></i></div><h3>YouTube</h3><p>Cooking tutorials & product showcases</p><span class="social-handle">HyFun Foods</span></a>
        </div>
    </div>
</section>

<div id="successModal" class="modal-overlay"><div class="modal-content"><div class="modal-icon"><i class="fas fa-check-circle"></i></div><h3>Message Sent Successfully!</h3><p>Thank you for reaching out. Our team will contact you within 24 hours.</p><button id="closeModal" class="btn-modal">Close</button></div></div>

<script>
// Override connect.js to use PHP API
document.addEventListener('DOMContentLoaded', function() {
    const connectForm = document.getElementById('connectForm');
    if (connectForm) {
        connectForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Validate step 3 fields
            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const country = document.getElementById('country').value;
            
            if (!fullName || !email || !phone || !country) {
                showToast('Please fill all required fields', 'error');
                return;
            }
            
            if (!/^\S+@\S+\.\S+$/.test(email)) {
                showToast('Please enter a valid email', 'error');
                return;
            }
            
            const formData = {
                purpose: document.querySelector('input[name="purpose"]:checked')?.value,
                subject: document.getElementById('subject').value,
                message: document.getElementById('message').value,
                fullName: fullName,
                company: document.getElementById('company').value,
                email: email,
                phone: phone,
                country: country,
                productCategory: document.getElementById('product-category').value,
                urgency: document.getElementById('urgency').value,
                newsletter: document.querySelector('input[name="newsletter"]')?.checked ? 'on' : 'off'
            };
            
            const submitBtn = document.querySelector('.btn-submit');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            submitBtn.disabled = true;
            
            try {
                const response = await fetch('./api/enquiry_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'save_enquiry', enquiryData: formData })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    document.getElementById('successModal').classList.add('active');
                    connectForm.reset();
                } else {
                    showToast('Error: ' + (result.error || 'Failed to send message'), 'error');
                }
            } catch (error) {
                showToast('Network error. Please try again.', 'error');
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    }
    
    // Newsletter form
    const newsletterForm = document.getElementById('newsletterForm');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            try {
                const response = await fetch('./api/enquiry_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'subscribe_newsletter', email: email })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showToast('Successfully subscribed to newsletter!', 'success');
                    newsletterForm.reset();
                } else {
                    showToast('Error: ' + (result.error || 'Failed to subscribe'), 'error');
                }
            } catch (error) {
                showToast('Network error. Please try again.', 'error');
            }
        });
    }
    
    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.innerHTML = `<div class="toast-content"><i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i><span>${message}</span></div><button class="toast-close"><i class="fas fa-times"></i></button>`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 5000);
        toast.querySelector('.toast-close').addEventListener('click', () => toast.remove());
    }
});
</script>

<?php
$content = ob_get_clean();
include 'includes/header.php';
echo $content;
include 'includes/footer.php';
?>