<?php 

require_once __DIR__ . '/../../vendor/autoload.php';  // Adjust the path relative to the current file

// Include the PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email {

    // Send verification email with code
    public function send_verification_email($to_email, $username, $verification_code) {
        // Create an instance of PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // SMTP server (can change based on your provider)
            $mail->SMTPAuth = true;
            $mail->Username = 'themanbehindall0@gmail.com';  // Your email address
            $mail->Password = 'ilxszouovjmvocch';  // Your email password (use environment variables for security)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('your-email@gmail.com', 'Your Name');  // Sender's email and name
            $mail->addAddress($to_email, $username);  // Recipient's email and name

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification Code';
            $mail->Body    = "Dear $username,<br><br>Your verification code is: <strong>$verification_code</strong><br><br>
                              Please enter this code to verify your account.<br><br>Thank you!";

            // Send email
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;  // Return false if the email could not be sent
        }
    }
}
