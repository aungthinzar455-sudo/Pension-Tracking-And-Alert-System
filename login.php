<?php
session_start();
include "db.php";
include "send_mail.php";
include "send_sms.php";
include "log_activity.php";

if (isset($_POST['login'])) {

    $identifier = trim($_POST['identifier']);
    $password   = trim($_POST['password']);

    // Find user by email OR phone
    $query = "SELECT * FROM users 
              WHERE (email='$identifier' OR phone='$identifier') ";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        // Check password
        if (password_verify($password, $user['password'])) {

            // Generate OTP
            $loginOtp = rand(100000, 999999);
            $expiry   = date("Y-m-d H:i:s", strtotime("+5 minutes"));

            mysqli_query(
                $conn,
                "UPDATE users 
                 SET login_otp='$loginOtp', login_otp_expires_at='$expiry'
                 WHERE id=".$user['id']
            );

            $message = "Your Login OTP is $loginOtp. Valid for 5 minutes.";

            // Send email OTP if email exists
            if (!empty($user['email'])) {
                sendMail($user['email'], "Login OTP", $message);
            }

            // Send SMS OTP if phone exists (demo logs)
            if (!empty($user['phone'])) {
                sendSMS($user['phone'], $message);
            }

            // Save session for OTP verification
            $_SESSION['login_otp_user'] = $user['id'];

            header("Location: verify_otp.php?identifier=" . urlencode($identifier));
            exit();

        } else {
            echo "<script>alert('Wrong password');</script>";
        }

    } else {
        echo "<script>alert('User not found or not verified');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-bg">

<div class="login-wrapper">

    <div class="login-glass">

        <h2>Pension Tracking System</h2>
        <p class="login-sub">Secure Access to Your Future</p>

        <form method="post">

            <div class="input-group">
                <input type="text" name="identifier" placeholder="Email or Mobile Number" required>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="login-options">
                <label>
                    <input type="checkbox"> Remember Me
                </label>
                <a href="#">Forgot Password?</a>
            </div>

            <button name="login" class="login-btn-modern">LOGIN</button>

        </form>

        <p class="signup-text">
            Don't have an account?
            <a href="register.php">Sign Up</a>
        </p>

    </div>

</div>

</body>
</html>