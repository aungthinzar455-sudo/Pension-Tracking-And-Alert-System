<?php
include "../db.php";

if (isset($_POST['send'])) {
    $user_id = $_POST['user_id'];
    $message = trim($_POST['message']);
    $type    = $_POST['type'];

    mysqli_query($conn,
        "INSERT INTO alerts (user_id, message, type)
         VALUES ('$user_id', '$message', '$type')"
    );

    echo "<script>alert('Alert sent successfully');</script>";
}

$users = mysqli_query($conn, "SELECT id, name FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Alert</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="admin-page">
<div class="admin-container">

<h2>🔔 Send Alert to User</h2>

<form method="post">
    <label>Select User</label>
    <select name="user_id" required>
        <?php while ($u = mysqli_fetch_assoc($users)) { ?>
            <option value="<?= $u['id'] ?>"><?= $u['name'] ?></option>
        <?php } ?>
    </select>

    <label>Alert Message</label>
    <textarea name="message" required></textarea>

    <label>Alert Type</label>
    <select name="type">
        <option value="info">Info</option>
        <option value="success">Success</option>
        <option value="warning">Warning</option>
        <option value="danger">Danger</option>
    </select>

    <button name="send">Send Alert</button>
</form>

</div>
</div>

</body>
</html>
