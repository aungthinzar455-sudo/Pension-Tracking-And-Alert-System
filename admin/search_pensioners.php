<?php
include "../db.php";

$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';

$query = "
SELECT u.name, p.status, p.amount
FROM users u
LEFT JOIN pension p ON u.id = p.user_id
WHERE u.name LIKE '%$search%'
";

if ($status != '') {
    $query .= " AND p.status='$status'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Pensioners</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="admin-page">
<div class="admin-container">
<h2>Search & Filter Pensioners</h2>

<form method="get">
    <input type="text" name="search" placeholder="Search by name">
    <select name="status">
        <option value="">All Status</option>
        <option>Active</option>
        <option>Suspended</option>
        <option>Stopped</option>
    </select>
    <button>Search</button>
</form>

<table class="admin-table">
<tr>
    <th>Name</th>
    <th>Status</th>
    <th>Amount</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['status'] ?></td>
    <td><?= $row['amount'] ?></td>
</tr>
<?php } ?>

</table>
</div>
</div>

</body>
</html>
