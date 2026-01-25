<?php
include "../db.php";

/* FILE DOWNLOAD HEADERS */
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=pension_report.csv");

/* OPEN OUTPUT STREAM */
$output = fopen("php://output", "w");

/* CSV HEADER */
fputcsv($output, ["Month", "Status", "Total Amount"]);

/* FETCH DATA */
$result = mysqli_query(
    $conn,
    "SELECT month_year, status, SUM(amount) AS total
     FROM pension_history
     GROUP BY month_year, status
     ORDER BY month_year"
);

/* WRITE ROWS */
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['month_year'],
        $row['status'],
        $row['total']
    ]);
}

fclose($output);
exit();
