<?php
include "../db.php";
include "../send_mail.php";
include "../log_activity.php";

if (isset($_POST['add'])) {
    $user_id = $_POST['user_id'];
    $month = $_POST['month'];
    $amount = $_POST['amount'];
    $status = $_POST['status'];
    $date = $_POST['date'];

    mysqli_query($conn,
        "INSERT INTO pension_history 
         (user_id, month_year, amount, status, credited_date)
         VALUES ('$user_id','$month','$amount','$status','$date')"
    );

    logActivity(
    $conn,
    'Admin',
    $_SESSION['admin_id'],
    "Credited pension ₹$amount for $month",
    $user_id
);


    // 🔔 EMAIL ALERT WHEN PENSION IS CREDITED
    if ($status === "Credited") {

        $userRes = mysqli_query(
            $conn,
            "SELECT name, email FROM users WHERE id='$user_id'"
        );
        $user = mysqli_fetch_assoc($userRes);

        $subject = "Pension Credited – ".$month;

        $message = "
        <h2>Dear ".$user['name'].",</h2>

        <p>
        We are happy to inform you that your <b>pension has been successfully credited</b>.
        </p>

        <table style='border-collapse:collapse;'>
            <tr><td><b>Month:</b></td><td>".$month."</td></tr>
            <tr><td><b>Amount:</b></td><td>₹ ".$amount."</td></tr>
            <tr><td><b>Credited On:</b></td><td>".$date."</td></tr>
        </table>

        <p>
        <a href='http://localhost:8080/pension_system/login.php'
        style='display:inline-block;
        padding:12px 22px;
        background:#16a34a;
        color:#ffffff;
        text-decoration:none;
        border-radius:6px;
        font-weight:600;'>
        View Dashboard
        </a>
        </p>

        <p>
        Regards,<br>
        <b>Pension Tracking & Alert Notification System</b>
        </p>
        ";

        sendMail($user['email'], $subject, $message);
    }

    echo "<script>alert('Pension history added');</script>";
}

$users = mysqli_query($conn, "SELECT id, name FROM users");
?>


<!DOCTYPE html>
<html>
<head>
    <title>Add Pension History</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="admin-page">
<div class="admin-container admin-narrow">
<h2>Add Monthly Pension</h2>

<form method="post">
    <label>Pensioner</label>
    <select name="user_id" required>
        <?php while ($u = mysqli_fetch_assoc($users)) { ?>
            <option value="<?= $u['id'] ?>"><?= $u['name'] ?></option>
        <?php } ?>
    </select>

    <label>Month (e.g. Jan 2026)</label>
    <input type="text" name="month" required>

    <label>Amount</label>
    <input type="number" name="amount" required>

    <label>Status</label>
    <select name="status">
        <option>Credited</option>
        <option>Pending</option>
        <option>Failed</option>
    </select>

    <label>Credited Date</label>
    <input type="date" name="date">

    <button name="add">Add Record</button>
</form>

</div>
</div>

</body>
</html>
