<?php
include "../db.php";

/* Select financial year */
$year = $_GET['year'] ?? date("Y");

/* Fetch total pension for year */
$result = mysqli_query(
    $conn,
    "SELECT SUM(amount) AS total
     FROM pension_history
     WHERE YEAR(credited_date) = '$year'
     AND status = 'Credited'"
);

$data = mysqli_fetch_assoc($result);
$totalPension = $data['total'] ?? 0;

/* Basic tax logic (example rules) */
$exemptLimit = 300000;   // ₹3L exempt
$taxable = max(0, $totalPension - $exemptLimit);

/* Simple slab (demo purpose) */
$tax = 0;
if ($taxable > 0) {
    $tax = $taxable * 0.05; // 5% flat demo tax
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tax Summary Report</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="admin-page">
<div class="admin-container admin-wide">

<h2>🧾 Pension Tax Summary</h2>

<form method="get" style="margin-bottom:20px;">
    <label>Select Year</label>
    <select name="year" onchange="this.form.submit()">
        <?php for ($y = date("Y"); $y >= date("Y")-5; $y--) { ?>
            <option value="<?= $y ?>" <?= ($year==$y)?'selected':'' ?>>
                <?= $y ?>
            </option>
        <?php } ?>
    </select>
</form>

<table class="admin-table">
<tr>
    <th>Description</th>
    <th>Amount (₹)</th>
</tr>
<tr>
    <td>Total Pension Received</td>
    <td><?= number_format($totalPension) ?></td>
</tr>
<tr>
    <td>Exempted Amount</td>
    <td><?= number_format($exemptLimit) ?></td>
</tr>
<tr>
    <td>Taxable Amount</td>
    <td><?= number_format($taxable) ?></td>
</tr>
<tr>
    <td><strong>Estimated Tax</strong></td>
    <td><strong><?= number_format($tax) ?></strong></td>
</tr>
</table>

<p style="margin-top:15px; color:#555;">
⚠️ This is an estimated tax calculation for reference only.
</p>

</div>
</div>

</body>
</html>
