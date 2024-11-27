<?php include APP_DIR.'views/templates/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Connect - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f5f5f5;
        }

        /* Hero Section - Matched with About Us */
        .hero-section {
            background: linear-gradient(135deg, #2B6CB0 0%, #1A365D 100%);
            min-height: 400px;
            padding: 60px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(43, 108, 176, 0.1) 0%, rgba(26, 54, 93, 0.1) 100%);
            pointer-events: none;
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .hero-content {
            max-width: 600px;
            z-index: 1;
        }

        .hero-title {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-description {
            color: white;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-primary {
            background: #00E5BE;
            color: #2B6CB0;
        }

        .btn-primary:hover {
            background: #00d4b0;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .hero-image {
            max-width: 500px;
            z-index: 1;
        }

        .hero-image img {
            width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Existing Services Section Styles - Unchanged */
        .services-section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            max-width: 1200px;
            margin: -50px auto 0;
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }

        .service-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
                /* Testimonials Section Styles */
                .testimonials-section {
            padding: 80px 20px;
            background-color: #f5f5f5;
        }
        .testimonials-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }
        .testimonials-title {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 50px;
            text-align: left;
            position: relative;
            display: inline-block;
        }
        .company-name {
            position: relative;
            display: inline-block;
        }
        .company-name::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #90A99C;
            border-radius: 2px;
        }
        .testimonials-carousel {
            position: relative;
            overflow: hidden;
        }
        .testimonials-track {
            display: flex;
            gap: 30px;
            transition: transform 0.5s ease;
        }
        .testimonial-card {
            flex: 0 0 calc(33.333% - 20px);
            background: white;
            border-radius: 20px;
            padding: 30px;
            transition: all 0.3s ease;
        }
        .testimonial-card.active {
            background-color: #90A99C;
            color: white;
        }
        .testimonial-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .testimonial-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
        }
        .testimonial-info h4 {
            font-size: 1.1rem;
            margin: 0;
            color: inherit;
        }
        .testimonial-info p {
            font-size: 0.9rem;
            margin: 0;
            opacity: 0.8;
        }
        .testimonial-text {
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .learn-more {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .learn-more .arrow {
            margin-left: 5px;
            transition: transform 0.3s ease;
        }
        .learn-more:hover .arrow {
            transform: translateX(5px);
        }
        .carousel-navigation {
            position: absolute;
            top: -80px;
            right: 0;
            display: flex;
            gap: 10px;
        }
        .nav-button {
            width: 40px;
            height: 40px;
            border: 1px solid #e0e0e0;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .nav-button:hover {
            background: #90A99C;
            color: white;
            border-color: #90A99C;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-container {
                flex-direction: column;
                text-align: center;
            }

            .hero-content {
                margin-bottom: 2rem;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-image {
                max-width: 400px;
            }
        }

    </style>
</head>
<body>
    <?php include APP_DIR.'views/templates/nav.php'; ?>

    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title">We solve business problems with ease.</h1>
                <p class="hero-description">Our performance is your success. Our passion is innovation. Our expertise is unmatched. We get you more.</p>
                <div class="hero-buttons">
                    <a href="/find-job" class="btn btn-primary">Find a Job</a>
                    <a href="/contact" class="btn btn-secondary">Contact Us</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="/public/images/hero-professional.jpg" alt="Professional with laptop">
            </div>
        </div>
    </section>
    <div class="services-section">
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-code"></i>
            </div>
            <h3>Software Services</h3>
            <p>Quisque metus nisi id dapibus sagittis platlea sagittis tortor lorem.</p>
            <a href="#" class="learn-more">Learn more</a>
        </div>
        
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-cloud"></i>
            </div>
            <h3>Cloud Services</h3>
            <p>Quisque metus nisi id dapibus sagittis platlea sagittis tortor lorem.</p>
            <a href="#" class="learn-more">Learn more</a>
        </div>
        
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Security Services</h3>
            <p>Quisque metus nisi id dapibus sagittis platlea sagittis tortor lorem.</p>
            <a href="#" class="learn-more">Learn more</a>
        </div>
    </div>

    <!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="testimonials-container">
        <h2 class="testimonials-title">
            What Our Clients Say About <span class="company-name">Solve.</span>
        </h2>
        
        <div class="testimonials-carousel">
            <div class="testimonials-track">
                <?php
                $testimonials = [
                    [
                        'name' => 'Mark Ramirez',
                        'position' => 'Owner of Luna\'s Inc',
                        'image' => '/public/images/testimonial1.jpg',
                        'text' => 'Their team took our wellness brand and elevated it to new heights with their thoughtful designs and strategic branding, they\'ve helped us create a cohesive and compelling brand identity. What sets them apart is their passion for storytelling through design.',
                        'active' => false
                    ],
                    [
                        'name' => 'Job Ghadzi',
                        'position' => 'CEO Glow Co.',
                        'image' => '/public/images/testimonial2.jpg',
                        'text' => 'In the fast-paced world of tech, it\'s crucial to have a creative partner who can keep up with our innovative ideas. They not only kept up but exceeded our expectations. They transformed our marketing campaigns with their fresh perspective and bold designs.',
                        'active' => true
                    ],
                    [
                        'name' => 'Thomas Gala',
                        'position' => 'Founder ZenTech Wellness',
                        'image' => '/public/images/testimonial3.jpg',
                        'text' => 'As a fellow creative professional, I have high standards when it comes to design. They not only met but exceeded those standards. Their approach to our website redesign was nothing short of brilliant and optimized it for a seamless user experience.',
                        'active' => false
                    ]
                ];

                foreach($testimonials as $testimonial): ?>
                    <div class="testimonial-card <?php echo $testimonial['active'] ? 'active' : ''; ?>">
                        <div class="testimonial-header">
                            <img src="<?php echo $testimonial['image']; ?>" alt="" class="testimonial-image">
                            <div class="testimonial-info">
                                <h4><?php echo $testimonial['name']; ?></h4>
                                <p><?php echo $testimonial['position']; ?></p>
                            </div>
                        </div>
                        <p class="testimonial-text"><?php echo $testimonial['text']; ?></p>
                        <a href="#" class="learn-more">Learn more <span class="arrow">→</span></a>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="carousel-navigation">
                <button class="nav-button prev" aria-label="Previous testimonial">←</button>
                <button class="nav-button next" aria-label="Next testimonial">→</button>
            </div>
        </div>
    </div>
</section>

<script>
        // Testimonials Carousel
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.querySelector('.testimonials-track');
            const slides = Array.from(track.children);
            const nextButton = document.querySelector('.next-button');
            const prevButton = document.querySelector('.prev-button');
            let currentIndex = 0;

            function moveToSlide(index) {
                if (index < 0) index = slides.length - 1;
                if (index >= slides.length) index = 0;
                track.style.transform = `translateX(-${index * 100}%)`;
                currentIndex = index;
            }

            nextButton.addEventListener('click', () => moveToSlide(currentIndex + 1));
            prevButton.addEventListener('click', () => moveToSlide(currentIndex - 1));

            // Auto-advance every 5 seconds
            setInterval(() => moveToSlide(currentIndex + 1), 5000);
        });
</script>
    

</body>
</html>