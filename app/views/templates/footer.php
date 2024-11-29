<footer class="footer">
    <div class="footer-content">
        <!-- Logo Section -->
        <div class="footer-logo-section">
            <img src="\images\imagelogo2.png" alt="Career Connect" class="footer-logo">
            <p class="footer-description">Our goal is to simplify the job-seeking journey, 
                empower individuals to showcase their unique skills, and help businesses connect with the right talent faster..</p>
        </div>

        <!-- Navigation Links -->
        <div class="footer-links">
            <div class="footer-column">
                <h3>Navigation</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Find Job</a></li>
                    <li><a href="#">About Us</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Quick Link</h3>
                <ul>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Booking</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Services</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Blog</a></li>
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
    background-color: #002147;
    color: white;
    padding: 60px 20px 20px;
    font-family: 'Poppins', sans-serif;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.5fr 2fr;
    gap: 40px;
    margin-bottom: 40px;
}

.footer-logo-section {
    padding-right: 20px;
}

.footer-logo {
    max-width: 180px;
    margin-bottom: 20px;
}

.footer-description {
    color: rgba(255, 255, 255, 0.7);
    font-size: 14px;
    line-height: 1.6;
}

.footer-links {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.footer-column h3 {
    color: white;
    font-size: 18px;
    margin-bottom: 20px;
    font-weight: 600;
}

.footer-column ul {
    list-style: none;
    padding: 0;
}

.footer-column ul li {
    margin-bottom: 12px;
}

.footer-column ul li a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
}

.footer-column ul li a:hover {
    color: white;
}

.footer-contact {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.contact-item i {
    color: #FFD700;
    font-size: 18px;
}

.contact-item span {
    color: rgba(255, 255, 255, 0.7);
    font-size: 14px;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-link {
    background: white;
    color: #002147;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: #FFD700;
    color: white;
}

.footer-copyright {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
    padding-top: 20px;
    color: rgba(255, 255, 255, 0.7);
    font-size: 14px;
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
    }

    .footer-links {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .footer-contact {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }

    .contact-item {
        justify-content: center;
    }
}
</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">