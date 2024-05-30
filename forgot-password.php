<?php
session_start();
include("db.php");
require 'vendor/autoload.php'; // Ensure PHPMailer is autoloaded

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Handle forgot password form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    
    // Check if the email exists in the database
    $stmt = $connect->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if ($user_id) {
        // Generate a reset token
        $reset_token = bin2hex(random_bytes(16));
        $stmt = $connect->prepare("UPDATE users SET reset_token = ?, reset_requested_at = NOW() WHERE id = ?");
        $stmt->bind_param("si", $reset_token, $user_id);
        $stmt->execute();
        $stmt->close();

        // Send the reset link to the user's email
        $reset_link = "http://yourwebsite.com/reset-password.php?token=$reset_token";
        
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io'; // Mailtrap SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = '20e62207936784'; // Mailtrap username
            $mail->Password = '********a179';// Mailtrap password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Recipients
            $mail->setFrom('no-reply@yourwebsite.com', 'Your Website');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Click the following link to reset your password: <a href=\"$reset_link\">$reset_link</a>";
            $mail->AltBody = "Click the following link to reset your password: $reset_link";

            $mail->send();
            $success = "A password reset link has been sent to your email address.";
        } catch (Exception $e) {
            $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $error = "No account found with that email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f5f5f5;
    }

    .forgot-password-container {
        background-color: #fff;
        padding: 40px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    .forgot-password-container h2 {
        margin-bottom: 20px;
        font-weight: 700;
    }

    .forgot-password-container .form-group {
        margin-bottom: 20px;
    }

    .forgot-password-container .primary-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        width: 100%;
        font-size: 16px;
    }

    .forgot-password-container .primary-btn:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form action="forgot-password.php" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="primary-btn">Send Reset Link</button>
        </form>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>