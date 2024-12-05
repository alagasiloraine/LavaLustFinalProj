

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?=base_url();?>public/img/favicon.ico"/>
    <title>Login - CareerConnect</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 900px;
            max-width: 100%;
            min-height: 550px;
        }

        .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 15px 0;
        }

        .container span {
            font-size: 12px;
        }

        .container a {
            color: #333;
            font-size: 13px;
            text-decoration: none;
        }

        .container button {
            background-color: #003479;
            color: #fff;
            font-size: 14px;
            padding: 12px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .container button:hover {
            background-color: #002456;
        }

        .container form {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .input-group {
            width: 100%;
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }

        .input-with-icon {
            position: relative;
            width: 100%;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .input-with-icon input {
            background-color: #f5f5f5;
            border: 1px solid #eee;
            padding: 12px 15px 12px 45px;
            font-size: 14px;
            border-radius: 8px;
            width: 100%;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .input-with-icon input:focus {
            border-color: #003479;
        }

        .password-options {
            display: flex;
            justify-content: flex-end;
            margin-top: 5px;
        }

        .forgot-password {
            color: #666;
            font-size: 12px;
            text-decoration: none;
            margin-top: 15px;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .form-description {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            text-align: center;
            margin: 15px 0;
            max-width: 300px;
        }

        .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: all 0.7s ease-in-out;
            border-radius: 150px 0 0 100px;
            z-index: 1000;
        }

        .toggle {
            background-color: #003479;
            height: 100%;
            background: linear-gradient(to right, #305586, #003479);
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: all 0.7s ease-in-out;
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all 0.7s ease-in-out;
        }

        .toggle-right {
            right: 0;
            transform: translateX(0);
        }

        .toggle-logo {
            width: 250px;
            height: auto;
            margin-bottom: 20px;
        }

        .toggle-panel h1 {
            margin-bottom: 10px;
            font-size: 20px;
            font-weight: 600;
            margin-top: -50px;
        }

        .toggle-panel p {
            font-size: 13px;
            line-height: 1.6;
            margin: 10px auto;
            max-width: 100%;
            color: rgba(255, 255, 255, 0.9);
        }

        .terms-container {
            width: 100%;
            margin: 10px 0;
            padding: 0;
            max-width: 400px;
        }

        .terms-label {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 11px;
            color: #666;
            cursor: pointer;
        }

        .terms-label input[type="checkbox"] {
            width: 14px;
            height: 14px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .terms-label span {
            font-size: 10px;
            line-height: 1.4;
            color: #666;
            display: block;
            width: calc(100% - 24px);
            text-align: justify;
        }

        .sign-up-btn {
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

        .sign-up-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                min-height: 480px;
            }

            .toggle-container {
                display: none;
            }

            .sign-in {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form id="logForm" method="POST" action="<?=site_url('auth/login');?>">
                <?php csrf_field(); ?>
                <h1>Sign In</h1>
                <p class="form-description">Welcome back! Please sign in to access your CareerConnect account and explore opportunities.</p>
                
                <?php flash_alert(); ?>
                
                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-with-icon">
                        <i class="fa-regular fa-envelope"></i>
                        <?php $LAVA =& lava_instance(); ?>
                        <input type="email" id="email" name="email" placeholder="careerconnect@gmail.com" required autocomplete="email" autofocus class="<?=$LAVA->session->flashdata('is_invalid');?>">
                    </div>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo $LAVA->session->flashdata('err_message'); ?></strong>
                    </span>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="●●●●●●●●●●" required autocomplete="current-password" minlength="8">
                    </div>
                    <div class="password-options">
                        <a href="<?=site_url('auth/password-reset');?>" class="forgot-password">Forgot Your Password?</a>
                    </div>
                </div>

                <div class="terms-container">
                    <label class="terms-label">
                        <input type="checkbox" required>
                        <span>By checking this box, you agree to our Terms of Service, Privacy Policy, and to receive important account notifications.</span>
                    </label>
                </div>

                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <img src="<?=base_url();?>public/images/imagelogo1.png" alt="Logo" class="toggle-logo">
                    <h1>CareerConnect</h1>
                    <p>This website is the ultimate job portal for IT graduates and professionals, linking you with top tech employers and exciting career opportunities in the IT fields.</p>
                    <a href="<?=site_url('auth/register');?>" class="sign-up-btn">Sign Up</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            var logForm = $("#logForm")
                if(logForm.length) {
                    logForm.validate({
                        rules: {
                            email: {
                                required: true,
                            },
                            password: {
                                required: true,
                            }
                        },
                        messages: {
                            email: {
                                required: "Please input your email address.",                            
                            },
                            password: {
                                required: "Please input your password.",  
                            }
                        },
                    })
                }
        })
    </script>
</body>
</html>
