<?php
session_start();
include "db.php";

$userId = $_SESSION['user_id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM pension_applications WHERE user_id=$userId"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Pension Application</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<h2>My Pension Application Status</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Pension Type</th>
    <th>Status</th>
    <th>Applied On</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['pension_type'] ?></td>
    <td><?= $row['status'] ?></td>
    <td><?= $row['applied_at'] ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>
