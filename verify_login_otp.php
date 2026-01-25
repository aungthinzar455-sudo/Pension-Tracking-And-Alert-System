<?php
session_start();
include "db.php";
include "send_mail.php";

if (!isset($_SESSION['login_otp_user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['login_otp_user'];

/* 🔁 RESEND LOGIN OTP */
if (isset($_POST['resend'])) {

    $newOtp = rand(100000, 999999);
    $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    mysqli_query(
        $conn,
        "UPDATE users 
         SET login_otp='$newOtp', login_otp_expires_at='$expiry' 
         WHERE id=$userId"
    );

    $user = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT email FROM users WHERE id=$userId")
    );

    sendMail(
        $user['email'],
        "Resent Login OTP",
        "Your new login OTP is <b>$newOtp</b><br>Valid for 5 minutes"
    );

    echo "<script>alert('New login OTP sent');</script>";
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

        // ⏱️ EXPIRY CHECK IN PHP
        if (strtotime($user['login_otp_expires_at']) >= time()) {

            mysqli_query(
                $conn,
                "UPDATE users 
                 SET login_otp=NULL, login_otp_expires_at=NULL 
                 WHERE id=$userId"
            );

            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            unset($_SESSION['login_otp_user']);

            header("Location: dashboard.php");
            exit();

        } else {
            echo "<script>alert('Login OTP expired. Please resend OTP');</script>";
        }

    } else {
        echo "<script>alert('Invalid Login OTP');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Login OTP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="form-box">
    <h2>Verify Login OTP</h2>
    <form method="post">
        <input type="number" name="otp" placeholder="Enter OTP" required>
        <button type="submit" name="verify">Verify</button>
        <button type="submit" name="resend">Resend OTP</button>
    </form>
</div>
</body>
</html>
