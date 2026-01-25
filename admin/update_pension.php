<?php
include "../db.php";

/* 🔐 SAFETY CHECK */
if (!isset($_GET['user_id'])) {
    die("Invalid request. user_id missing.");
}

$user_id = (int) $_GET['user_id'];

/* SAVE PENSION DETAILS */
if (isset($_POST['save'])) {

    $amount = $_POST['amount'];
    $status = $_POST['status'];

    // Check if pension already exists
    $check = mysqli_query(
        $conn,
        "SELECT id FROM pension WHERE user_id=$user_id"
    );

    if (mysqli_num_rows($check) > 0) {

        // Update existing
        mysqli_query(
            $conn,
            "UPDATE pension 
             SET amount='$amount', status='$status', updated_at=NOW()
             WHERE user_id=$user_id"
        );

    } else {

        // Insert new
        mysqli_query(
            $conn,
            "INSERT INTO pension (user_id, amount, status, updated_at)
             VALUES ($user_id, '$amount', '$status', NOW())"
        );
    }

    header("Location: admin_pension_verify.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Pension Details</title>
</head>
<body>

<h2>Update Pension Details</h2>

<form method="post">
    <label>Pension Amount</label><br>
    <input type="number" name="amount" required><br><br>

    <label>Status</label><br>
    <select name="status">
        <option value="Pending">Pending</option>
        <option value="Active">Active</option>
        <option value="Stopped">Stopped</option>
    </select><br><br>

    <button type="submit" name="save">Save</button>
</form>

</body>
</html>
