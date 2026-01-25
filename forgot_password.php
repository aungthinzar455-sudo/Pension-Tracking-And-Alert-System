<?php
include "db.php";
include "send_mail.php";

if (isset($_POST['send'])) {
    $email = $_POST['email'];

    $otp = rand(100000,999999);
    $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) == 1) {

        mysqli_query($conn,
            "UPDATE users SET otp='$otp', otp_expires_at='$expiry' WHERE email='$email'"
        );

        sendMail(
            $email,
            "Password Reset OTP",
            "Your password reset OTP is <b>$otp</b> (valid for 5 minutes)"
        );

        header("Location: reset_password.php?email=$email");
        exit();
    } else {
        echo "<script>alert('Email not registered');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="page-bg">
    <div class="form-box">
    <h2>Forgot Password</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button name="send">Send OTP</button>
    </form>
</div>

</body>
</html>
