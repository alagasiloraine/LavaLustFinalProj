<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            line-height: 1.6;
            color: #333;
        }

        /* Hero Section */
        .contact-hero {
            background: linear-gradient(135deg, #2B2F8E 0%, #171C8F 100%);
            padding: 80px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .contact-hero h1 {
            color: white;
            font-size: 48px;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .wave-decoration {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40px;
            background: url('/public/images/wave.svg') repeat-x;
            opacity: 0.1;
        }

        /* Support Section */
        .support-section {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
            text-align: center;
        }

        .support-section h2 {
            font-size: 42px;
            color: #333;
            margin-bottom: 20px;
        }

        .support-section p {
            font-size: 20px;
            color: #666;
            margin-bottom: 40px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .help-text {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 40px;
        }

        .help-text a {
            color: #007bff;
            text-decoration: none;
        }

        /* Form Styles */
        .contact-form {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .required-label {
            background: #ffd700;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            margin-left: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M8 11l-7-7h14l-7 7z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 40px;
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: #ffd700;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background: #ffcd00;
        }

        /* Hidden Form Fields */
        .hidden-fields {
            display: none;
        }

        .hidden-fields.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-hero h1 {
                font-size: 36px;
            }

            .support-section h2 {
                font-size: 32px;
            }

            .support-section p {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <?php 
        include APP_DIR.'views/templates/nav.php'; 
    ?>
    <div class="contact-hero">
        <h1>Contact Us</h1>
        <div class="wave-decoration"></div>
    </div>

    <div class="support-section">
        <h2>Friendly humans, ready to help</h2>
        <p>Get help and questions answered by our friendly support team.</p>
        
        <div class="help-text">
            <p>For pre-sales questions, existing customers who need help, or other inquiries, 
            contact us and we'll typically get back to you in less than 24 hours.</p>
            <p>Send us a message to get help.</p>
        </div>

        <form class="contact-form" method="POST" action="<?php echo site_url('contact/submit'); ?>">
            <div class="form-group">
                <label>
                    What do you need help with?
                    <span class="required-label">Required</span>
                </label>
                <select class="form-control" name="help_topic" id="helpTopic" required>
                    <option value="">Please select one...</option>
                    <option value="job_posting">How to Add Job</option>
                    <option value="account">Account Issues</option>
                    <option value="technical">Technical Support</option>
                    <option value="billing">Billing Questions</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="hidden-fields" id="contactFields">
                <div class="form-group">
                    <label>
                        Your Name
                        <span class="required-label">Required</span>
                    </label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group">
                    <label>
                        Your Email Address
                        <span class="required-label">Required</span>
                    </label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label>
                        Your Message
                        <span class="required-label">Required</span>
                    </label>
                    <textarea class="form-control" name="message" required></textarea>
                </div>

                <button type="submit" class="submit-btn">Send message</button>
            </div>
        </form>
    </div>

    <script>
    document.getElementById('helpTopic').addEventListener('change', function() {
        const contactFields = document.getElementById('contactFields');
        if (this.value) {
            contactFields.classList.add('active');
        } else {
            contactFields.classList.remove('active');
        }
    });
    </script>

</body>
</html>