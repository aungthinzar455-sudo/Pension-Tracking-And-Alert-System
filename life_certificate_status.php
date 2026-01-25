<?php
session_start();
include "db.php";

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn,
    "SELECT * FROM life_certificates WHERE user_id=$user_id ORDER BY uploaded_at DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Life Certificate Status</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="page-bg">
<div class="admin-container">
<h2>Life Certificate Status</h2>

<table class="admin-table">
<tr>
    <th>Certificate</th>
    <th>Expiry Date</th>
    <th>Status</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><a href="<?= $row['certificate_file'] ?>" target="_blank">View</a></td>
    <td><?= $row['expiry_date'] ?></td>
    <td><?= $row['status'] ?></td>
</tr>
<?php } ?>

</table>
</div>
</div>

</body>
</html>
