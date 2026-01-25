<?php
session_start();
include "db.php";
include "send_mail.php";

if (!isset($_GET['email'])) {
    die("Email missing");
}

$email = trim($_GET['email']);

/* 🔁 RESEND REGISTRATION OTP */
if (isset($_POST['resend'])) {

    $newOtp = rand(100000, 999999);
    $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    mysqli_query(
        $conn,
        "UPDATE users 
         SET otp='$newOtp', otp_expires_at='$expiry' 
         WHERE email='$email'"
    );

    sendMail(
        $email,
        "Resent Registration OTP",
        "Your new OTP is <b>$newOtp</b><br>Valid for 5 minutes"
    );

    echo "<script>alert('New OTP sent');</script>";
}

/* ✅ VERIFY REGISTRATION OTP */
if (isset($_POST['verify'])) {

    $otp = trim($_POST['otp']);

    $result = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE email='$email' AND otp='$otp'"
    );

    if ($result && mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        // ⏱️ EXPIRY CHECK IN PHP
        if (strtotime($user['otp_expires_at']) >= time()) {

            mysqli_query(
                $conn,
                "UPDATE users 
                 SET is_verified=1, otp=NULL, otp_expires_at=NULL 
                 WHERE email='$email'"
            );

            // ✅ SEND WELCOME EMAIL AFTER SUCCESSFUL VERIFICATION

$subject = "Welcome to Pension Tracking & Alert Notification System";

$message = "
<h2>Welcome, ".$user['name']." 👋</h2>

<p>
Your registration has been <b>successfully verified</b>.
Welcome to the <b>Pension Tracking & Alert Notification System</b>.
</p>

<p>You can now:</p>

<ul>
    <li>Apply for pension online</li>
    <li>Track pension approval status</li>
    <li>Upload life certificates</li>
    <li>Receive important alerts & notifications</li>
</ul>

<p style='color:#555'>
🔐 <b>Security Reminder:</b><br>
Never share your password or OTP with anyone.
</p>

<p>
<a href='http://localhost:8080/pension_system/login.php'
style='display:inline-block;
padding:12px 22px;
background:#4f46e5;
color:#ffffff;
text-decoration:none;
border-radius:6px;
font-weight:600;'>
Login to Your Account
</a>
</p>

<p>
Regards,<br>
<b>Pension System Team</b>
</p>
";

sendMail($email, $subject, $message);


            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            header("Location: dashboard.php");
            exit();

        } else {
            echo "<script>alert('OTP expired. Please resend OTP');</script>";
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
<body>
<div class="form-box">
    <h2>Verify OTP</h2>
    <form method="post">
        <input type="number" name="otp" placeholder="Enter OTP" required>
        <button type="submit" name="verify">Verify</button>
        <button type="submit" name="resend">Resend OTP</button>
    </form>
</div>
</body>
</html>
