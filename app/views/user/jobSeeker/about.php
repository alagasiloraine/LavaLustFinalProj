<?php include APP_DIR.'views/templates/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Connect - About Us</title>
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

        .about-hero {
            background: linear-gradient(135deg, #2B6CB0 0%, #1A365D 100%);
            min-height: 300px;
            /* Reduced height to match Find Job section */
            padding: 40px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Adding light effect similar to Find Job */
        .about-hero::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 60px;
            background: radial-gradient(ellipse at center,
                    rgba(255, 255, 255, 0.15) 0%,
                    rgba(255, 255, 255, 0) 70%);
            pointer-events: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.1);
            }
        }

        .main-title {
            color: white;
            font-size: 2.3rem;
            font-weight: 700;
            margin-bottom: 2rem;
            letter-spacing: 0.5px;
            line-height: 1.2;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .about-content {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 1rem 3rem;
            max-width: 400px;
            margin: 0 auto;
            box-shadow:
                0 8px 32px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            /* Add animation */
            opacity: 0;
            animation: slideUpFade 0.6s ease forwards;
        }

        .about-content:hover {
            transform: translateY(-2px);
            transition: transform 0.3s ease;
        }

        /* Ensure animations work on page load */
        .about-hero {
            opacity: 1;
            visibility: visible;
        }


        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes floatIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animation keyframes */
        @keyframes slideUpFade {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes underlineSlide {
            0% {
                width: 0;
                opacity: 0;
            }

            100% {
                width: 40px;
                opacity: 1;
            }
        }

        .about-text {
            color: white;
            font-size: 1.65rem;
            font-weight: 600;
            text-align: center;
            line-height: 1.4;
            position: relative;
        }

        /* Enhanced underline animation */
        .about-text::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            height: 2px;
            background: white;
            border-radius: 2px;
            /* Add animation */
            opacity: 0;
            width: 0;
            animation: underlineSlide 0.4s ease forwards 0.6s;
        }

        /* Introduction Section */
        .intro-section {
            padding: 80px 0;
            background: #f8fafc;
            position: relative;
            overflow: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
        }

        .intro-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow:
                0 10px 30px rgba(43, 108, 176, 0.1),
                0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 50px;
            margin: 20px auto;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .intro-card:hover {
            transform: translateY(-5px);
            box-shadow:
                0 20px 40px rgba(43, 108, 176, 0.15),
                0 1px 5px rgba(0, 0, 0, 0.1);
        }

        .decorative-circles {
            position: absolute;
            top: 0;
            right: 0;
            pointer-events: none;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }

        .circle-1 {
            width: 100px;
            height: 100px;
            background: #2B6CB0;
            top: -20px;
            right: -20px;
        }

        .circle-2 {
            width: 60px;
            height: 60px;
            background: #4299E1;
            top: 40px;
            right: 40px;
        }

        .circle-3 {
            width: 30px;
            height: 30px;
            background: #63B3ED;
            top: 20px;
            right: 90px;
        }

        .intro-content {
            display: flex;
            gap: 40px;
            position: relative;
            z-index: 1;
        }

        .blue-line {
            width: 4px;
            min-height: 100%;
            background: linear-gradient(180deg, #2B6CB0 0%, #4299E1 100%);
            border-radius: 2px;
            flex-shrink: 0;
            position: relative;
        }

        .line-dot {
            width: 12px;
            height: 12px;
            background: #2B6CB0;
            border-radius: 50%;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .line-dot.top {
            top: 0;
        }

        .line-dot.bottom {
            bottom: 0;
        }

        .quote-container {
            flex: 1;
            position: relative;
        }

        .quote-icon {
            margin-bottom: 20px;
        }

        .intro-text {
            color: #4A5568;
            font-size: 1.15rem;
            line-height: 1.8;
            margin: 0 0 30px 0;
            font-weight: 400;
            letter-spacing: 0.3px;
        }

        .highlight-box {
            background: rgba(43, 108, 176, 0.05);
            border-left: 3px solid #2B6CB0;
            padding: 15px 20px;
            border-radius: 0 8px 8px 0;
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 30px;
        }

        .highlight-icon {
            font-size: 24px;
        }

        .highlight-text {
            color: #2B6CB0;
            font-weight: 500;
            margin: 0;
            font-size: 1.1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .intro-section {
                padding: 60px 0;
            }

            .intro-card {
                padding: 30px;
            }

            .intro-content {
                gap: 25px;
            }

            .intro-text {
                font-size: 1.1rem;
            }

            .highlight-box {
                padding: 12px 15px;
            }

            .highlight-text {
                font-size: 1rem;
            }

            .circle-1 {
                width: 80px;
                height: 80px;
            }

            .circle-2 {
                width: 40px;
                height: 40px;
            }

            .circle-3 {
                width: 20px;
                height: 20px;
            }
        }

        @media (max-width: 480px) {
            .intro-section {
                padding: 40px 0;
            }

            .intro-card {
                padding: 25px;
            }

            .intro-content {
                gap: 20px;
            }

            .intro-text {
                font-size: 1rem;
                line-height: 1.7;
            }

            .highlight-box {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
        }

        .mission-vision-section {
            padding: 80px 0;
            background: #f8fafc;
            position: relative;
            overflow: hidden;
            margin-top: -50px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .mission-vision-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow:
                0 10px 30px rgba(43, 108, 176, 0.1),
                0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 50px;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }

        .decorative-elements {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }

        .circle-1 {
            width: 200px;
            height: 200px;
            background: #2B6CB0;
            top: -100px;
            right: -100px;
        }

        .circle-2 {
            width: 150px;
            height: 150px;
            background: #4299E1;
            bottom: -75px;
            left: -75px;
        }

        .dot-pattern {
            position: absolute;
            width: 100px;
            height: 100px;
            background-image: radial-gradient(#2B6CB0 1px, transparent 1px);
            background-size: 10px 10px;
            opacity: 0.1;
            top: 20px;
            left: 20px;
        }

        .mission-vision-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            position: relative;
            z-index: 2;
        }

        .image-container {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 4/3;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-top: 130px;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(43, 108, 176, 0) 0%, rgba(43, 108, 176, 0.1) 100%);
            z-index: 1;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .image-container:hover img {
            transform: scale(1.05);
        }

        .image-caption {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.95);
            padding: 10px 20px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 2;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .caption-icon {
            font-size: 1.2rem;
        }

        .caption-text {
            color: #2B6CB0;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .statements-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .statement-box {
            background: rgba(255, 255, 255, 0.5);
            padding: 30px;
            border-radius: 20px;
            transition: all 0.3s ease;
            border: 1px solid rgba(43, 108, 176, 0.1);
            position: relative;
        }

        .statement-box:hover {
            transform: translateY(-5px);
            box-shadow:
                0 20px 40px rgba(43, 108, 176, 0.1),
                0 1px 5px rgba(0, 0, 0, 0.05);
            background: rgba(255, 255, 255, 0.9);
        }

        .statement-icon {
            margin-bottom: 20px;
            background: rgba(43, 108, 176, 0.1);
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .statement-box:hover .statement-icon {
            background: #2B6CB0;
        }

        .statement-box:hover .statement-icon svg path {
            fill: white;
        }

        .statement-title {
            color: #2B6CB0;
            font-size: 1.75rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .title-underline {
            width: 40px;
            height: 3px;
            background: #2B6CB0;
            margin-bottom: 20px;
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .statement-box:hover .title-underline {
            width: 60px;
        }

        .statement-text {
            color: #4A5568;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        @media (max-width: 968px) {
            .mission-vision-container {
                grid-template-columns: 1fr;
            }

            .image-container {
                aspect-ratio: 16/9;
            }
        }

        @media (max-width: 768px) {
            .mission-vision-section {
                padding: 60px 0;
            }

            .mission-vision-card {
                padding: 30px;
            }

            .statement-title {
                font-size: 1.5rem;
            }

            .statement-text {
                font-size: 1rem;
            }

            .circle-1 {
                width: 150px;
                height: 150px;
            }

            .circle-2 {
                width: 100px;
                height: 100px;
            }
        }

        @media (max-width: 480px) {
            .mission-vision-section {
                padding: 40px 0;
            }

            .mission-vision-card {
                padding: 20px;
            }

            .mission-vision-container {
                gap: 20px;
            }

            .image-caption {
                bottom: 10px;
                left: 10px;
                padding: 8px 15px;
            }

            .statement-box {
                padding: 20px;
            }

            .statement-icon {
                width: 40px;
                height: 40px;
            }

            .statement-title {
                font-size: 1.25rem;
            }
        }

        /* FAQ Section */
        .faq-section {
            padding: 80px 0;
            background: #f8fafc;
            margin-top: -70px;
        }

        .faq-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .faq-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .faq-title {
            font-size: 2.5rem;
            color: #2B6CB0; /* Change from #1a202c to match the blue color */
            margin-bottom: 20px;
            font-weight: 700;
        }

        .faq-description {
            color: #4a5568;
            font-size: 1.1rem;
            line-height: 1.6;
            max-width: 700px;
            margin: 0 auto;
        }

        .faq-content {
            display: flex;
            gap: 40px;
            align-items: flex-start;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow:
                0 10px 30px rgba(43, 108, 176, 0.1),
                0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .questions-list {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .faq-question {
            background: white;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .question-content {
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .question-text {
            color: #2d3748;
            font-weight: 500;
            font-size: 1.1rem;
        }

        .question-icon {
            color: #2B6CB0;
            transition: transform 0.3s ease;
        }

        .faq-question.active .question-icon {
            transform: rotate(45deg);
        }

        .faq-question:hover {
            background: #f7fafc;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(43, 108, 176, 0.1);
        }

        .faq-question.active {
            background: #f7fafc;
            border-color: #2B6CB0;
        }

        .answer-container {
            flex: 1;
            background: #2B6CB0;
            border-radius: 16px;
            padding: 30px;
            color: white;
            position: sticky;
            top: 40px;
        }

        .faq-answer {
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .faq-answer.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .answer-content {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .contact-button-wrapper {
            margin-top: 30px;
            text-align: center;
        }

        .contact-button {
            display: inline-block;
            background: white;
            color: #2B6CB0;
            padding: 12px 32px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .contact-button:hover {
            background: transparent;
            color: white;
            border-color: white;
            transform: translateY(-2px);
        }

        @media (max-width: 968px) {
            .faq-content {
                flex-direction: column;
            }

            .answer-container {
                position: static;
                margin-top: 20px;
            }
        }

        @media (max-width: 768px) {
            .faq-section {
                padding: 60px 0;
            }

            .faq-title {
                font-size: 2rem;
            }

            .faq-description {
                font-size: 1rem;
            }

            .question-text {
                font-size: 1rem;
            }

            .answer-content {
                font-size: 1rem;
            }
        }

        /* Add smooth scrolling for better UX */
        html {
            scroll-behavior: smooth;
        }

        /* Add hover effect for the about content */
        .about-content:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        /* Add text selection styling */
        ::selection {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        @media (max-width: 768px) {
            .about-hero {
                min-height: 250px;
                padding: 30px 0;
            }

            .main-title {
                font-size: 2rem;
                padding: 0 15px;
            }

            .about-content {
                padding: 0.75rem 2rem;
                margin: 0 15px;
            }

            .about-text {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .about-hero {
                min-height: 200px;
                padding: 25px 0;
            }

            .main-title {
                font-size: 1.75rem;
            }

            .about-content {
                padding: 0.5rem 1.5rem;
            }

            .about-text {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .about-hero {
                min-height: 350px;
                padding: 40px 0;
            }

            .main-title {
                font-size: 2rem;
            }

            .about-content {
                padding: 1rem 2rem;
            }

            .about-text {
                font-size: 1.75rem;
            }
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
                margin-bottom: 100px;
                /* Adjusted for mobile */
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
    <?php include APP_DIR . 'views/templates/nav.php'; ?>

    <div class="about-hero">
        <div class="container">
            <h1 class="main-title">Get to Know the Biggest Job Platform for IT Professionals</h1>
            <div class="about-content">
                <p class="about-text">About Us</p>
            </div>
        </div>
    </div>

    <section class="intro-section">
        <div class="container">
            <div class="intro-card">
                <div class="decorative-circles">
                    <span class="circle circle-1"></span>
                    <span class="circle circle-2"></span>
                    <span class="circle circle-3"></span>
                </div>
                <div class="intro-content">
                    <div class="blue-line">
                        <div class="line-dot top"></div>
                        <div class="line-dot bottom"></div>
                    </div>
                    <div class="quote-container">
                        <div class="quote-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                <path d="M10 11H6.5C4.567 11 3 9.433 3 7.5S4.567 4 6.5 4H7c.827 0 1.5-.673 1.5-1.5S7.827 1 7 1H6.5C2.916 1 0 3.916 0 7.5S2.916 14 6.5 14H10v-3zm11 0h-3.5C15.567 11 14 9.433 14 7.5S15.567 4 17.5 4H18c.827 0 1.5-.673 1.5-1.5S18.827 1 18 1h-.5C13.916 1 11 3.916 11 7.5s2.916 6.5 6.5 6.5H21v-3z" fill="#2B6CB0" />
                            </svg>
                        </div>
                        <p class="intro-text">
                            CareerConnect was founded by a team of IT professionals who recognized the challenges of finding meaningful work in the fast-paced and ever-evolving tech industry. Having experienced firsthand the frustrations of mismatched opportunities, lack of visibility for skilled talent, and limited access to personalized career guidance, we decided to create a solution that bridges these gaps.
                        </p>
                        <div class="highlight-box">
                            <div class="highlight-icon">💡</div>
                            <p class="highlight-text">Bridging the gap between talent and opportunity</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mission-vision-section">
        <div class="container">
            <div class="mission-vision-card">
                <div class="decorative-elements">
                    <div class="circle circle-1"></div>
                    <div class="circle circle-2"></div>
                    <div class="dot-pattern"></div>
                </div>

                <div class="mission-vision-container">
                    <div class="image-container">
                        <div class="image-overlay"></div>
                        <img src="\public\images\IT-Professionals-at-work.jpg" alt="IT Professionals at work">
                        <div class="image-caption">
                            <span class="caption-icon">🚀</span>
                            <span class="caption-text">Empowering IT Professionals</span>
                        </div>
                    </div>

                    <div class="statements-container">
                        <div class="statement-box vision-box">
                            <div class="statement-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 4c4.97 0 9 4.03 9 9s-4.03 9-9 9-9-4.03-9-9 4.03-9 9-9zm0 2c-3.87 0-7 3.13-7 7s3.13 7 7 7 7-3.13 7-7-3.13-7-7-7zm0 2c2.76 0 5 2.24 5 5s-2.24 5-5 5-5-2.24-5-5 2.24-5 5-5z" fill="#2B6CB0" />
                                </svg>
                            </div>
                            <h2 class="statement-title">Our Vision</h2>
                            <div class="title-underline"></div>
                            <p class="statement-text">
                                We aim to become the leading career hub for IT professionals, empowering innovation and growth in the tech industry worldwide.
                            </p>
                        </div>

                        <div class="statement-box mission-box">
                            <div class="statement-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 2L1 12h3v9h6v-6h4v6h6v-9h3L12 2zm0 2.7L19.3 11H18v8h-4v-6H8v6H4v-8H2.7L12 4.7z" fill="#2B6CB0" />
                                </svg>
                            </div>
                            <h2 class="statement-title">Our Mission</h2>
                            <div class="title-underline"></div>
                            <p class="statement-text">
                                Our mission is to bridge the gap between skilled IT professionals and forward-thinking companies by providing a reliable platform for career advancement and talent acquisition.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-section">
        <div class="faq-container">
            <div class="faq-header">
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <p class="faq-description">Get answers to commonly asked questions about our services, features, and how to make the most of our powerful solutions.</p>
            </div>

            <div class="faq-content">
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

                    foreach ($faqs as $index => $faq): ?>
                        <div class="faq-question <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                            <div class="question-content">
                                <span class="question-text"><?php echo $faq['question']; ?></span>
                                <span class="question-icon">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="answer-container">
                    <?php foreach ($faqs as $index => $faq): ?>
                        <div class="faq-answer <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                            <div class="answer-content">
                                <?php echo $faq['answer']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="contact-button-wrapper">
                        <a href="/contact" class="contact-button">Contact Us</a>
                    </div>
                </div>
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
    <?php include APP_DIR . 'views/templates/footer.php'; ?>

</body>

</html>