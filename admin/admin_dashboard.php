<?php
session_start();   // ✅ ADD THIS LINE
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

<div class="admin-layout">

    <!-- SIDEBAR -->
    <div class="admin-sidebar">
        <h2 class="logo">🛡 Admin Panel</h2>

        <a class="active" href="dashboard.php">📊 Dashboard</a>
        <a href="reports.php">📈 View Reports & Statistics</a>
        <a href="analytics.php">📊 Analytics Dashboard</a>
        <a href="search_pensioners.php">👥 Manage Users</a>
    </div>

    <!-- MAIN -->
    <div class="admin-main">

        <div class="admin-card">

            <h2>Admin – Pension Management</h2>

            <div class="admin-actions">
                <a href="reports.php" class="btn-primary">📊 View Reports</a>
                <a href="analytics.php" class="btn-primary">📈 Analytics Dashboard</a>
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
                    <a href='view_profile.php?user_id=".$row['id']."'>View</a>
                    <a href='view_user_dashboard.php?user_id=".$row['id']."'>Dashboard</a>
                    <a href='send_alert.php?user_id=".$row['id']."'>Alert</a>
                    <a href='add_pension_history.php'>History</a>
                    <a href='life_certificates.php'>Certificates</a>
                    <a href='tax_report.php'>Tax</a>
                    <a class='delete' href='delete_user.php?id=".$row['id']."'>Delete</a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </table>

        </div>

    </div>

</div>

</body>
</html>
