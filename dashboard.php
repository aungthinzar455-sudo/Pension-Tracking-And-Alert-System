<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch pension details
$result = mysqli_query($conn, "SELECT * FROM pension WHERE user_id = $user_id");
$pension = mysqli_fetch_assoc($result);

/* ===============================
   NEXT PAYMENT DATE LOGIC
================================ */
$nextPaymentDate = null;

if ($pension && !empty($pension['updated_at'])) {
    if ($pension['status'] === "Approved" || $pension['status'] === "Active") {
        $lastPaid = strtotime($pension['updated_at']);
        $nextPaymentDate = date("d M Y", strtotime("+1 month", $lastPaid));
    }
}


/* ===============================
   DASHBOARD ALERT LOGIC
================================ */
$alerts = [];

if (!$pension) {
    $alerts[] = [
        "type" => "warning",
        "msg"  => "Your pension is not approved yet. Please complete the application."
    ];
} else {
    if ($pension['status'] === "Approved" || $pension['status'] === "Active") {
        $alerts[] = [
            "type" => "success",
            "msg"  => "Your pension is approved and active."
        ];
    } elseif ($pension['status'] === "Pending") {
        $alerts[] = [
            "type" => "info",
            "msg"  => "Your pension application is under review."
        ];
    } elseif ($pension['status'] === "Rejected") {
        $alerts[] = [
            "type" => "danger",
            "msg"  => "Your pension application was rejected. Please contact support."
        ];
    }
}
$adminAlertsResult = mysqli_query(
    $conn,
    "SELECT message, type 
FROM alerts 
WHERE user_id = $user_id AND is_read = 0
ORDER BY created_at DESC"
);

while ($row = mysqli_fetch_assoc($adminAlertsResult)) {
    $alerts[] = [
        "type" => $row['type'],
        "msg"  => $row['message']
    ];
}
mysqli_query(
    $conn,
    "UPDATE alerts SET is_read = 1 WHERE user_id = $user_id"
);

/* ===============================
   LIFE CERTIFICATE EXPIRY CHECK
================================ */
$lcResult = mysqli_query(
    $conn,
    "SELECT expiry_date 
     FROM life_certificates 
     WHERE user_id = $user_id 
     ORDER BY expiry_date DESC 
     LIMIT 1"
);

if ($lcResult && mysqli_num_rows($lcResult) === 1) {

    $lc = mysqli_fetch_assoc($lcResult);
    $expiry = strtotime($lc['expiry_date']);
    $today  = strtotime(date("Y-m-d"));

    $daysLeft = ceil(($expiry - $today) / (60 * 60 * 24));

    if ($daysLeft <= 0) {
        $alerts[] = [
            "type" => "danger",
            "msg"  => "❌ Your Life Certificate has expired. Please upload immediately to avoid suspension."
        ];
    } elseif ($daysLeft <= 15) {
        $alerts[] = [
            "type" => "warning",
            "msg"  => "⚠️ Your Life Certificate will expire in $daysLeft days."
        ];
    }
}
 /* ===============================
   ARREARS TRACKING
================================ */
$arResult = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS months, SUM(amount) AS total 
     FROM pension_history 
     WHERE user_id = $user_id 
     AND status IN ('Pending','Failed')"
);

$ar = mysqli_fetch_assoc($arResult);

if ($ar && $ar['months'] > 0) {
    $alerts[] = [
        "type" => "warning",
        "msg"  => "⚠️ You have ".$ar['months']." unpaid pension month(s). Total arrears: ₹ ".$ar['total']
    ];
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="dashboard-page">
    <div class="form-box dashboard-box">

        <h2>Welcome, <?php echo $_SESSION['user_name']; ?> 👋</h2>

        <!-- 🔔 ALERTS -->
        <?php if (!empty($alerts)) { ?>
            <div class="alert-container">
                <?php foreach ($alerts as $a) { ?>
                    <div class="alert <?= $a['type']; ?>">
                        <?= $a['msg']; ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <!-- 🔹 DASHBOARD ACTIONS -->
        <div class="dashboard-grid">
            <a href="apply_pension.php" class="dash-card">📄 Apply for Pension</a>
            <a href="my_application.php" class="dash-card">📊 My Application Status</a>

            <a href="profile.php" class="dash-card">👤 My Profile</a>
            <a href="upload_life_certificate.php" class="dash-card">📤 Upload Life Certificate</a>

            <a href="pension_history.php" class="dash-card">💰 Pension History</a>
            <a href="raise_complaint.php" class="dash-card">📝 Raise Complaint</a>
            <a href="chatbot.php" class="dash-card">💬 Help Bot</a>

        </div>

        <hr style="margin:15px 0;">

        <h3>Your Pension Details</h3>

        <?php if ($pension) { ?>
            <table border="1" cellpadding="10" width="100%">
                <tr>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Last Updated</th>
                </tr>
                <tr>
                    <td>₹ <?php echo $pension['amount']; ?></td>
                    <td><?php echo $pension['status']; ?></td>
                    <td><?php echo $pension['updated_at']; ?></td>
                </tr>
            </table>
             <?php if ($nextPaymentDate) { ?>
            <div class="alert info">
        📅 <strong>Next Pension Payment Date:</strong> <?= $nextPaymentDate ?>
           </div>
           <?php } ?>

             
            <a href="pension_slip.php" class="dash-btn">📄 Download Pension Slip</a>
            <a href="pension_history_pdf.php" class="dash-btn">📄 Download Pension History PDF</a>

        <?php } else { ?>
            <p style="color:#666;">
                Pension not approved yet. Please apply and upload documents.
            </p>
        <?php } ?>

        <br>
        <a href="logout.php" class="dash-btn logout">🚪 Logout</a>

    </div>
</div>

</body>
</html>
