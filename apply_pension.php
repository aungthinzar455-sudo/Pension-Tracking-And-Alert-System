<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['apply'])) {

    $userId = $_SESSION['user_id'];
    $type   = $_POST['pension_type'];

    // Upload folder
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir);
    }

    // Aadhaar upload
    $aadhaarName = time() . "_aadhaar_" . $_FILES['aadhaar']['name'];
    move_uploaded_file($_FILES['aadhaar']['tmp_name'], $uploadDir . $aadhaarName);

    // Bank proof upload
    $bankName = time() . "_bank_" . $_FILES['bank']['name'];
    move_uploaded_file($_FILES['bank']['tmp_name'], $uploadDir . $bankName);

    mysqli_query(
        $conn,
        "INSERT INTO pension_applications 
        (user_id, pension_type, aadhaar_file, bank_file)
        VALUES 
        ('$userId', '$type', '$aadhaarName', '$bankName')"
    );

    echo "<script>alert('Pension application submitted successfully');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Apply Pension</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="premium-bg">

    <div class="premium-form-card">

        <div class="form-header">
            <h2>Apply for Pension</h2>
            <p>Submit your application and required documents</p>
        </div>

        <form method="post" enctype="multipart/form-data" class="premium-form">

            <label>Pension Type</label>
            <select name="pension_type" required>
                <option value="">Select Pension Type</option>
                <option>Government</option>
                <option>Private</option>
                <option>Widow</option>
                <option>Disability</option>
            </select>

            <label>Upload Aadhaar Document</label>
            <div class="file-upload">
                <input type="file" name="aadhaar" accept=".pdf,.jpg,.png" required>
                <span>Choose file</span>
            </div>

            <label>Upload Bank Proof</label>
            <div class="file-upload">
                <input type="file" name="bank" accept=".pdf,.jpg,.png" required>
                <span>Choose file</span>
            </div>

            <button name="apply" class="premium-btn">
                Submit Application
            </button>

        </form>

    </div>

</div>


</body>
</html>
