<?php
session_start();
include "db.php";

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
    "SELECT * FROM pension_history 
     WHERE user_id=$user_id 
     ORDER BY created_at DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pension History</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="page-bg">
<div class="admin-container">
<h2>Monthly Pension History</h2>

<table class="admin-table">
<tr>
    <th>Month</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Credited Date</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['month_year'] ?></td>
    <td>₹<?= $row['amount'] ?></td>
    <td><?= $row['status'] ?></td>
    <td><?= $row['credited_date'] ?></td>
</tr>
<?php } ?>

</table>
</div>
</div>

</body>
</html>
