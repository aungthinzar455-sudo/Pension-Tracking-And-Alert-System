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

<div style="
    min-height:100vh;
    background:linear-gradient(135deg,#e0f2fe,#f8fafc);
    padding:40px;
">

    <div style="
        max-width:1100px;
        margin:auto;
        background:white;
        padding:35px;
        border-radius:18px;
        box-shadow:0 20px 60px rgba(0,0,0,0.12);
    ">

        <!-- HEADER -->
        <div style="margin-bottom:25px;">
            <h2 style="color:#1e3a8a;margin-bottom:5px;">
                Monthly Pension History
            </h2>
            <p style="color:#64748b;">
                View your monthly credited pension records
            </p>
        </div>


        <!-- TABLE -->
        <table style="
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:12px;
        ">

            <thead>
                <tr style="
                    background:linear-gradient(135deg,#2563eb,#06b6d4);
                    color:white;
                    text-align:left;
                ">
                    <th style="padding:14px;">Month</th>
                    <th style="padding:14px;">Amount</th>
                    <th style="padding:14px;">Status</th>
                    <th style="padding:14px;">Credited Date</th>
                </tr>
            </thead>

            <tbody>

            <?php while ($row = mysqli_fetch_assoc($result)) { 

                $statusColor = "#16a34a"; // default success

                if ($row['status'] == "Pending") $statusColor = "#f59e0b";
                if ($row['status'] == "Failed") $statusColor = "#dc2626";

            ?>

            <tr style="
                border-bottom:1px solid #f1f5f9;
                transition:0.2s;
            "
            onmouseover="this.style.background='#f8fafc'"
            onmouseout="this.style.background='white'">

                <td style="padding:14px;font-weight:500;">
                    <?= $row['month_year'] ?>
                </td>

                <td style="padding:14px;font-weight:600;color:#1e293b;">
                    ₹<?= $row['amount'] ?>
                </td>

                <td style="padding:14px;">
                    <span style="
                        background:<?= $statusColor ?>22;
                        color:<?= $statusColor ?>;
                        padding:6px 12px;
                        border-radius:999px;
                        font-weight:600;
                        font-size:13px;
                    ">
                        <?= $row['status'] ?>
                    </span>
                </td>

                <td style="padding:14px;color:#475569;">
                    <?= $row['credited_date'] ?>
                </td>

            </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>
