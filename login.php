<?php
session_start();
include "db.php";
include "send_mail.php";
include "log_activity.php";

logActivity(
    $conn,
    'User',
    $_SESSION['user_id'],
    'Logged in to system'
);


if (isset($_POST['login'])) {

    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    $result = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE email='$email' AND is_verified=1"
    );

    if ($result && mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $loginOtp = rand(100000, 999999);
            $expiry   = date("Y-m-d H:i:s", strtotime("+5 minutes"));

            mysqli_query(
                $conn,
                "UPDATE users 
                 SET login_otp='$loginOtp', login_otp_expires_at='$expiry'
                 WHERE id=".$user['id']
            );

            sendMail(
                $user['email'],
                "Login OTP",
                "Your login OTP is <b>$loginOtp</b><br>
                 <small>Valid for 5 minutes</small>"
            );

            $_SESSION['login_otp_user'] = $user['id'];

            header("Location: verify_login_otp.php");
            exit();

        } else {
            echo "<script>alert('Wrong password');</script>";
        }
    } else {
        echo "<script>alert('User not found or not verified');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="login-page">
    <div class="form-box">
        <h2>Login</h2>

        <form method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button name="login">Login</button>
        </form>
        <p style="text-align:center; margin-top:15px;">
    New user?
    <a href="register.php" style="color:#6366f1; font-weight:600;">
        Register here
    </a>
</p>

    </div>
</div>

</body>
</html>

