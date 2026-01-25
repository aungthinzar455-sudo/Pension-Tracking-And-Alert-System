<?php
session_start();
include "../db.php";

/* Admin check can be added later */
if (!isset($_GET['user_id'])) {
    die("User ID missing");
}

$user_id = (int) $_GET['user_id'];

/* Fetch user info */
$user = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT name, email FROM users WHERE id=$user_id"
));

/* Fetch pension */
$pension = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM pension WHERE user_id=$user_id"
));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin – View User Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="admin-page">
<div class="admin-container admin-wide">

<h2>👤 User Dashboard (Admin View)</h2>

<p><b>Name:</b> <?= $user['name'] ?></p>
<p><b>Email:</b> <?= $user['email'] ?></p>

<hr>

<h3>Pension Details</h3>

<?php if ($pension) { ?>
<table class="admin-table">
    <tr>
        <th>Amount</th>
        <th>Status</th>
        <th>Last Updated</th>
    </tr>
    <tr>
        <td>₹ <?= $pension['amount'] ?></td>
        <td><?= $pension['status'] ?></td>
        <td><?= $pension['updated_at'] ?></td>
    </tr>
</table>
<?php } else { ?>
<p style="color:#666;">No pension record yet.</p>
<?php } ?>

<hr>

<h3>Quick Actions</h3>
<a href="update_pension.php?user_id=<?= $user_id ?>" class="dash-btn">
    ✏️ Update Pension
</a>

<a href="add_pension_history.php?user_id=<?= $user_id ?>" class="dash-btn">
    ➕ Add Pension History
</a>

</div>
</div>

</body>
</html>
