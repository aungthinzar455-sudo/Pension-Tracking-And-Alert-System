<?php
include "../db.php";
include "../send_mail.php";

/* 🔐 SAFETY CHECK */
if (!isset($_GET['id']) || !isset($_GET['status'])) {
    die("Invalid request. Missing parameters.");
}

$id     = (int) $_GET['id'];
$status = $_GET['status'];

// Allow only valid status values
if (!in_array($status, ['Approved', 'Rejected'])) {
    die("Invalid status value.");
}

// Fetch user details
$result = mysqli_query(
    $conn,
    "SELECT u.email, u.name 
     FROM pension_applications p
     JOIN users u ON p.user_id = u.id
     WHERE p.id=$id"
);

if (!$result || mysqli_num_rows($result) !== 1) {
    die("Application not found.");
}

$user = mysqli_fetch_assoc($result);

// Update application status
mysqli_query(
    $conn,
    "UPDATE pension_applications 
     SET status='$status' 
     WHERE id=$id"
);

// Send email notification
sendMail(
    $user['email'],
    "Pension Application $status",
    "Dear <b>{$user['name']}</b>,<br><br>
     Your pension application has been <b>$status</b>.<br><br>
     Thank you,<br>
     Pension Tracking System"
);

// Redirect back to admin page
header("Location: admin_pension_verify.php");
exit();
