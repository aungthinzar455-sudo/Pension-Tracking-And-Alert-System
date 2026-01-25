<?php
include "../db.php";

if (!isset($_GET['user_id'])) {
    die("User ID missing");
}

$user_id = intval($_GET['user_id']);

/* Fetch user */
$user = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT name, email, profile_photo FROM users WHERE id=$user_id")
);

/* Fetch profile */
$profile = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM pensioner_profile WHERE user_id=$user_id")
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Pensioner Profile</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="admin-page">
<div class="admin-container admin-narrow">

<h2>👤 Pensioner Profile</h2>

<div style="text-align:center;">
    <img 
        src="../uploads/profile_photos/<?= $user['profile_photo'] ?? 'default.png' ?>" 
        style="width:90px;height:90px;border-radius:50%;border:3px solid #6366f1;"
    >
</div>

<table class="admin-table" style="margin-top:20px;">
<tr><th>Name</th><td><?= $user['name'] ?></td></tr>
<tr><th>Email</th><td><?= $user['email'] ?></td></tr>
<tr><th>Date of Birth</th><td><?= $profile['dob'] ?? '-' ?></td></tr>
<tr><th>Address</th><td><?= $profile['address'] ?? '-' ?></td></tr>
<tr><th>Aadhaar No</th><td><?= $profile['aadhaar_no'] ?? '-' ?></td></tr>
<tr><th>Bank Name</th><td><?= $profile['bank_name'] ?? '-' ?></td></tr>
<tr><th>Account No</th><td><?= $profile['account_no'] ?? '-' ?></td></tr>
<tr><th>IFSC</th><td><?= $profile['ifsc_code'] ?? '-' ?></td></tr>
<tr><th>Retirement Date</th><td><?= $profile['retirement_date'] ?? '-' ?></td></tr>
<tr><th>Pension Type</th><td><?= $profile['pension_type'] ?? '-' ?></td></tr>
</table>
<a href="profile_pdf.php?user_id=<?= $user_id ?>" class="dash-btn">
📄 Download Profile PDF
</a>


<br>
<a href="admin_dashboard.php" class="dash-btn">⬅ Back to Admin</a>

</div>
</div>

</body>
</html>
