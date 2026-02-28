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

<div style="
    min-height:100vh;
    background:linear-gradient(135deg,#e0f2fe,#f8fafc);
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px;
">

    <div style="
        width:100%;
        max-width:520px;
        background:white;
        padding:40px;
        border-radius:20px;
        box-shadow:0 25px 60px rgba(0,0,0,0.12);
    ">

        <!-- HEADER -->
        <div style="text-align:center;margin-bottom:25px;">

            <div style="
                width:70px;
                height:70px;
                margin:auto;
                border-radius:50%;
                background:linear-gradient(135deg,#2563eb,#06b6d4);
                display:flex;
                align-items:center;
                justify-content:center;
                color:white;
                font-size:28px;
                margin-bottom:10px;
            ">
                📄
            </div>

            <h2 style="color:#1e3a8a;margin-bottom:5px;">
                Upload Life Certificate
            </h2>

            <p style="color:#64748b;">
                Upload your certificate to keep pension active
            </p>

        </div>


        <!-- FORM -->
        <form method="post" enctype="multipart/form-data">

            <!-- FILE -->
            <label style="font-weight:600;color:#374151;">
                Life Certificate (PDF / JPG)
            </label>

            <input type="file" name="certificate" required
                   style="
                        width:100%;
                        padding:12px;
                        margin-top:6px;
                        margin-bottom:18px;
                        border:1px solid #e5e7eb;
                        border-radius:10px;
                        background:#f8fafc;
                   ">


            <!-- DATE -->
            <label style="font-weight:600;color:#374151;">
                Expiry Date
            </label>

            <input type="date" name="expiry" required
                   style="
                        width:100%;
                        padding:12px;
                        margin-top:6px;
                        margin-bottom:22px;
                        border:1px solid #e5e7eb;
                        border-radius:10px;
                        background:#f8fafc;
                   ">


            <!-- BUTTON -->
            <button name="upload"
                    style="
                        width:100%;
                        padding:14px;
                        background:linear-gradient(135deg,#2563eb,#06b6d4);
                        color:white;
                        border:none;
                        border-radius:12px;
                        font-size:16px;
                        font-weight:600;
                        cursor:pointer;
                        box-shadow:0 10px 20px rgba(37,99,235,0.3);
                        transition:0.3s;
                    "
                    onmouseover="this.style.transform='translateY(-2px)'"
                    onmouseout="this.style.transform='translateY(0)'">

                Upload Certificate

            </button>

        </form>

    </div>

</div>

</body>

</html>
