<?php
session_start();
include "db.php";
include "send_mail.php";
include "send_sms.php";

if (!isset($_SESSION['login_otp_user'])) {
    header("Location: login.php");
    exit();
}

$userId = intval($_SESSION['login_otp_user']);

/* 🔁 RESEND LOGIN OTP */
if (isset($_POST['resend'])) {

    $newOtp = rand(100000, 999999);
    $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    mysqli_query(
        $conn,
        "UPDATE users SET login_otp='$newOtp', login_otp_expires_at='$expiry' WHERE id=$userId"
    );

    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT email, phone FROM users WHERE id=$userId"));

    $message = "Your Login OTP is $newOtp. Valid for 5 minutes.";

    if (!empty($user['email'])) {
        sendMail($user['email'], "Login OTP", $message);
    }

    if (!empty($user['phone'])) {
        sendSMS($user['phone'], $message);
    }

    echo "<script>alert('New OTP sent');</script>";
}

/* ✅ VERIFY LOGIN OTP */
if (isset($_POST['verify'])) {

    $otp = trim($_POST['otp']);

    $result = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE id=$userId AND login_otp='$otp'"
    );

    if ($result && mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        if (strtotime($user['login_otp_expires_at']) >= time()) {

            mysqli_query(
                $conn,
                "UPDATE users SET login_otp=NULL, login_otp_expires_at=NULL WHERE id=$userId"
            );

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            unset($_SESSION['login_otp_user']);

            header("Location: dashboard.php");
            exit();

        } else {
            echo "<script>alert('OTP expired');</script>";
        }

    } else {
        echo "<script>alert('Invalid OTP');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Login OTP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-bg">

<div class="login-wrapper">
<div class="login-glass">

<h2>Verify Login OTP</h2>
<p class="login-sub">Enter OTP sent to your email/mobile</p>

<form method="post">
    <input type="number" name="otp" placeholder="Enter OTP" required>
    <button name="verify" class="login-btn-modern">Verify OTP</button>
    <button name="resend" formnovalidate class="otp-resend-btn">Resend OTP</button>
</form>

</div>
</div>

</body>
</html>