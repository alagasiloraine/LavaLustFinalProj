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

        .hero-section {
            background: linear-gradient(135deg, #2B6CB0 0%, #1A365D 100%);
            min-height: 200px;
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
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 3.5rem;
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
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-primary:hover {
            background: #B7CDDB;
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

        .services-section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            max-width: 1200px;
            margin: -80px auto 0;
            padding: 20px 5px;
            position: relative;
            z-index: 2;

        }

        .service-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: justify;
        }

        .service-card h3 {
            font-size: 1.5rem;
            margin: 15px 0 20px;
            color: #333;
            font-weight: 500; 
        }

        .service-card p {
            margin-top: 10px; 
            font-size: 1rem; 
            line-height: 1.6; 
            color: #555; 
        }

        .service-card .service-icon {
            font-size: 1.5rem; 
            color: #007BFF;
            margin-bottom: 15px;
        }


        .testimonials-section {
            padding: 80px 20px;
            background-color: #f5f5f5;
            overflow: hidden;
        }

        .testimonials-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .testimonials-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 50px;
        }

        .testimonials-title {
            font-size: 2.5rem;
            color: #333;
            margin: 0;
        }

        .company-name {
            color: #0066cc;
            position: relative;
        }

        .company-name::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #B7CDDB;
        }

        .testimonials-track {
            display: flex;
            gap: 30px;
            transition: transform 0.3s ease;
            width: calc(400px * 6);
        }

        .testimonial-card {
            flex: 0 0 370px;
            background: white;
            border-radius: 12px;
            padding: 30px;
            transition: all 0.3s ease;
            cursor: pointer;
            transform-origin: center;
        }

        .testimonial-card:hover, 
        .testimonial-card.active {
            background-color: #B7CDDB;
            color: white;
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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

        .carousel-navigation {
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
            color: #333;
        }

        .nav-button:hover {
            background: #0066cc;
            color: white;
            border-color: #0066cc;
        }

        .learn-more {
            color: inherit;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }

        .learn-more .arrow {
            margin-left: 5px;
            transition: transform 0.3s ease;
        }

        .learn-more:hover .arrow {
            transform: translateX(5px);
        }

        /* General Section Styling */
        section {
            padding: 50px 20px;
            text-align: center;
            background-color: #f9f9f9;
            margin-bottom: 20px;
            font-family: 'Arial', sans-serif;
        }

        .about-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .about-container h2 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .about-container p {
            font-size: 1rem;
            line-height: 1.6;
            color: #666;
            margin-bottom: 15px;
        }

        /* Stats Section Styling */
        .stats-section {
            background-color: #0073e6;
            color: #fff;
            border-radius: 8px;
            margin: 0 auto;
            width: 60%;
            height: -90px;
        }

        .stats-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            padding: 10px 0;
        }

        .stat {
            text-align: center;
            margin: 10px;
            width: 30%;
        }

        .stat h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: bold;
            color: #fff;
        }

        .stat p {
            font-size: 1rem;
            margin: 0;
            color: #d3e5ff;
        }


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

        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 0;
            }

            .hero-title {
                font-size: 2rem;
            }

            .services-section {
                grid-template-columns: 1fr;
                margin-top: 20px;
            }

            .hero-image {
                max-width: 100%;
                padding: 0 20px;
            }
            .stats-container {
        flex-direction: column;
    }

    .stat {
        width: 80%;
        margin-bottom: 20px;
    }
        }
    </style>
</head>
<body>
    <?php include APP_DIR.'views/templates/nav.php'; ?>

    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title">Welcome to CareerConnect, the ultimate job portal for IT professionals. </h1>
                <p class="hero-description">We specialize in connecting top tech talent with forward-thinking companies, creating opportunities for growth, innovation, and success.</p>
                <div class="hero-buttons">
                    <a href="<?= site_url('user/jobs') ?>" class="btn btn-primary">Find a Job</a>
                    <a href="/user/Contact" class="btn btn-secondary">Contact Us</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="/public/images/coverphoto_it-removebg-preview.png" alt="Professional with laptop">
            </div>
        </div>
    </section>

    <div class="services-section">
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-code"></i>
            </div>
            <h3>Find Your Dream IT Role</h3>
            <p>At CareerConnect, we match your unique skills with exclusive opportunities in software development, engineering, and IT management. 
                Advance your career that inspire.</p>

        </div>
        
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-cloud"></i>
            </div>
            <h3>Innovate in the Cloud</h3>
            <p>Join the future of IT with roles in cloud computing, DevOps, and system architecture. 
                At CareerConnect, we help you find positions that shape the digital landscape.</p>
        </div>
        
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Lead in Cybersecurity</h3>
            <p>Protect and secure the digital world with a career in cybersecurity. CareerConnect connects IT professionals with companies seeking experts in digital defense.</p>
        </div>
    </div>

    <section class="about-section">
        <div class="about-container">
            <h2>About CareerConnect</h2>
            <p>CareerConnect is a premier platform designed to bridge the gap between skilled IT professionals and forward-thinking companies. Founded with the vision of transforming the recruitment process in the tech industry, CareerConnect leverages cutting-edge tools to connect talent with opportunities. Whether you are an aspiring developer, a seasoned IT expert, or a company searching for the perfect fit, CareerConnect is your trusted partner in building meaningful and successful careers.</p>
        </div>
    </section>

    <section class="stats-section">
        <div class="stats-container">
            <div class="stat">
                <h2>10,000+</h2>
                <p>Jobs Posted</p>
            </div>
            <div class="stat">
                <h2>500+</h2>
                <p>Partner Companies</p>
            </div>
            <div class="stat">
                <h2>2,000+</h2>
                <p>Successful Placements</p>
            </div>
        </div>
    </section>

    <section class="testimonials-section">
        <div class="testimonials-container">
            <div class="testimonials-header">
                <h2 class="testimonials-title">
                    What Our Clients Say About <span class="company-name">Us</span>
                </h2>
                <div class="carousel-navigation">
                    <button class="nav-button prev" aria-label="Previous testimonial">←</button>
                    <button class="nav-button next" aria-label="Next testimonial">→</button>
                </div>
            </div>
            
            <div class="testimonials-carousel">
                <div class="testimonials-track">
                    <?php
                    $testimonials = [
                        [
                            'name' => 'Mark Ramirez',
                            'position' => 'Owner of Luna\'s Inc',
                            'image' => '/public/images/testimonial1.jpg',
                            'text' => 'Their team took our wellness brand and elevated it to new heights with their thoughtful designs and strategic branding, they\'ve helped us create a cohesive and compelling brand identity.'
                        ],
                        [
                            'name' => 'Job Ghadzi',
                            'position' => 'CEO Glow Co.',
                            'image' => '/public/images/testimonial2.jpg',
                            'text' => 'In the fast-paced world of tech, it\'s crucial to have a creative partner who can keep up with our innovative ideas. They transformed our marketing campaigns with their fresh perspective.'
                        ],
                        [
                            'name' => 'Thomas Gala',
                            'position' => 'Founder ZenTech Wellness',
                            'image' => '/public/images/testimonial3.jpg',
                            'text' => 'As a fellow creative professional, I have high standards when it comes to design. Their approach to our website redesign was nothing short of brilliant.'
                        ],
                        // Add more testimonials as needed
                    ];

                    foreach($testimonials as $index => $testimonial): ?>
                        <div class="testimonial-card" data-index="<?php echo $index; ?>">
                            <div class="testimonial-header">
                                <img src="<?php echo $testimonial['image']; ?>" alt="" class="testimonial-image">
                                <div class="testimonial-info">
                                    <h4><?php echo $testimonial['name']; ?></h4>
                                    <p><?php echo $testimonial['position']; ?></p>
                                </div>
                            </div>
                            <p class="testimonial-text"><?php echo $testimonial['text']; ?></p>
                            <a href="#" class="learn-more">
                                Learn more 
                                <svg class="arrow" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.querySelector('.testimonials-track');
            const cards = document.querySelectorAll('.testimonial-card');
            const nextButton = document.querySelector('.nav-button.next');
            const prevButton = document.querySelector('.nav-button.prev');
            
            let currentIndex = 0;
            const cardWidth = 400; // Width of each card including gap
            const visibleCards = 3; // Show 2.5 cards at a time
            
            function updateSlidePosition() {
                const offset = -currentIndex * cardWidth;
                track.style.transform = `translateX(${offset}px)`;
                
                // Update active states
                cards.forEach((card, index) => {
                    card.classList.remove('active');
                    if(index === currentIndex) {
                        card.classList.add('active');
                    }
                });
            }
            
            function moveToNext() {
                currentIndex = (currentIndex + 1) % (cards.length - visibleCards + 1);
                updateSlidePosition();
            }
            
            function moveToPrev() {
                currentIndex = currentIndex === 0 ? cards.length - visibleCards : currentIndex - 1;
                updateSlidePosition();
            }
            
            // Event Listeners
            nextButton.addEventListener('click', moveToNext);
            prevButton.addEventListener('click', moveToPrev);
            
            // Click handler for cards
            cards.forEach(card => {
                card.addEventListener('click', () => {
                    cards.forEach(c => c.classList.remove('active'));
                    
                });
            });
            
            // Auto-advance every 5 seconds
            setInterval(moveToNext, 5000);
            
            // Initial position
            updateSlidePosition();
        });
    </script>

<?php include APP_DIR.'views/templates/footer.php'; ?>

</body>
</html>