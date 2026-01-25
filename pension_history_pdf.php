<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Fetch pension history */
$result = mysqli_query($conn,
    "SELECT month_year, amount, status, credited_date
     FROM pension_history
     WHERE user_id = $user_id
     ORDER BY credited_date DESC"
);

/* Fetch user */
$user = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT name, email FROM users WHERE id=$user_id")
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pension History Report</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

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

        .report-box {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .user-info {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

        th {
            background: #6366f1;
            color: white;
        }

        .btn {
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

<div class="print-area">
<div class="report-box">

    <h2>📊 Pension History Statement</h2>

    <div class="user-info">
        <b><?= $user['name'] ?></b> |
        <?= $user['email'] ?><br>
        Generated on <?= date("d M Y") ?>
    </div>

    <table>
        <tr>
            <th>Month</th>
            <th>Amount (₹)</th>
            <th>Status</th>
            <th>Credited Date</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['month_year']}</td>";
                echo "<td>{$row['amount']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>{$row['credited_date']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No pension history available</td></tr>";
        }
        ?>
    </table>

    <button onclick="window.print()" class="btn no-print">
        📥 Download PDF
    </button>

</div>
</div>

</body>
</html>
