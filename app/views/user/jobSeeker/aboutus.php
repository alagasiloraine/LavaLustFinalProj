<?php include APP_DIR.'views/templates/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Hero Section Styles */
        .about-hero {
            background: linear-gradient(135deg, #2B6CB0 0%, #1A365D 100%);
            min-height: 400px;
            padding: 60px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(43, 108, 176, 0.1) 0%, rgba(26, 54, 93, 0.1) 100%);
            pointer-events: none;
        }

        .main-title {
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .about-content {
            background: white;
            border-radius: 10px;
            padding: 0.5rem;
            max-width: 400px;
            margin: 0 auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .about-text {
            color: #2B6CB0;
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            line-height: 1.4;
        }

        /* Introduction Section */
        .intro-section {
            padding: 60px 0;
            background: white;
        }

        .intro-text {
            max-width: 1000px;
            margin: 0 auto;
            padding: 30px;
            background: rgba(43, 108, 176, 0.1);
            border-radius: 12px;
            color: #2B6CB0;
            text-align: center;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        /* Mission Vision Section */
        .mission-vision-section {
            padding: 20px 0 0 0;
            background: white;
        }

        .mission-vision-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .image-container {
            border-radius: 12px;
            overflow: hidden;
            height: 75%;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .statements-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .statement-box {
            background: rgba(43, 108, 176, 0.1);
            padding: 30px;
            border-radius: 12px;
            transition: transform 0.3s ease;
        }

        .statement-box:hover {
            transform: translateY(-5px);
        }

        .statement-title {
            color: #2B6CB0;
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .statement-text {
            color: #4A5568;
            line-height: 1.6;
        }

        /* FAQ Section */
        .faq-section {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .faq-title {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        .faq-description {
            color: #666;
            margin-bottom: 40px;
            max-width: 600px;
        }

        .faq-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: center; /* Changed from start to center */
            position: relative;
            margin-bottom: 80px; /* Increased space for button */
        }

        .questions-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .faq-question {
            background: white;
            padding: 20px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 500;
            color: #333;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .faq-question:hover {
            background: #f8f8f8;
        }

        .faq-question.active {
            background: #f0f0f0;
            color: #2B6CB0;
        }

        .question-icon {
            font-size: 1.2rem;
            color: #2B6CB0;
        }

        .answer-container {
            background: #2B6CB0;
            border-radius: 12px;
            padding: 30px;
            color: white;
            position: sticky;
            top: 50%; /* Changed to center vertically */
            transform: translateY(-50%); /* Added to center vertically */
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            margin: 0; /* Reset margin */
        }

        .faq-answer {
            display: none;
            line-height: 1.6;
            text-align: center;
            padding: 0 20px;
        }

        .faq-answer.active {
            display: block;
        }

        .contact-button-wrapper {
            text-align: center;
            position: absolute;
            bottom: -60px; /* Position below the container */
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
        }

        .contact-button {
            display: inline-block;
            background: white;
            color: #2B6CB0;
            padding: 12px 40px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            text-align: center;
            transition: all 0.3s ease;
            min-width: 200px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .contact-button:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .mission-vision-container {
                grid-template-columns: 1fr;
            }

            .image-container {
                height: 300px;
            }

            .intro-text {
                font-size: 1rem;
                padding: 20px;
            }

            .faq-container {
                margin-bottom: 100px; /* Adjusted for mobile */
            }
            
            .answer-container {
                position: static;
                transform: none;
                margin: 20px 0;
            }

            .contact-button-wrapper {
                position: static;
                transform: none;
                margin-top: 20px;
            }

            .faq-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <?php include APP_DIR.'views/templates/nav.php'; ?>

    <div class="about-hero">
        <div class="container">
            <h1 class="main-title">GET TO KNOW THE BIGGEST JOB PLATFORM FOR IT PROFESSIONAL</h1>
            <div class="about-content">
                <p class="about-text">ABOUT US</p>
            </div>
        </div>
    </div>

    <section class="intro-section">
        <div class="container">
            <div class="intro-text">
                CareerConnect was founded by a team of IT professionals who recognized the challenges of finding meaningful work in the fast-paced and ever-evolving tech industry. Having experienced firsthand the frustrations of mismatched opportunities, lack of visibility for skilled talent, and limited access to personalized career guidance, we decided to create a solution that bridges these gaps.
            </div>
        </div>
    </section>

    <section class="mission-vision-section">
        <div class="mission-vision-container">
            <div class="image-container">
                <img src="\public\images\IT-Professionals-at-work.jpg" alt="IT Professionals at work">
            </div>
            <div class="statements-container">
                <div class="statement-box">
                    <h2 class="statement-title">Our Vision</h2>
                    <p class="statement-text">
                        We aim to become the leading career hub for IT professionals, empowering innovation and growth in the tech industry worldwide.
                    </p>
                </div>
                <div class="statement-box">
                    <h2 class="statement-title">Our Mission</h2>
                    <p class="statement-text">
                        Our mission is to bridge the gap between skilled IT professionals and forward-thinking companies by providing a reliable platform for career advancement and talent acquisition.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-section">
        <h2 class="faq-title">Frequently Asked Questions</h2>
        <p class="faq-description">Get answers to commonly asked questions about our services, features, and how to make the most of our powerful solutions.</p>
        
        <div class="faq-container">
            <div class="questions-list">
                <?php
                $faqs = [
                    [
                        'question' => 'Can I use my own domain with your service?',
                        'answer' => 'Yes, you can easily use your own domain with our service. We provide full support for custom domains and will guide you through the setup process.'
                    ],
                    [
                        'question' => 'Is it possible to export my data?',
                        'answer' => 'We offer comprehensive data export options in various formats to ensure you always have access to your information.'
                    ],
                    [
                        'question' => 'Do you provide e-commerce capabilities?',
                        'answer' => 'Yes, we offer robust e-commerce solutions with features like secure payment processing, inventory management, and order tracking.'
                    ],
                    [
                        'question' => 'Can I collaborate with others on projects?',
                        'answer' => 'Our platform includes powerful collaboration tools that allow team members to work together seamlessly on projects.'
                    ],
                    [
                        'question' => 'Is there a limit to the number of projects I can create?',
                        'answer' => 'The number of projects you can create depends on your subscription plan. Contact us for detailed information about our plans.'
                    ],
                    [
                        'question' => 'Is support available if I need assistance?',
                        'answer' => 'Yes, we provide 24/7 customer support through multiple channels including email, chat, and phone.'
                    ]
                ];

                foreach($faqs as $index => $faq): ?>
                    <div class="faq-question <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                        <?php echo $faq['question']; ?>
                        <span class="question-icon">+</span>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="answer-container">
                <?php foreach($faqs as $index => $faq): ?>
                    <div class="faq-answer <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                        <?php echo $faq['answer']; ?>
                    </div>
                <?php endforeach; ?>
                <div class="contact-button-wrapper">
                    <a href="/contact" class="contact-button">Contact Us</a>
                </div>
            </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const questions = document.querySelectorAll('.faq-question');
        const answers = document.querySelectorAll('.faq-answer');

        questions.forEach(question => {
            question.addEventListener('click', () => {
                const index = question.dataset.index;
                
                // Remove active class from all questions and answers
                questions.forEach(q => q.classList.remove('active'));
                answers.forEach(a => a.classList.remove('active'));
                
                // Add active class to clicked question and corresponding answer
                question.classList.add('active');
                document.querySelector(`.faq-answer[data-index="${index}"]`).classList.add('active');
                
                // Update the plus/minus icon
                questions.forEach(q => {
                    q.querySelector('.question-icon').textContent = '+';
                });
                question.querySelector('.question-icon').textContent = '-';
            });
        });
    });
    </script>
</body>
</html>