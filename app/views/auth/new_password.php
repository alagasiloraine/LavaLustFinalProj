<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password - CareerConnect</title>
    <link rel="icon" type="image/png" href="<?=base_url();?>public/img/favicon.ico"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #003479;
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

        .input-with-icon input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background-color: #f5f5f5;
            transition: border-color 0.3s;
        }

        .input-with-icon input:focus {
            border-color: #003479;
            outline: none;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .primary-button {
            padding: 12px 24px;
            background-color: #003479;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .primary-button:hover {
            background-color: #002456;
        }

        .secondary-button {
            padding: 12px 24px;
            background-color: transparent;
            color: #003479;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .secondary-button:hover {
            text-decoration: underline;
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

        .back-to-login {
            display: inline-block;
            padding: 12px 45px;
            background-color: transparent;
            border: 2px solid #fff;
            border-radius: 8px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            text-transform: uppercase;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .back-to-login:hover {
            background-color: #fff;
            color: #003479;
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
        <?php if (isset($_SESSION['success'])): ?>
                            <script>
                                toastr.success("<?php echo $_SESSION['success']; ?>", "Success");
                            </script>
                            <?php unset($_SESSION['success']); ?>
                        <?php elseif (isset($_SESSION['error'])): ?>
                            <script>
                                toastr.error("<?php echo $_SESSION['error']; ?>", "Error");
                            </script>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>
        <div class="form-container">
            <h1>Set New Password</h1>
            <p class="form-description">
                <i class="fa-solid fa-circle-info"></i>
                Password must be at least 8 characters and contains one of these special characters (!@£$%^&*-_+=?), number, uppercase and lowercase letters.
            </p>
            
            <?php flash_alert(); ?>
            <form id="myForm" action="<?=site_url('auth/set-new-password');?>" method="post">
                <?php csrf_field(); ?>
                <input type="hidden" name="token" value="<?php !empty($_GET['token']) && print $_GET['token'];?>">
                
                <div class="input-group">
                    <label for="password">New Password</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-lock"></i>
                        <input id="password" type="password" name="password" required placeholder="••••••••">
                    </div>
                </div>

                <div class="input-group">
                    <label for="re_password">Confirm New Password</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-lock"></i>
                        <input id="re_password" type="password" name="re_password" required placeholder="••••••••">
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="primary-button">Proceed</button>
                </div>
            </form>
        </div>
        
        <div class="info-container">
            <img src="<?=base_url();?>public/images/imagelogo1.png" alt="CareerConnect Logo">
            <h2>CareerConnect</h2>
            <p>This website is the ultimate job portal for IT graduates and professionals, linking you with top tech employers and exciting career opportunities in the IT fields.</p>
            <a href="<?=site_url('auth/login');?>" class="back-to-login">BACK TO LOGIN</a>
        </div>
    </div>

    <!-- Keep the original scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            var myForm = $("#myForm")
                if(myForm.length) {
                    myForm.validate({
                        rules: {
                            password: {
                                required: true,
                                minlength: 8
                            },
                            re_password: {
                                required: true,
                                minlength: 8
                            }
                        },
                        messages: {
                            password: {
                                required: "Please input your password",
                                minlength: jQuery.validator.format("Password must be atleast {0} characters.")
                            },
                            re_password: {
                                required: "Please input your password",
                                minlength: jQuery.validator.format("Password must be atleast {0} characters.")
                            }
                        },
                    })
                }
        })
    </script>
</body>
</html>
