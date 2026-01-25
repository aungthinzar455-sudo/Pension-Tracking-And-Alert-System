<?php
session_start();
include "db.php";

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn,
    "SELECT * FROM complaints WHERE user_id=$user_id ORDER BY created_at DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Complaints</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="page-bg">
<div class="admin-container">
    <h2>My Complaints</h2>

    <table class="admin-table">
        <tr>
            <th>Subject</th>
            <th>Status</th>
            <th>Admin Reply</th>
            <th>Date</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['subject'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['admin_reply'] ?? '—' ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
</div>

</body>
</html>
