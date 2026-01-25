<?php
session_start();
include "../db.php";

// (Optional) Admin login check later

$result = mysqli_query(
    $conn,
    "SELECT p.*, u.name 
     FROM pension_applications p
     JOIN users u ON p.user_id = u.id"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin – Pension Verification</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="admin-page">
    <div class="admin-container admin-wide">

        <h2 class="admin-title">Pension Applications</h2>

        <table class="admin-table">
            <tr>
                <th>User</th>
                <th>Pension Type</th>
                <th>Aadhaar</th>
                <th>Bank Proof</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['pension_type'] ?></td>

                <td>
                    <a href="../uploads/<?= $row['aadhaar_file'] ?>" target="_blank">
                        View
                    </a>
                </td>

                <td>
                    <a href="../uploads/<?= $row['bank_file'] ?>" target="_blank">
                        View
                    </a>
                </td>

                <td><?= $row['status'] ?></td>

                <td>
                    <a href="update_pension.php?user_id=<?= $row['user_id'] ?>">
                        Update Pension
                    </a>
                    |
                    <a href="update_status.php?id=<?= $row['id'] ?>&status=Approved">
                        Approve
                    </a>
                    |
                    <a href="update_status.php?id=<?= $row['id'] ?>&status=Rejected">
                        Reject
                    </a>
                </td>
            </tr>
            <?php } ?>

        </table>

    </div>
</div>

</body>
</html>
