<?php
session_start();
include "db.php";
include "send_mail.php";

if (isset($_POST['send'])) {

    $email = trim($_POST['email']);
    $otp = rand(100000,999999);
    $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    $check = mysqli_query($conn,"SELECT id FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) == 1){

        mysqli_query($conn,
            "UPDATE users 
             SET otp='$otp', otp_expires_at='$expiry' 
             WHERE email='$email'"
        );

        sendMail($email,"Password Reset OTP","Your OTP is $otp");

        $_SESSION['reset_email'] = $email;

        header("Location: reset_password.php");
        exit();

    } else {
        echo "<script>alert('Email not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="login-bg">

<div class="login-wrapper">
<div class="login-glass">

    <h2>Pension Tracking System</h2>
    <p class="login-sub">Reset Your Password</p>

    <form method="post">

        <div class="input-group">
            <input type="email" name="email" placeholder="Enter your registered email" required>
        </div>

        <button name="send" class="login-btn-modern">
            Send OTP
        </button>

    </form>

    <p class="signup-text">
        Remember your password?
        <a href="login.php">Back to Login</a>
    </p>

</div>
</div>

</body>
</html>