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


/* Updated Testimonials Section Styling */
.testimonials-section {
    padding: 80px 20px;
    position: relative;
    margin-top: -20px;
}

.testimonials-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.testimonials-header {
    text-align: center;
    margin-bottom: 60px;
}

.testimonials-title {
    font-size: 2.2rem;
    color: #2B6CB0;
    font-weight: 700;
    position: relative;
    display: inline-block;
    padding-bottom: 15px;
}

.testimonials-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80%;
    height: 3px;
    background: linear-gradient(90deg, #2B6CB0, #63B3ED, #2B6CB0);
    border-radius: 2px;
}

/* Remove navigation arrows */
.carousel-navigation {
    display: none;
}

/* Updated testimonials track for better alignment */
.testimonials-track {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin: 0 auto;
    width: 100%;
}

.testimonial-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 35px;
    position: relative;
    transition: all 0.4s ease;
    box-shadow: 0 10px 30px rgba(43, 108, 176, 0.1);
    display: flex;
    flex-direction: column;
    height: 100%;
}

/* Enhanced card hover effects */
.testimonial-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(43, 108, 176, 0.15);
}

/* Top accent line */
.testimonial-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #2B6CB0, #63B3ED);
    border-radius: 20px 20px 0 0;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.testimonial-card:hover::before {
    opacity: 1;
}

/* Enhanced header styling */
.testimonial-header {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    position: relative;
}

.testimonial-image {
    width: 70px;
    height: 70px;
    border-radius: 15px;
    object-fit: cover;
    margin-right: 20px;
    border: 3px solid #2B6CB0;
    padding: 3px;
    background: white;
    transition: all 0.3s ease;
}

.testimonial-card:hover .testimonial-image {
    border-color: #63B3ED;
    transform: scale(1.05);
}

.testimonial-info h4 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1a202c;
    margin: 0 0 5px 0;
}

.testimonial-info p {
    font-size: 0.9rem;
    color: #64748b;
    margin: 0;
}

/* Enhanced testimonial text */
.testimonial-text {
    font-size: 1rem;
    line-height: 1.8;
    color: #475569;
    margin-bottom: 25px;
    position: relative;
    padding-left: 24px;
    flex-grow: 1;
}

.testimonial-text::before {
    content: '"';
    position: absolute;
    left: 0;
    top: -5px;
    font-size: 3rem;
    line-height: 1;
    color: #2B6CB0;
    opacity: 0.2;
    font-family: serif;
}

/* Enhanced learn more link */
.learn-more {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: #2B6CB0;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    margin-top: auto;
    padding: 8px 0;
    width: 100%; /* Make the link take full width */
    text-align: center; /* Center the text */
}

.learn-more:hover {
    color: #1a365d;
    gap: 12px;
}

/* Center the arrow icon */
.learn-more svg {
    display: inline-block;
    vertical-align: middle;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .testimonials-track {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .testimonials-track {
        grid-template-columns: 1fr;
    }

    .testimonial-card {
        padding: 25px;
    }

    .testimonial-image {
        width: 60px;
        height: 60px;
    }
}

        /* General Section Styling */
        section {
            padding: 50px 20px;
            text-align: center;
            background-color: #f9f9f9;
            margin-bottom: 20px;
        }

        .about-section {
            padding: 80px 20px;
            background-color: #f5f5f5;
            position: relative;
            margin-top: -20px;
        }

        .about-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .about-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .subtitle {
            display: inline-block;
            font-size: 0.9rem;
            color: #2B6CB0;
            background: rgba(43, 108, 176, 0.1);
            padding: 6px 16px;
            border-radius: 20px;
            margin-bottom: 15px;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .about-header h2 {
            font-size: 2.2rem;
            color: #2B6CB0;
            font-weight: 700;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }

        .accent-line {
            width: 300px;
            height: 3px;
            background: linear-gradient(90deg, #2B6CB0, #63B3ED, #2B6CB0);
            margin: 0 auto;
            border-radius: 2px;
            background-size: 200% 100%;
            animation: moveGradient 3s linear infinite;
        }

        @keyframes moveGradient {
            0% {
                background-position: 100% 0;
            }
            100% {
                background-position: -100% 0;
            }
        }

        .about-content {
            max-width: 1200px;
            margin: 0 auto 60px;
        }

        .about-text-wrapper {
            position: relative;
            background: #ffffff;
            padding: 40px 60px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(43, 108, 176, 0.08);
            transition: all 0.4s ease;
            overflow: hidden;
            display: flex;
            gap: 30px;
        }

        .about-text-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(43, 108, 176, 0.12);
        }

        .accent-container {
            position: relative;
            width: 8px;
            margin-right: 20px;
        }

        .accent-line-left {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, #2B6CB0, #63B3ED);
            border-radius: 4px;
        }

        .accent-dots {
            position: absolute;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
            width: 24px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            padding: 20px 0;
        }

        .accent-dots::before,
        .accent-dots::after {
            content: '';
            width: 8px;
            height: 8px;
            background: #ffffff;
            border-radius: 50%;
            margin-left: 8px;
            box-shadow: 0 0 0 2px rgba(43, 108, 176, 0.3);
        }

        .content-area {
            position: relative;
            flex: 1;
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            padding: 30px;
            border-radius: 15px;
        }

        .quote-icon {
            position: absolute;
            top: -20px;
            left: -10px;
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #2B6CB0, #63B3ED);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(43, 108, 176, 0.2);
            transform: rotate(-10deg);
            transition: transform 0.3s ease;
        }

        .about-text-wrapper:hover .quote-icon {
            transform: rotate(0deg) scale(1.1);
        }

        .content-area p {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #4A5568;
            margin: 0;
            position: relative;
            z-index: 1;
            text-align: justify;
        }

        .decorative-element {
            position: absolute;
            bottom: -10px;
            right: -10px;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, transparent 50%, rgba(43, 108, 176, 0.1) 50%);
            border-radius: 0 0 15px 0;
            opacity: 0.5;
        }

        .content-area::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(#2B6CB0 1px, transparent 1px),
                radial-gradient(#2B6CB0 1px, transparent 1px);
            background-size: 50px 50px;
            background-position: 0 0, 25px 25px;
            opacity: 0.03;
            pointer-events: none;
        }

        .features-container {
            max-width: 1200px; /* Increased from 1000px */
            margin: 0 auto;
            padding: 0 20px;
        }

        .about-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 40px;
        }

        .feature-card {
            width: 100%;
            max-width: 380px; /* Increased from 320px */
            margin: 0 auto;
            position: relative;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(43, 108, 176, 0.1);
            overflow: hidden;
        }

        .card-border {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #2B6CB0, #63B3ED);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(43, 108, 176, 0.1);
        }

        .feature-card:hover .card-border {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, rgba(43, 108, 176, 0.1), rgba(99, 179, 237, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1);
        }

        .feature-icon i {
            font-size: 1.5rem;
            color: #2B6CB0;
            transition: color 0.3s ease;
        }

        .feature-card:hover .feature-icon i {
            color: #63B3ED;
        }

        .feature-card h3 {
            font-size: 1.2rem;
            color: #2D3748;
            margin: 0 0 12px;
            font-weight: 600;
        }

        .feature-description {
            font-size: 0.95rem;
            color: #718096;
            margin: 0;
            line-height: 1.6;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.98);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .about-text-wrapper {
            animation: fadeInScale 0.5s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .feature-card {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .feature-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .feature-card:nth-child(3) {
            animation-delay: 0.4s;
        }

        @media (max-width: 1200px) {
            .feature-card {
                max-width: 340px; /* Increased from 280px */
            }
        }

        @media (max-width: 768px) {
            .about-container {
                padding: 0 15px;
            }

            .about-text-wrapper {
                padding: 30px;
                flex-direction: column;
            }

            .accent-container {
                width: 100%;
                height: 6px;
                margin-bottom: 20px;
            }

            .accent-line-left {
                width: 100%;
                height: 6px;
            }

            .accent-dots {
                flex-direction: row;
                width: 100%;
                height: 24px;
                padding: 0 20px;
            }

            .content-area {
                padding: 20px;
            }

            .quote-icon {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }

            .content-area p {
                font-size: 1rem;
                line-height: 1.7;
            }

            .about-features {
                grid-template-columns: 1fr;
            }
            
            .feature-card {
                max-width: 100%;
            }
        }

        /* Stats Section Styling */
        .stats-section {
        position: relative;
        background: linear-gradient(135deg, #2B6CB0 0%, #1A365D 100%); /* Changed to match hero section blue gradient */
        padding: 3rem 1.5rem;
        overflow: hidden;
        min-height: 300px;
        border-radius: 24px;
        margin: 2rem auto;
        width: 90%;
        max-width: 1200px;
    }

    .stats-background {
        position: absolute;
        inset: 0;
        overflow: hidden;
    }

    .gradient-sphere {
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.1) 0%, rgba(43, 108, 176, 0) 70%);
        top: -300px;
        right: -200px;
        border-radius: 50%;
        filter: blur(40px);
        animation: float 8s ease-in-out infinite;
    }

    .grid-pattern {
        position: absolute;
        inset: 0;
        background-image: linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                        linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.3;
    }

    .stats-container {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        max-width: 1100px;
        margin: 0 auto;
    }

    .stat-card {
        position: relative;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 16px;
        padding: 1.5rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card-glass {
        position: absolute;
        inset: 0;
        background: linear-gradient(145deg, 
            rgba(255, 255, 255, 0.05) 0%, 
            rgba(255, 255, 255, 0.02) 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: inherit;
    }

    .stat-content {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center; /* Center all content */
        text-align: center; /* Center text */
    }

    .stat-icon-container {
        position: relative;
        width: 48px;
        height: 48px;
        margin: 0 auto 1.25rem; /* Center horizontally and keep bottom margin */
    }

    .stat-icon-bg {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border-radius: 12px;
        transform: rotate(-5deg);
        transition: transform 0.3s ease;
    }

    .stat-icon {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        border-radius: 12px;
        font-size: 1.25rem;
        color: #fff;
    }

    .pulse-ring {
        position: absolute;
        inset: -4px;
        border: 2px solid rgba(59, 130, 246, 0.5);
        border-radius: 14px;
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .stat-details {
        margin-bottom: 1rem;
        width: 100%; /* Ensure full width for proper centering */
        display: flex;
        flex-direction: column;
        align-items: center; /* Center the details */
    }

    .stat-number {
        display: flex;
        align-items: baseline;
        justify-content: center; /* Center the number and plus sign */
        gap: 2px;
        margin-bottom: 0.25rem;
    }

    .number {
        font-size: 1.5rem;
        font-weight: 600;
        background: linear-gradient(to right, #fff, #94a3b8);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        -webkit-text-fill-color: transparent;
        letter-spacing: -0.5px;
    }

    .plus {
        font-size: 1rem;
        color: #60a5fa;
        font-weight: 500;
    }

    .stat-label {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.6);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: center; /* Ensure label is centered */
    }

    .stat-progress {
        width: 100%; /* Ensure progress bar spans full width */
        height: 3px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 2px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #3b82f6, #60a5fa);
        width: 0;
        border-radius: 2px;
        animation: progress 1.5s ease-out forwards;
    }

    /* Hover Effects */
    .stat-card:hover {
        transform: translateY(-3px);
    }

    .stat-card:hover .stat-icon-bg {
        transform: rotate(0deg) scale(1.05);
    }

    .stat-card:hover .progress-bar {
        animation: progress-hover 0.6s ease-out forwards;
    }

    /* Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.1); opacity: 0.5; }
        100% { transform: scale(1); opacity: 1; }
    }

    @keyframes progress {
        from { width: 0; }
        to { width: 85%; }
    }

    @keyframes progress-hover {
        from { width: 85%; }
        to { width: 100%; }
    }

    /* Reveal Animation */
    .stat-card {
        opacity: 0;
        animation: reveal 0.5s ease forwards;
    }

    .stat-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .stat-card:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes reveal {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .stats-section {
            padding: 2rem 1rem;
        }
        
        .stat-card {
            padding: 1.25rem;
        }
        
        .number {
            font-size: 1.25rem;
        }
        
        .plus {
            font-size: 0.875rem;
        }
        
        .stat-icon-container {
            width: 40px;
            height: 40px;
        }
        
        .stat-icon {
            font-size: 1rem;
        }
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
                    <?php if ($user['role'] === 'employer'): ?>
                        <a href="<?= site_url('jobs') ?>" class="btn btn-primary">Post a Job</a>
                    <?php else: ?>
                        <a href="<?= site_url('jobs') ?>" class="btn btn-primary">Find a Job</a>
                    <?php endif; ?>
                    <a href="<?= site_url('contact') ?>" class="btn btn-secondary">Contact Us</a>
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
        <div class="about-header">
            <span class="subtitle">Discover Our Mission</span>
            <h2>About CareerConnect</h2>
            <div class="accent-line"></div>
        </div>
        
        <div class="about-content">
            <div class="about-text-wrapper">
                <div class="accent-container">
                    <div class="accent-line-left"></div>
                    <div class="accent-dots"></div>
                </div>
                <div class="content-area">
                    <div class="quote-icon">
                        <i class="fas fa-quote-right"></i>
                    </div>
                    <p>CareerConnect is a premier platform designed to bridge the gap between skilled IT professionals and forward-thinking companies. Founded with the vision of transforming the recruitment process in the tech industry, CareerConnect leverages cutting-edge tools to connect talent with opportunities. Whether you are an aspiring developer, a seasoned IT expert, or a company searching for the perfect fit, CareerConnect is your trusted partner in building meaningful and successful careers.</p>
                    <div class="decorative-element"></div>
                </div>
            </div>
        </div>

            <div class="features-container">
            <div class="connecting-dot left"></div>
            <div class="connecting-dot right"></div>
                <div class="about-features">
                    <div class="feature-card">
                        <div class="card-border"></div>
                        <div class="feature-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3>Trusted Partnerships</h3>
                        <p class="feature-description">Building lasting relationships between top talent and industry leaders</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="card-border"></div>
                        <div class="feature-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3>Career Growth</h3>
                        <p class="feature-description">Accelerating professional development in the tech industry</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="card-border"></div>
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Industry Leaders</h3>
                        <p class="feature-description">Connecting with forward-thinking companies shaping the future</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
    <div class="stats-background">
        <div class="gradient-sphere"></div>
        <div class="grid-pattern"></div>
    </div>
    <div class="stats-container">
        <div class="stat-card">
            <div class="card-glass"></div>
            <div class="stat-content">
                <div class="stat-icon-container">
                    <div class="stat-icon-bg"></div>
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="pulse-ring"></div>
                </div>
                <div class="stat-details">
                    <div class="stat-number">
                        <span class="number">10,000</span>
                        <span class="plus">+</span>
                    </div>
                    <span class="stat-label">Jobs Posted</span>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar"></div>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="card-glass"></div>
            <div class="stat-content">
                <div class="stat-icon-container">
                    <div class="stat-icon-bg"></div>
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="pulse-ring"></div>
                </div>
                <div class="stat-details">
                    <div class="stat-number">
                        <span class="number">500</span>
                        <span class="plus">+</span>
                    </div>
                    <span class="stat-label">Partner Companies</span>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar"></div>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="card-glass"></div>
            <div class="stat-content">
                <div class="stat-icon-container">
                    <div class="stat-icon-bg"></div>
                    <div class="stat-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="pulse-ring"></div>
                </div>
                <div class="stat-details">
                    <div class="stat-number">
                        <span class="number">2,000</span>
                        <span class="plus">+</span>
                    </div>
                    <span class="stat-label">Successful Placements</span>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar"></div>
                </div>
            </div>
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
                            'image' => '/public/images/profile1.jpg',
                            'text' => 'Their team took our wellness brand and elevated it to new heights with their thoughtful designs and strategic branding, they\'ve helped us create a cohesive and compelling brand identity.'
                        ],
                        [
                            'name' => 'Job Ghadzi',
                            'position' => 'CEO Glow Co.',
                            'image' => '/public/images/profile2.jpg',
                            'text' => 'In the fast-paced world of tech, it\'s crucial to have a creative partner who can keep up with our innovative ideas. They transformed our marketing campaigns with their fresh perspective.'
                        ],
                        [
                            'name' => 'Thomas Gala',
                            'position' => 'Founder ZenTech Wellness',
                            'image' => '/public/images/profile3.jpg',
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