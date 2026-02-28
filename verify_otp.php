<?php
session_start();
include "db.php";
include "send_mail.php";
include "send_sms.php";

if (!isset($_GET['identifier'])) {
    die("Identifier missing");
}

$identifier = trim($_GET['identifier']);

/* Detect email or phone */
if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
    $where = "email='$identifier'";
    $isEmail = true;
} else {
    $where = "phone='$identifier'";
    $isEmail = false;
}

/* 🔁 RESEND OTP */
if (isset($_POST['resend'])) {

    $newOtp = rand(100000, 999999);
    $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    mysqli_query(
        $conn,
        "UPDATE users SET otp='$newOtp', otp_expires_at='$expiry' WHERE $where"
    );

    $message = "Your new OTP is $newOtp. Valid for 5 minutes";

    if ($isEmail) {
        sendMail($identifier, "Resent Registration OTP", $message);
    } else {
        sendSMS($identifier, $message);
    }

    echo "<script>alert('New OTP sent');</script>";
}

/* ✅ VERIFY OTP */
if (isset($_POST['verify'])) {

    $otp = trim($_POST['otp']);

    $result = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE $where AND otp='$otp'"
    );

    if ($result && mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        if (strtotime($user['otp_expires_at']) >= time()) {

            mysqli_query(
                $conn,
                "UPDATE users SET is_verified=1, otp=NULL, otp_expires_at=NULL WHERE id=".$user['id']
            );

            /* Welcome email only if email exists */
            if (!empty($user['email'])) {

                $subject = "Welcome to Pension Tracking System";

                $message = "
                <h2>Welcome ".$user['name']." 👋</h2>
                <p>Your account has been successfully verified.</p>
                <p>You can now login and access all services.</p>
                ";

                sendMail($user['email'], $subject, $message);
            }

            /* Auto login */
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

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
    <title>Verify OTP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-bg">

<div class="login-wrapper">
<div class="login-glass">

<h2>Verify OTP</h2>
<p class="login-sub">Enter OTP sent to your email/mobile</p>

<form method="post">
    <input type="number" name="otp" placeholder="Enter OTP" required>
    <button name="verify" class="login-btn-modern">Verify</button>
    <button name="resend" formnovalidate class="otp-resend-btn">Resend OTP</button>
</form>

</div>
</div>

</body>
</html>