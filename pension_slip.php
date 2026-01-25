<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Fetch user + pension info */
$query = mysqli_query($conn, "
    SELECT u.name, u.email, p.amount, p.status, p.updated_at
    FROM users u
    JOIN pension p ON u.id = p.user_id
    WHERE u.id = $user_id
");

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pension Slip</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* PRINT STYLE */
        @media print {
            body * {
                visibility: hidden;
            }

            .print-area, .print-area * {
                visibility: visible;
            }

            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none;
            }
        }

        .slip-box {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .slip-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .slip-table {
            width: 100%;
            border-collapse: collapse;
        }

        .slip-table th,
        .slip-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .slip-table th {
            background: #6366f1;
            color: #fff;
        }

        .download-btn {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: #22c55e;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="page-bg">
<div class="print-area">

    <div class="slip-box">
        <h2>📄 Pension Payment Slip</h2>

        <table class="slip-table">
            <tr>
                <th>Pensioner Name</th>
                <td><?= $data['name'] ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= $data['email'] ?></td>
            </tr>
            <tr>
                <th>Pension Amount</th>
                <td>₹ <?= $data['amount'] ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= $data['status'] ?></td>
            </tr>
            <tr>
                <th>Last Updated</th>
                <td><?= $data['updated_at'] ?></td>
            </tr>
        </table>

        <p style="margin-top:15px; font-size:13px; color:#555;">
            This is a system-generated pension slip.
        </p>

        <button onclick="window.print()" class="download-btn no-print">
            📥 Download as PDF
        </button>
    </div>

</div>
</div>

</body>
</html>
