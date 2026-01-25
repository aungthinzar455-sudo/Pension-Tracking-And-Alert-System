<?php
include "../db.php";

$user_id = $_GET['id'];

// Delete related pension records first (important)
mysqli_query($conn, "DELETE FROM pension WHERE user_id = $user_id");

// Delete user
mysqli_query($conn, "DELETE FROM users WHERE id = $user_id");

header("Location: admin_dashboard.php");
exit();
?>
