<?php
include "../db.php";

/* ===============================
   FRAUD CHECK – DUPLICATE BANK
================================ */
$fraudBank = mysqli_query(
    $conn,
    "SELECT account_no, COUNT(*) as total
     FROM pensioner_profile
     GROUP BY account_no
     HAVING total > 1"
);
/* ===============================
   FRAUD CHECK – MULTIPLE FAILURES
================================ */
$fraudFailure = mysqli_query(
    $conn,
    "SELECT user_id, COUNT(*) as failures
     FROM pension_history
     WHERE status='Failed'
     GROUP BY user_id
     HAVING failures >= 3"
);

/* ===============================
   FRAUD CHECK – DUPLICATE BANK
================================ */
$fraudBank = mysqli_query(
    $conn,
    "SELECT account_no, COUNT(*) as total
     FROM pensioner_profile
     GROUP BY account_no
     HAVING total > 1"
);


/* TOTAL PAID */
$paid = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(amount) AS total FROM pension_history WHERE status='Credited'"
));

/* TOTAL PENDING */
$pending = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(amount) AS total FROM pension_history WHERE status='Pending'"
));

/* MONTHLY REPORT (FOR TABLE) */
$monthly = mysqli_query(
    $conn,
    "SELECT month_year, 
            SUM(amount) as total_amount,
            status
     FROM pension_history
     GROUP BY month_year, status"
);

/* MONTHLY REPORT (FOR BAR CHART – PAID ONLY) */
$monthlyChart = mysqli_query(
    $conn,
    "SELECT month_year, SUM(amount) as total_amount
     FROM pension_history
     WHERE status='Credited'
     GROUP BY month_year
     ORDER BY month_year"
);

$months = [];
$amounts = [];

while ($row = mysqli_fetch_assoc($monthlyChart)) {
    $months[]  = $row['month_year'];
    $amounts[] = $row['total_amount'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pension Reports</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

<div class="admin-page">
<div class="admin-container admin-wide">

<h2>📊 Pension Reports & Statistics</h2>
<div class="admin-actions">
    <a href="export_reports.php" class="admin-report-btn">
        📥 Export Report (CSV)
    </a>
</div>

<!-- SUMMARY BOXES -->
<div class="report-cards">
    <div class="report-card paid">
        <h3>Total Paid</h3>
        <p>₹ <?= $paid['total'] ?? 0 ?></p>
    </div>

    <div class="report-card pending">
        <h3>Total Pending</h3>
        <p>₹ <?= $pending['total'] ?? 0 ?></p>
    </div>
</div>

<?php if (mysqli_num_rows($fraudBank) > 0) { ?>
    <div class="alert danger">
        🚨 <strong>Fraud Alert:</strong> Duplicate bank accounts detected!
        <ul style="margin-top:8px;">
            <?php while ($f = mysqli_fetch_assoc($fraudBank)) { ?>
                <li>
                    Account No: <?= $f['account_no'] ?> 
                    (<?= $f['total'] ?> pensioners)
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>


<?php if (mysqli_num_rows($fraudFailure) > 0) { ?>
    <div class="alert warning">
        ⚠️ <strong>Risk Alert:</strong> Users with repeated pension failures detected.
    </div>
<?php } ?>

<h3 style="margin-top:30px;">📊 Pension Charts</h3>

<div class="charts-grid">

    <div class="chart-card">
        <h4>Paid vs Pending</h4>
        <div class="chart-wrapper">
            <canvas id="pensionChart"></canvas>
        </div>
    </div>

    <div class="chart-card">
        <h4>Monthly Paid Pension</h4>
        <div class="chart-wrapper">
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>

</div>




<table class="admin-table">
<tr>
    <th>Month</th>
    <th>Status</th>
    <th>Total Amount</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($monthly)) { ?>
<tr>
    <td><?= $row['month_year'] ?></td>
    <td><?= $row['status'] ?></td>
    <td>₹ <?= $row['total_amount'] ?></td>
</tr>
<?php } ?>
</table>

</div>
</div>

<script>
const ctx = document.getElementById('pensionChart');
new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Paid', 'Pending'],
        datasets: [{
            data: [
                <?= $paid['total'] ?? 0 ?>,
                <?= $pending['total'] ?? 0 ?>
            ],
            backgroundColor: ['#22c55e', '#f59e0b']
        }]
    },
    options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            position: 'top'
        }
    }
}
});
</script>
 <script>
const barCtx = document.getElementById('monthlyChart');

new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($months) ?>,
        datasets: [{
            label: 'Total Pension Paid (₹)',
            data: <?= json_encode($amounts) ?>,
            backgroundColor: '#6366f1'
        }]
    },
    options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: { display: false }
    },
    scales: {
        y: {
            beginAtZero: true,
            ticks: {
                stepSize: 5000
            }
        }
    }
}

});
</script>


</body>
</html>
