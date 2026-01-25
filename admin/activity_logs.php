<?php
include "../db.php";

$result = mysqli_query(
    $conn,
    "SELECT a.*, u.name 
     FROM activity_logs a
     LEFT JOIN users u ON a.target_user_id = u.id
     ORDER BY a.created_at DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Activity Logs</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="admin-page">
<div class="admin-container admin-wide">

<h2>🕒 System Activity Logs</h2>

<table class="admin-table">
<tr>
    <th>Role</th>
    <th>Action</th>
    <th>Target User</th>
    <th>Date & Time</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['actor_role'] ?></td>
    <td><?= $row['action'] ?></td>
    <td><?= $row['name'] ?? '-' ?></td>
    <td><?= $row['created_at'] ?></td>
</tr>
<?php } ?>

</table>

</div>
</div>

</body>
</html>
