<?php
include "../db.php";

if (isset($_POST['verify'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    mysqli_query($conn,
        "UPDATE life_certificates SET status='$status' WHERE id=$id"
    );
}

$result = mysqli_query($conn,
    "SELECT lc.*, u.name FROM life_certificates lc
     JOIN users u ON lc.user_id = u.id
     ORDER BY uploaded_at DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Life Certificates</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="admin-page">
<div class="admin-container">
<h2>Life Certificate Verification</h2>

<table class="admin-table">
<tr>
    <th>User</th>
    <th>Certificate</th>
    <th>Expiry</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<form method="post">
    <td><?= $row['name'] ?></td>
    <td><a href="../<?= $row['certificate_file'] ?>" target="_blank">View</a></td>
    <td><?= $row['expiry_date'] ?></td>
    <td>
        <select name="status">
            <option <?= $row['status']=="Pending"?"selected":"" ?>>Pending</option>
            <option <?= $row['status']=="Valid"?"selected":"" ?>>Valid</option>
            <option <?= $row['status']=="Expired"?"selected":"" ?>>Expired</option>
        </select>
    </td>
    <td>
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <button name="verify">Update</button>
    </td>
</form>
</tr>
<?php } ?>

</table>
</div>
</div>

</body>
</html>
