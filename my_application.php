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

<div style="min-height:100vh;background:linear-gradient(135deg,#e0f2fe,#f8fafc);padding:40px;">

    <div style="max-width:950px;margin:auto;background:white;border-radius:18px;
                box-shadow:0 25px 60px rgba(0,0,0,0.12);padding:30px;">

        <h2 style="color:#1e3a8a;margin-bottom:5px;">My Pension Application Status</h2>
        <p style="color:#64748b;margin-bottom:25px;">
            Track your submitted pension applications
        </p>

        <table style="width:100%;border-collapse:collapse;font-size:15px;">

            <thead>
                <tr style="background:#1e3a8a;color:white;">
                    <th style="padding:14px;text-align:left;">Pension Type</th>
                    <th style="padding:14px;text-align:left;">Status</th>
                    <th style="padding:14px;text-align:left;">Applied On</th>
                </tr>
            </thead>

            <tbody>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <tr style="border-bottom:1px solid #e5e7eb;">

                    <td style="padding:14px;font-weight:600;">
                        <?= $row['pension_type'] ?>
                    </td>

                    <td style="padding:14px;">
                        <?php
                        $status = strtolower($row['status']);
                        $bg = '#fef9c3';
                        $color = '#ca8a04';

                        if($status=='approved'){
                            $bg='#dcfce7'; $color='#15803d';
                        }
                        if($status=='rejected'){
                            $bg='#fee2e2'; $color='#b91c1c';
                        }
                        ?>
                        <span style="background:<?= $bg ?>;
                                     color:<?= $color ?>;
                                     padding:6px 12px;
                                     border-radius:20px;
                                     font-weight:600;">
                            <?= $row['status'] ?>
                        </span>
                    </td>

                    <td style="padding:14px;">
                        <?= date("d M Y", strtotime($row['applied_at'])) ?>
                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>
