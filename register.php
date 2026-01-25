<?php
include "db.php";
include "send_mail.php";

if (isset($_POST['register'])) {

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $otp     = rand(100000, 999999);
    $expiry  = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already registered');</script>";
    } else {

        mysqli_query(
            $conn,
            "INSERT INTO users (name,email,password,otp,otp_expires_at,is_verified)
             VALUES ('$name','$email','$password','$otp','$expiry',0)"
        );

        sendMail(
            $email,
            "Registration OTP",
            "Hello <b>$name</b>,<br>
             Your OTP is <b>$otp</b><br>
             <small>Valid for 5 minutes</small>"
        );

        header("Location: verify_otp.php?email=$email");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="auth-bg">
    <div class="form-box">
        <h2>Create Account</h2>

        <form method="post">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button name="register">Register</button>
        </form>

        <p style="text-align:center; margin-top:15px;">
            Already have an account?
            <a href="login.php">Login</a>
        </p>
    </div>
</div>

</body>
</html>

