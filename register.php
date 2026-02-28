<?php
include "db.php";
include "send_mail.php";
include "send_sms.php";

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $identifier = trim($_POST['identifier']);

    // Detect email or phone
    if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
        $email = $identifier;
        $phone = "";
    } else {
        $phone = $identifier;
        $email = "";
    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $otp    = rand(100000, 999999);
    $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    // Check duplicate
    if(!empty($email)){
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    } else {
        $check = mysqli_query($conn, "SELECT id FROM users WHERE phone='$phone'");
    }

    if (mysqli_num_rows($check) > 0) {

        echo "<script>alert('Email or Phone already registered');</script>";

    } else {

        mysqli_query(
            $conn,
            "INSERT INTO users (name,email,phone,password,otp,otp_expires_at)
             VALUES ('$name','$email','$phone','$password','$otp','$expiry')"
        );

        $message = "Your Registration OTP is $otp. Valid for 5 minutes.";

// Send EMAIL only if email exists
if (!empty($email)) {
    sendMail($email, "Registration OTP", $message);
}

// Send SMS only if phone exists
if (!empty($phone)) {
    sendSMS($phone, $message);
}
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