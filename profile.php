<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch profile
$result = mysqli_query($conn, "SELECT * FROM pensioner_profile WHERE user_id=$user_id");
$profile = mysqli_fetch_assoc($result);

// Fetch user photo
$userResult = mysqli_query($conn, "SELECT profile_photo FROM users WHERE id=$user_id");
$userData = mysqli_fetch_assoc($userResult);
$photo = !empty($userData['profile_photo']) ? $userData['profile_photo'] : "default.png";

// Handle form submit
if (isset($_POST['save'])) {

    $dob     = $_POST['dob'];
    $address = $_POST['address'];
    $aadhaar = $_POST['aadhaar'];
    $bank    = $_POST['bank'];
    $account = $_POST['account'];
    $ifsc    = $_POST['ifsc'];
    $retire  = $_POST['retire'];
    $ptype   = $_POST['ptype'];

    /* ===== PROFILE PHOTO UPLOAD ===== */
    if (!empty($_FILES['photo']['name'])) {

        $fileSize = $_FILES['photo']['size'];
        $fileType = mime_content_type($_FILES['photo']['tmp_name']);

        if ($fileSize > 2 * 1024 * 1024) {
            echo "<script>alert('Photo must be less than 2MB');</script>";
        }
        elseif (!in_array($fileType, ['image/jpeg', 'image/png', 'image/jpg'])) {
            echo "<script>alert('Only JPG and PNG images allowed');</script>";
        }
        else {
            $photoName = time() . "_" . basename($_FILES['photo']['name']);
            $tmpName   = $_FILES['photo']['tmp_name'];
            $folder    = "uploads/profile_photos/";

            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            move_uploaded_file($tmpName, $folder . $photoName);

            mysqli_query($conn,
                "UPDATE users SET profile_photo='$photoName' WHERE id=$user_id"
            );

            $photo = $photoName;
        }
    }

    /* ===== PROFILE DATA ===== */
    if ($profile) {
        mysqli_query($conn,
            "UPDATE pensioner_profile SET
                dob='$dob',
                address='$address',
                aadhaar_no='$aadhaar',
                bank_name='$bank',
                account_no='$account',
                ifsc_code='$ifsc',
                retirement_date='$retire',
                pension_type='$ptype'
             WHERE user_id=$user_id"
        );
    } else {
        mysqli_query($conn,
            "INSERT INTO pensioner_profile
            (user_id,dob,address,aadhaar_no,bank_name,account_no,ifsc_code,retirement_date,pension_type)
            VALUES
            ('$user_id','$dob','$address','$aadhaar','$bank','$account','$ifsc','$retire','$ptype')"
        );
    }

    echo "<script>alert('Profile saved successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pensioner Profile</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="profile-bg">
    <div class="profile-card">

        <form method="post" enctype="multipart/form-data" class="profile-form">

            <!-- PROFILE PHOTO -->
            <div class="profile-avatar">
                <img src="uploads/profile_photos/<?= $photo ?>" 
                     id="profilePreview"
                     onclick="document.getElementById('photoInput').click();">
                <span class="change-photo"
                      onclick="document.getElementById('photoInput').click();">📷</span>
            </div>

            <!-- HIDDEN FILE INPUT -->
            <input type="file" name="photo" id="photoInput" accept="image/*" hidden>

            <h2 class="profile-title">Pensioner Profile</h2>
            <p class="profile-sub">Manage your personal and pension details</p>

             <div class="form-section">
             <h3>Personal Information</h3>

            <label>Date of Birth</label>
            <input type="date" name="dob" value="<?= $profile['dob'] ?? '' ?>" required>

            <label>Address</label>
            <textarea name="address" class="address-box" required><?= $profile['address'] ?? '' ?></textarea>

            <label>Aadhaar Number</label>
            <input type="text" name="aadhaar" value="<?= $profile['aadhaar_no'] ?? '' ?>" required>

            </div>

            <div class="form-section">
            <h3>Bank Details</h3>

            <label>Bank Name</label>
            <input type="text" name="bank" value="<?= $profile['bank_name'] ?? '' ?>" required>

            <label>Account Number</label>
            <input type="text" name="account" value="<?= $profile['account_no'] ?? '' ?>" required>

            <label>IFSC Code</label>
            <input type="text" name="ifsc" value="<?= $profile['ifsc_code'] ?? '' ?>" required>

            <label>Retirement Date</label>
            <input type="date" name="retire" value="<?= $profile['retirement_date'] ?? '' ?>" required>

            <label>Pension Type</label>
            <select name="ptype" required>
                <option value="">Select Pension Type</option>
                <?php
                $types = ["Government","Private","Widow","Disability"];
                foreach ($types as $t) {
                    $sel = ($profile && $profile['pension_type']==$t) ? "selected" : "";
                    echo "<option $sel>$t</option>";
                }
                ?>
            </select>
            </div>
            <button name="save">Save Profile</button>

        </form>

    </div>
</div>

<!-- IMAGE PREVIEW + VALIDATION -->
<script>
document.getElementById('photoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    if (!file.type.startsWith('image/')) {
        alert('Please select an image file');
        e.target.value = '';
        return;
    }

    if (file.size > 2 * 1024 * 1024) {
        alert('Max image size is 2MB');
        e.target.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('profilePreview').src = reader.result;
    };
    reader.readAsDataURL(file);
});
</script>

</body>
</html>
