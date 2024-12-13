<footer class="footer">
    <div class="footer-content">
        <!-- Logo Section -->
        <div class="footer-logo-section">
            <div class="logo-container">
                <img src="\public\images\imagelogo1.png" alt="Career Connect" class="footer-logo">
                <span class="logo-text">Career Connect</span>
            </div>
            <p class="footer-description">Our goal is to simplify the job-seeking journey, 
                empower individuals to showcase their unique skills, and help businesses connect with the right talent faster.</p>
        </div>

        <!-- Navigation Links -->
        <div class="footer-links">
            <div class="footer-column">
                <h3>Navigation</h3>
                <ul>
                    <li><a href="<?= site_url('home'); ?>"><span>Home</span></a></li>
                    <li><a href="<?= site_url('jobs') ?>" ><span>Find Job</span></a></li>
                    <li><a href="<?= site_url('about-us') ?>"><span>About Us</span></a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Quick Link</h3>
                <ul>
                    <li><a href="<?= site_url('home'); ?>"><span>Home</span></a></li>
                    <li><a href="<?= site_url('jobs') ?>" ><span>Find Job</span></a></li>
                    <li><a href="<?= site_url('about-us') ?>"><span>About Us</span></a></li>
                    <li><a href="<?= site_url('contact') ?>"><span>Contact Us</span></a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Services</h3>
                <ul>
                    <li><a href="<?= site_url('home'); ?>"><span>Home</span></a></li>
                    <li><a href="/user/Contact"><span>Contact Us</span></a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="footer-contact">
        <div class="contact-item">
            <i class="fas fa-map-marker-alt"></i>
            <span>Oriental Mindoro, Philippines</span>
        </div>
        <div class="contact-item">
            <i class="fas fa-phone"></i>
            <span>088-777-666-85</span>
        </div>
        <div class="contact-item">
            <i class="fas fa-envelope"></i>
            <span>careerconnect@gmail.com</span>
        </div>
        <div class="social-links">
            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-copyright">
        <p>&copy; 2024 Career Connect • All Rights Reserved</p>
    </div>
</footer>

<style>
.footer {
    background: #1A366D;
    color: white;
    padding: 40px 20px 15px; /* Reduced top padding */
    font-family: 'Poppins', sans-serif;
    position: relative;
    overflow: hidden;
}

.footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(to right, #FFD700, #FFA500);
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.5fr 2fr;
    gap: 40px;
    margin-bottom: 25px; /* Reduced margin */
    position: relative;
}

.footer-logo-section {
    padding-right: 20px;
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.footer-logo {
    width: 40px;
    height: auto;
    filter: brightness(1.1);
    transition: transform 0.3s ease;
}

.logo-text {
    font-size: 24px;
    font-weight: 600;
    color: white;
    letter-spacing: 0.5px;
}

.footer-description {
    color: rgba(255, 255, 255, 0.85);
    font-size: 14px;
    line-height: 1.6; /* Slightly reduced line height */
    margin-top: 15px; /* Reduced margin */
}

.footer-links {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px; /* Slightly reduced gap */
}

.footer-column h3 {
    color: white;
    font-size: 18px;
    margin-bottom: 15px; /* Reduced margin */
    font-weight: 600;
    position: relative;
    padding-bottom: 8px; /* Slightly reduced padding */
}

.footer-column h3::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 30px;
    height: 2px;
    background: #FFD700;
}

.footer-column ul {
    list-style: none;
    padding: 0;
}

.footer-column ul li {
    margin-bottom: 10px; /* Reduced margin */
}

.footer-column ul li a {
    color: rgba(255, 255, 255, 0.85);
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
    display: inline-block;
    position: relative;
}

.footer-column ul li a span {
    position: relative;
    display: inline-block;
    padding: 2px 0;
}

.footer-column ul li a span::after {
    content: '';
    position: absolute;
    width: 0;
    height: 1px;
    bottom: 0;
    left: 0;
    background-color: #FFD700;
    transition: width 0.3s ease;
}

.footer-column ul li a:hover span::after {
    width: 100%;
}

.footer-column ul li a:hover {
    color: white;
    transform: translateX(5px);
}

.footer-contact {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0; /* Reduced padding */
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px; /* Slightly reduced gap */
    transition: transform 0.3s ease;
}

.contact-item:hover {
    transform: translateY(-2px);
}

.contact-item i {
    color: #FFD700;
    font-size: 16px; /* Slightly reduced font size */
    transition: transform 0.3s ease;
}

.contact-item:hover i {
    transform: scale(1.1);
}

.contact-item span {
    color: rgba(255, 255, 255, 0.9);
    font-size: 13px; /* Slightly reduced font size */
}

.social-links {
    display: flex;
    gap: 12px; /* Slightly reduced gap */
}

.social-link {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    width: 34px; /* Slightly reduced size */
    height: 34px; /* Slightly reduced size */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.social-link:hover {
    background: #FFD700;
    color: #002147;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.footer-copyright {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
    padding-top: 15px; /* Reduced padding */
    color: rgba(255, 255, 255, 0.8);
    font-size: 13px; /* Slightly reduced font size */
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: 25px; /* Reduced gap */
    }

    .footer-links {
        grid-template-columns: repeat(2, 1fr);
        gap: 25px; /* Reduced gap */
    }

    .footer-contact {
        flex-direction: column;
        gap: 15px; /* Reduced gap */
        text-align: center;
        padding: 15px 0; /* Reduced padding */
    }

    .contact-item {
        justify-content: center;
    }

    .social-links {
        margin-top: 10px;
    }
}

@media (max-width: 480px) {
    .footer-links {
        grid-template-columns: 1fr;
        gap: 20px; /* Reduced gap */
    }
}
</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">