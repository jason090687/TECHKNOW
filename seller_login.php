<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize input
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    // Fetch user from database
    $stmt = $connect->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <div class="login-section">
            <div class="form-container">
                <h2 class="title">ChiChart - Online Shopping</h2>
                <h3>Welcome Back Seller</h3>
                <p>Log in to your account using email & password</p>
                <?php if (isset($error)): ?>
                <div class="error-message"><?= $error ?></div>
                <?php endif; ?>
                <form action="seller_login.php" method="POST">
                    <div class="input-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember-me" name="remember-me">
                            <label for="remember-me">Remember Me</label>
                        </div>
                        <a href="forgot-password.php" class="forgot-password">Forget Password</a>
                    </div>
                    <button type="submit" class="btn-login">LOGIN</button>
                </form>
                <p class="create-account">Don't have an account yet? <a href="seller_signup.php">Create an account</a>
                </p>
                <div class="social-login">
                    <p>Login With</p>
                    <div class="social-buttons">
                        <a href="#" class="btn-social">Facebook</a>
                        <a href="#" class="btn-social">Twitter</a>
                        <a href="#" class="btn-social">Google</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="info-section">
            <h2>Shop With Confidence</h2>
            <p>Browse a catalog of ecommerce services offered by our vetted experts or submit custom requests.</p>
        </div>
    </div>
</body>

</html>