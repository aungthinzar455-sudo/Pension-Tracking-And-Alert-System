<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    mysqli_query($conn,
        "INSERT INTO complaints (user_id, subject, message)
         VALUES ('$user_id', '$subject', '$message')"
    );

    echo "<script>alert('Complaint submitted successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Raise Complaint</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="page-bg">
<div class="form-box">
    <h2>Raise Complaint</h2>

    <form method="post">
        <input type="text" name="subject" placeholder="Subject" required>
        <textarea name="message" placeholder="Describe your issue" required></textarea>
        <button name="submit">Submit</button>
    </form>
</div>
</div>

</body>
</html>
