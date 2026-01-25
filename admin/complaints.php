<?php
include "../db.php";

if (isset($_POST['reply'])) {
    $id = $_POST['id'];
    $reply = $_POST['reply_text'];
    $status = $_POST['status'];

    mysqli_query($conn,
        "UPDATE complaints 
         SET admin_reply='$reply', status='$status'
         WHERE id=$id"
    );
}

$result = mysqli_query($conn, "SELECT * FROM complaints ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Complaints</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="admin-page">
<div class="admin-container">
    <h2>Complaint Management</h2>

    <table class="admin-table">
        <tr>
            <th>Subject</th>
            <th>Message</th>
            <th>Status</th>
            <th>Reply</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <form method="post">
                <td><?= $row['subject'] ?></td>
                <td><?= $row['message'] ?></td>
                <td>
                    <select name="status">
                        <option <?= $row['status']=="Open"?"selected":"" ?>>Open</option>
                        <option <?= $row['status']=="Resolved"?"selected":"" ?>>Resolved</option>
                    </select>
                </td>
                <td>
                    <textarea name="reply_text"><?= $row['admin_reply'] ?></textarea>
                </td>
                <td>
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button name="reply">Save</button>
                </td>
            </form>
        </tr>
        <?php } ?>
    </table>
</div>
</div>

</body>
</html>
