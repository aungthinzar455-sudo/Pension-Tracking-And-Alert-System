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

<div style="
    min-height:100vh;
    background:linear-gradient(135deg,#dbeafe,#f8fafc);
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px;
">

    <div style="
        width:100%;
        max-width:700px;
        background:white;
        padding:35px 40px;
        border-radius:20px;
        box-shadow:0 25px 60px rgba(0,0,0,0.15);
    ">

        <!-- HEADER -->
        <div style="text-align:center;margin-bottom:25px;">
            <h2 style="
                color:#1e3a8a;
                margin-bottom:5px;
            ">Raise Complaint</h2>

            <p style="color:#64748b;">
                Submit your issue and our support team will assist you shortly
            </p>
        </div>


        <form method="post">

            <!-- SUBJECT -->
            <label style="font-weight:600;color:#334155;">Subject</label>
            <input type="text" name="subject" required
                placeholder="Enter complaint subject"
                style="
                    width:100%;
                    padding:14px;
                    margin-top:6px;
                    margin-bottom:18px;
                    border:1px solid #e2e8f0;
                    border-radius:10px;
                    font-size:14px;
                    outline:none;
                    transition:0.2s;
                "
                onfocus="this.style.borderColor='#2563eb'"
                onblur="this.style.borderColor='#e2e8f0'"
            >


            <!-- MESSAGE -->
            <label style="font-weight:600;color:#334155;">Describe Issue</label>
            <textarea name="message" required
                placeholder="Write your complaint details..."
                style="
                    width:100%;
                    padding:14px;
                    height:140px;
                    margin-top:6px;
                    margin-bottom:22px;
                    border:1px solid #e2e8f0;
                    border-radius:10px;
                    font-size:14px;
                    resize:none;
                    outline:none;
                    transition:0.2s;
                "
                onfocus="this.style.borderColor='#2563eb'"
                onblur="this.style.borderColor='#e2e8f0'"
            ></textarea>


            <!-- BUTTON -->
            <button name="submit"
                style="
                    width:100%;
                    padding:14px;
                    border:none;
                    border-radius:10px;
                    background:linear-gradient(135deg,#2563eb,#06b6d4);
                    color:white;
                    font-size:15px;
                    font-weight:600;
                    cursor:pointer;
                    box-shadow:0 10px 20px rgba(37,99,235,0.3);
                    transition:0.25s;
                "
                onmouseover="this.style.transform='translateY(-2px)'"
                onmouseout="this.style.transform='translateY(0)'"
            >
                Submit Complaint
            </button>

        </form>

    </div>

</div>

</body>

</html>
