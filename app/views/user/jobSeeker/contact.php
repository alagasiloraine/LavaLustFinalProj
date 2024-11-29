<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            color: #333;
        }

        .contact-hero {
            background: linear-gradient(135deg, #2B6CB0 0%, #1A365D 100%);
            min-height: 200px;
            padding: 60px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .contact-hero h1 {
            color: white;
            font-size: 48px;
            margin-bottom: 20px;
        }

        .support-section {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
            text-align: center;
        }

        .support-section h2 {
            font-size: 42px;
            margin-bottom: 20px;
        }

        .support-section p {
            font-size: 20px;
            color: #666;
            margin-bottom: 40px;
            max-width: 800px;
            margin: 0 auto 40px;
        }

        .help-text {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 40px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .contact-form {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 40px;
            align-items: start;
        }

        .topic-section {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, #2B6CB0 0%, #1A365D 100%);

        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 16px;
            color: white;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-color: #fff;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M8 11l-7-7h14l-7 7z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 40px;
        }

        .hidden-fields {
            display: none;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, #2B6CB0 0%, #1A365D 100%);

        }

        .hidden-fields.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        .name-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            padding: 12px 24px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background: #2980b9;
        }

        .error-message {
            color: #ff0000;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .form-control.error {
            border-color: #ff0000;
        }
            /* Add these new styles */
    .contact-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin: 40px 0;
    }

    .contact-card {
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        text-align: left;
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .contact-card:nth-child(1) {
        background: #B7CDDB;
        color: white;
    }

    .contact-card:nth-child(2) {
        background: #B7CDDB;
    }

    .contact-card:nth-child(3) {
        background: #B7CDDB;
    }

    .contact-card:hover {
        transform: translateY(-5px);
    }

    .contact-card-icon {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .contact-card-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .contact-card-text {
        font-size: 14px;
        line-height: 1.5;
        opacity: 0.8;
    }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @media (max-width: 768px) {
            .form-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .name-row {
                grid-template-columns: 1fr;
            }

            .contact-hero h1 {
                font-size: 36px;
            }

            .support-section h2 {
                font-size: 32px;
            }

            .support-section p {
                font-size: 18px;
            }
            .contact-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include APP_DIR.'views/templates/nav.php'; ?>
    
    <div class="contact-hero">
        <h1>Contact Us</h1>
    </div>

    <div class="support-section">
        <h2>Friendly humans, ready to help</h2>
        <p>Get help and questions answered by our friendly support team.</p>
        
        <div class="contact-cards">
            <div class="contact-card">
                <div class="contact-card-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="contact-card-title">+63 945 687 1354</div>
                <div class="contact-card-text">
                    Need a quick call? Shoot us an phone call for more clarity.
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-card-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="contact-card-title">carrerconnect@gmail.com</div>
                <div class="contact-card-text">
                    Shy to call us? Send as an email to answer your questions.
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-card-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="contact-card-title">Oriental Mindoro, Philippines</div>
                <div class="contact-card-text">
                    Want to talk in person? Visit us to our office .
                </div>
            </div>
        </div>

        <form class="contact-form" method="POST" action="<?php echo site_url('contact/submit'); ?>" id="contactForm">
            <div class="form-container">
                <div class="topic-section">
                    <div class="form-group">
                        <label for="helpTopic">What do you need help with?</label>
                        <select class="form-control" name="help_topic" id="helpTopic" required>
                            <option value="">Please select one...</option>
                            <option value="job_posting">How to Add Job</option>
                            <option value="account">Account Issues</option>
                            <option value="technical">Technical Support</option>
                            <option value="billing">Billing Questions</option>
                            <option value="other">Other</option>
                        </select>
                        <div class="error-message" id="helpTopicError">Please select a topic</div>
                    </div>
                </div>

                <div class="hidden-fields" id="contactFields">
                    <div class="name-row">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="firstName" required>
                            <div class="error-message" id="firstNameError">First name is required</div>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="lastName" required>
                            <div class="error-message" id="lastNameError">Last name is required</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                        <div class="error-message" id="emailError">Valid email is required</div>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" name="message" id="message" required></textarea>
                        <div class="error-message" id="messageError">Message is required</div>
                    </div>

                    <button type="submit" class="submit-btn">Send message</button>
                </div>
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

    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        if (validateForm()) {
            this.submit();
        }
    });

    function validateForm() {
        let isValid = true;
        const fields = ['helpTopic', 'firstName', 'lastName', 'email', 'message'];

        fields.forEach(field => {
            const input = document.getElementById(field);
            const error = document.getElementById(field + 'Error');
            
            if (!input.value.trim()) {
                input.classList.add('error');
                error.style.display = 'block';
                isValid = false;
            } else {
                input.classList.remove('error');
                error.style.display = 'none';
            }
        });

        // Additional email validation
        const email = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        if (email.value.trim() && !isValidEmail(email.value)) {
            email.classList.add('error');
            emailError.textContent = 'Please enter a valid email address';
            emailError.style.display = 'block';
            isValid = false;
        }

        return isValid;
    }

    function isValidEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    </script>

<?php include APP_DIR.'views/templates/footer.php'; ?>

</body>
</html>