<?php
include "db.php";

$email = $_GET['email'];

if (isset($_POST['reset'])) {

    $otp = $_POST['otp'];
    $newPass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn,
        "SELECT * FROM users 
         WHERE email='$email' 
         AND otp='$otp' 
         AND otp_expires_at >= NOW()"
    );

    if (mysqli_num_rows($check) == 1) {

        mysqli_query($conn,
            "UPDATE users 
             SET password='$newPass', otp=NULL 
             WHERE email='$email'"
        );

        echo "<script>alert('Password reset successful'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Invalid or expired OTP');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="form-box">
    <h2>Reset Password</h2>
    <form method="post">
        <input type="number" name="otp" placeholder="Enter OTP" required>
        <input type="password" name="password" placeholder="New Password" required>
        <button name="reset">Reset Password</button>
    </form>
</div>

</body>
</html>
