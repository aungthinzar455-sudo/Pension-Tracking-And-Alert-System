<?php
include "../db.php";
include "../log_activity.php";

if (isset($_SESSION['admin_id'])) {
    logActivity(
        $conn,
        'Admin',
        $_SESSION['admin_id'],
        'Accessed admin dashboard'
    );
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="admin-page">
<div class="admin-container">

<h2>Admin – Pension Management</h2>

<div class="admin-actions">
    <a href="reports.php" class="admin-report-btn">
        📊 View Reports & Statistics
    </a>
    <a href="analytics.php" class="dash-card">
📊 Analytics Dashboard (Power BI)
</a>
</div>


<table class="admin-table">
    <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

    <?php
    $result = mysqli_query($conn, "SELECT * FROM users");

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
     echo "<td>
    <a href='view_profile.php?user_id=".$row['id']."'>View Profile</a> |
    <a href='view_user_dashboard.php?user_id=".$row['id']."'>View Dashboard</a> |
    <a href='send_alert.php?user_id=".$row['id']."'>Send Alert</a> |
    <a href='search_pensioners.php'>Search Pensioners</a> |
    <a href='add_pension_history.php'>Add Pension History</a> |
    <a href='life_certificates.php'>Life Certificates</a> |
    <a href='tax_report.php'>Tax Summary</a> |
    <a href='delete_user.php?id=".$row['id']."'
       onclick=\"return confirm('Are you sure you want to delete this user?');\"
       style='color:red;'>Delete</a>
</td>";


        echo "</tr>";
    }
    
    ?>
</table>

</div>
</div>

</body>