<?php
session_start();
include "db.php";

if(!isset($_SESSION['reset_email'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['reset_email'];

if(isset($_POST['reset'])){

    $otp = trim($_POST['otp']);
    $newpass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $result = mysqli_query($conn,
        "SELECT * FROM users 
         WHERE email='$email' 
         AND otp='$otp'"
    );

    if(mysqli_num_rows($result)==1){

        mysqli_query($conn,
            "UPDATE users 
             SET password='$newpass', otp=NULL, otp_expires_at=NULL 
             WHERE email='$email'"
        );

        unset($_SESSION['reset_email']);

        echo "<script>alert('Password Updated Successfully');window.location='login.php';</script>";

    } else {
        echo "<script>alert('Invalid OTP');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="login-bg">

<div class="login-wrapper">
<div class="login-glass">

    <h2>Pension Tracking System</h2>
    <p class="login-sub">Enter OTP & New Password</p>

    <form method="post">

        <div class="input-group">
            <input type="text" name="otp" placeholder="Enter OTP" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Enter New Password" required>
        </div>

        <button name="reset" class="login-btn-modern">
            Reset Password
        </button>

    </form>

    <p class="signup-text">
        Back to <a href="login.php">Login</a>
    </p>

</div>
</div>

</body>
</html>