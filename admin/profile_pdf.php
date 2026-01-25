<?php
include "../db.php";

if (!isset($_GET['user_id'])) {
    die("User ID missing");
}

$user_id = intval($_GET['user_id']);

/* Fetch user */
$user = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT name, email, profile_photo FROM users WHERE id=$user_id")
);

/* Fetch profile */
$profile = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM pensioner_profile WHERE user_id=$user_id")
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pensioner Profile PDF</title>

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

        .pdf-box {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .photo {
            text-align: center;
            margin-bottom: 15px;
        }

        .photo img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 3px solid #6366f1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #6366f1;
            color: #fff;
            width: 35%;
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
<div class="pdf-box">

    <h2>👤 Pensioner Profile Report</h2>

    <div class="photo">
        <img src="../uploads/profile_photos/<?= $user['profile_photo'] ?? 'default.png' ?>">
    </div>

    <table>
        <tr><th>Name</th><td><?= $user['name'] ?></td></tr>
        <tr><th>Email</th><td><?= $user['email'] ?></td></tr>
        <tr><th>Date of Birth</th><td><?= $profile['dob'] ?? '-' ?></td></tr>
        <tr><th>Address</th><td><?= $profile['address'] ?? '-' ?></td></tr>
        <tr><th>Aadhaar No</th><td><?= $profile['aadhaar_no'] ?? '-' ?></td></tr>
        <tr><th>Bank Name</th><td><?= $profile['bank_name'] ?? '-' ?></td></tr>
        <tr><th>Account No</th><td><?= $profile['account_no'] ?? '-' ?></td></tr>
        <tr><th>IFSC Code</th><td><?= $profile['ifsc_code'] ?? '-' ?></td></tr>
        <tr><th>Retirement Date</th><td><?= $profile['retirement_date'] ?? '-' ?></td></tr>
        <tr><th>Pension Type</th><td><?= $profile['pension_type'] ?? '-' ?></td></tr>
    </table>

    <p style="margin-top:15px;font-size:13px;color:#555;">
        Generated on <?= date("d M Y") ?> • Pension Tracking & Alert Notification System
    </p>

    <button onclick="window.print()" class="btn no-print">
        📄 Download Profile PDF
    </button>

</div>
</div>

</body>
</html>
