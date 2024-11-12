<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>CareerConnect</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Create Account</h1>
                <p class="form-description">Join CareerConnect to explore exciting IT career opportunities</p>
                
                <div class="input-group">
                    <label for="signup-name">Name</label>
                    <div class="input-with-icon">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" id="signup-name" placeholder="Full Name">
                    </div>
                </div>

                <div class="input-group">
                    <label for="signup-email">Email</label>
                    <div class="input-with-icon">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="signup-email" placeholder="careerconnect@gmail.com">
                    </div>
                </div>

                <div class="input-group">
                    <label for="signup-password">Password</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="signup-password" placeholder="●●●●●●●●●●">
                    </div>
                </div>

                <div class="input-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="confirm-password" placeholder="●●●●●●●●●●">
                    </div>
                </div>

                <button type="submit">Sign Up</button>
            </form>
        </div>
        `<!-- Only showing the modified sign-in form section, rest remains unchanged -->
        <div class="form-container sign-in">
            <form action="admin/adminDashboard.php" method="POST">
                <h1>Sign In</h1>
                <p class="form-description">Welcome back! Please sign in to access your CareerConnect account and explore opportunities.</p>
                
                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-with-icon">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="careerconnect@gmail.com" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="●●●●●●●●●●" required>
                    </div>
                    <div class="password-options">
                        <a href="#" class="forgot-password">Forget Your Password?</a>
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
                <div class="toggle-panel toggle-left">
                    <img src="images/imagelogo1.png" alt="Logo" class="toggle-logo">
                    <h1>CareerConnect</h1>
                    <p>This website is the ultimate job portal for IT graduates and professionals, linking you with top tech employers and exciting career opportunities in the IT fields.</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <img src="images/imagelogo1.png" alt="Logo" class="toggle-logo">
                    <h1>CareerConnect</h1>
                    <p>This website is the ultimate job portal for IT graduates and professionals, linking you with top tech employers and exciting career opportunities in the IT fields.</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
 
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
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

.container button.hidden {
    background-color: transparent;
    border-color: #fff;
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

.container.active .sign-in {
    transform: translateX(100%);
}

.sign-up {
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.active .sign-up {
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: slide 0.6s ease-in-out;
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

.container.active .toggle-container {
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;
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

.container.active .toggle {
    transform: translateX(50%);
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

.toggle-left {
    transform: translateX(-200%);
}

.container.active .toggle-left {
    transform: translateX(0);
}

.toggle-right {
    right: 0;
    transform: translateX(0);
}

.container.active .toggle-right {
    transform: translateX(200%);
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

@keyframes slide {
    0% {
        transform: translateX(-100%);
        opacity: 0;
    }
    100% {
        transform: translateX(100%);
        opacity: 1;
    }
}

@media (max-width: 768px) {
    .container {
        width: 100%;
        min-height: 480px;
    }

    .toggle-container {
        display: none;
    }

    .sign-in, .sign-up {
        width: 100%;
    }

    .container.active .sign-in {
        transform: translateX(-100%);
    }
}

.terms-label input[type="checkbox"] {
    width: 14px;
    height: 14px;
    margin-top: 2px;
    flex-shrink: 0;
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

.terms-label span {
    font-size: 10px;
    line-height: 1.4;
    color: #666;
    display: block;
    width: calc(100% - 24px);
    text-align: justify;
}

.terms-link {
    color: #003479;
    text-decoration: none;
}

.terms-link:hover {
    text-decoration: underline;
}

.terms-description {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
    max-width: 300px;
    text-align: left;
}
</style>

<script>
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});
</script>