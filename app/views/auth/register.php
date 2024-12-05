
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CareerConnect</title>
    <link rel="icon" type="image/png" href="<?= base_url(); ?>public/img/favicon.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            width: 900px;
            max-width: 100%;
            min-height: 550px;
            display: flex;
            margin: 2rem;
        }

        .form-container {
            flex: 1;
            padding: 40px;
        }

        .info-container {
            background: linear-gradient(to right, #305586, #003479);
            color: #fff;
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 0 30px 30px 0;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #003479;
        }

        .form-description {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-size: 14px;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .input-with-icon input,
        .input-with-icon select {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background-color: #f5f5f5;
            transition: border-color 0.3s;
        }

        .input-with-icon input:focus,
        .input-with-icon select:focus {
            border-color: #003479;
            outline: none;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #003479;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #002456;
        }

        .info-container img {
            width: 150px;
            margin-bottom: 20px;
        }

        .info-container h2 {
            margin-bottom: 20px;
        }

        .info-container p {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .sign-in-btn {
            background-color: transparent;
            color: #ffffff !important; /* Updated line for white text */
            font-size: 14px;
            padding: 12px 45px;
            border: 1px solid #fff;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .sign-in-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .info-container {
                border-radius: 0 0 30px 30px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Create Account</h1>
            <p class="form-description">Join CareerConnect to explore exciting IT career opportunities</p>

            <?php flash_alert(); ?>
            <form id="regForm" method="POST" action="<?= site_url('auth/register'); ?>">
                <?php csrf_field(); ?>

                <div class="input-group">
                    <label for="username">Username</label>
                    <div class="input-with-icon">
                        <i class="fa-regular fa-user"></i>
                        <input id="username" type="text" name="username" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="email">Email Address</label>
                    <div class="input-with-icon">
                        <i class="fa-regular fa-envelope"></i>
                        <input id="email" type="email" name="email" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="role">Role</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-user-tie"></i>
                        <select id="role" name="role" required>
                            <option value="">Select Role</option>
                            <option value="jobseeker">Job Seeker</option>
                            <option value="employer">Employer</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-lock"></i>
                        <input id="password" type="password" name="password" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-lock"></i>
                        <input id="password_confirmation" type="password" name="password_confirmation" required>
                    </div>
                </div>

                <button type="submit">Register</button>
            </form>
        </div>

        <div class="info-container">
            <img src="<?= base_url(); ?>public/images/imagelogo1.png" alt="CareerConnect Logo">
            <h2>CareerConnect</h2>
            <p>This website is the ultimate job portal for IT graduates and professionals, linking you with top tech employers and exciting career opportunities in the IT fields.</p>
            <a href="<?= site_url('auth/login'); ?>" class="sign-in-btn">SIGN IN</a>
        </div>
    </div>

    <!-- Keep the original scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            var regForm = $("#regForm")
            if (regForm.length) {
                regForm.validate({
                    rules: {
                        email: {
                            required: true,
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        password_confirmation: {
                            required: true,
                            minlength: 8
                        },
                        username: {
                            required: true,
                            minlength: 5,
                            maxlength: 20
                        },
                        role: {
                            required: true,
                        }
                    },
                    messages: {
                        email: {
                            required: "Please input your email address.",
                        },
                        password: {
                            required: "Please input your password",
                            minlength: jQuery.validator.format("Password must be atleast {0} characters.")
                        },
                        password_confirmation: {
                            required: "Please input your password",
                            minlength: jQuery.validator.format("Password must be atleast {0} characters.")
                        },
                        username: {
                            required: "Please input your username.",
                        },
                        role: {
                            required: "Please select your role.",
                        }
                    },
                })
            }
        })
    </script>
</body>

</html>