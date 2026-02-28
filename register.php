<?php
include "db.php";
include "send_mail.php";

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $identifier = trim($_POST['identifier']);

    if (!filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
        die("Only email registration allowed for now.");
    }

    $email = mysqli_real_escape_string($conn, $identifier);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $otp = rand(100000, 999999);
    $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    // Check if user exists
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {

        // User exists → update OTP always
        $user = mysqli_fetch_assoc($check);

        mysqli_query(
            $conn,
            "UPDATE users 
             SET otp='$otp', otp_expires_at='$expiry', is_verified=0 
             WHERE id=".$user['id']
        );

    } else {

        // New user → insert
        mysqli_query(
            $conn,
            "INSERT INTO users 
            (name,email,password,otp,is_verified,otp_expires_at) 
            VALUES 
            ('$name','$email','$password','$otp',0,'$expiry')"
        );
    }

    // Send OTP email
    $message = "Your Registration OTP is $otp. Valid for 5 minutes.";
    sendMail($email, "Registration OTP", $message);

    header("Location: verify_otp.php?identifier=" . urlencode($email));
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="auth-hero">
    <div class="auth-card">

        <h1>Create Account</h1>
        <p>Access your pension services securely</p>

        <form method="post">

            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="identifier" placeholder="Email or Mobile Number" required>
            <input type="password" name="password" placeholder="Create Password" required>

            <button name="register" class="auth-btn">Continue</button>

        </form>

        <div class="auth-footer">
            Already have account? <a href="login.php">Login</a>
        </div>

    </div>
</div>

</body>
</html>