<?php
session_start();
include "db.php";
include "log_activity.php";

logActivity(
    $conn,
    'User',
    $_SESSION['user_id'],
    "Uploaded life certificate"
);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['upload'])) {

    $user_id = $_SESSION['user_id'];
    $expiry = $_POST['expiry'];

    $file = $_FILES['certificate']['name'];
    $tmp = $_FILES['certificate']['tmp_name'];

    $folder = "uploads/life_certificates/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $path = $folder . time() . "_" . $file;
    move_uploaded_file($tmp, $path);

    mysqli_query($conn,
        "INSERT INTO life_certificates (user_id, certificate_file, expiry_date)
         VALUES ('$user_id', '$path', '$expiry')"
    );

    echo "<script>alert('Life Certificate uploaded successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Life Certificate</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="page-bg">
<div class="form-box">
<h2>Upload Life Certificate</h2>

<form method="post" enctype="multipart/form-data">
    <label>Life Certificate (PDF / JPG)</label>
    <input type="file" name="certificate" required>

    <label>Expiry Date</label>
    <input type="date" name="expiry" required>

    <button name="upload">Upload</button>
</form>

</div>
</div>

</body>
</html>
