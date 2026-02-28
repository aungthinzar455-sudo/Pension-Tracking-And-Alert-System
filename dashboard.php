<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM pension WHERE user_id = $user_id");
$pension = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="portal-header">
    <div class="logo-area">
        <img src="assets/images/logo.png" class="logo">
        <div>
            <h2>Pensioners Portal</h2>
            <small>Government of India</small>
        </div>
    </div>

    <div class="header-buttons">
        Welcome, <?php echo $_SESSION['user_name'] ?? 'User'; ?>
    </div>
</header>

<!-- NAVBAR -->
<nav class="main-navbar">
    <a href="#about">About Us</a>
    <a href="#services">Pension</a>
    <a href="#circulars">Circulars</a>
    <a href="#citizens">Citizens</a>
    <a href="#grievance">Grievance</a>
    <a href="#faq">FAQs</a>
    <a href="#contact">Contact</a>
</nav>

<!-- NOTICE -->
<div class="notice-bar">
    🔔 Central Civil Services Pension Rules Updated — Check latest circulars
</div>


<h2 class="dashboard-title">Dashboard</h2>
<div class="hero-combined">

    <!-- LEFT SLIDER -->
    <div class="hero-slider">

    <div class="slide active">
        <img src="assets/images/banner1.png" alt="Banner">
    </div>

    <div class="slide">
        <img src="assets/images/banner2.png" alt="Banner">
    </div>

    <div class="slide">
        <img src="assets/images/banner3.png" alt="Banner">
    </div>

</div>

    <!-- RIGHT TEXT -->
    <div class="hero-text">

        <h2>Pension Tracking System</h2>

        <p>
            The Pension Tracking System is a secure digital platform designed to
            simplify pension management for citizens and administrators. Users can
            apply for schemes, track applications in real time, and manage records efficiently.
        </p>

        <ul>
            <li>✔ Easy online pension application</li>
            <li>✔ Real-time application tracking</li>
            <li>✔ Secure document storage</li>
            <li>✔ Faster approval process</li>
        </ul>

    </div>

</div>


<div class="dashboard-wrapper">


<script>
let slides = document.querySelectorAll(".slide");
let index = 0;

function showSlide(){
    slides.forEach(s => s.classList.remove("active"));
    slides[index].classList.add("active");
    index = (index + 1) % slides.length;
}
setInterval(showSlide, 3500);
</script>

<div class="dashboard-cards">
    <a href="apply_pension.php" class="dash-card">Apply for Pension</a>
    <a href="my_application.php" class="dash-card">Application Status</a>
    <a href="profile.php" class="dash-card">My Profile</a>
    <a href="upload_life_certificate.php" class="dash-card">Life Certificate</a>
    <a href="pension_history.php" class="dash-card">Pension History</a>
    <a href="raise_complaint.php" class="dash-card">Raise Complaint</a>
    <a href="chatbot.php" class="dash-card">Help Bot</a>
</div>

<div class="details-card">
<h3>Your Pension Details</h3>

<?php if (!empty($pension)) { ?>

<table class="styled-table">
<tr>
<th>Amount</th>
<th>Status</th>
<th>Last Updated</th>
<th>Deduction</th>
</tr>

<tr>
<td>₹ <?= $pension['amount']; ?></td>
<td><?= $pension['status']; ?></td>
<td><?= $pension['updated_at']; ?></td>
<td>₹ <?= $pension['deduction'] ?? 0; ?></td>
</tr>
</table>

<?php if (isset($pension['next_payment_date']) && !empty($pension['next_payment_date'])) { ?>
<div class="alert info">
📅 Next Payment Date: <?= $pension['next_payment_date']; ?>
</div>
<?php } ?>

<a href="pension_slip.php" class="btn-primary">Download Pension Slip</a>
<a href="pension_history_pdf.php" class="btn-primary">Download History</a>

<?php } else { ?>
<p>Pension not approved yet.</p>
<?php } ?>

</div>

<a href="logout.php" class="logout-btn">Logout</a>

<!-- SIMPLE INFO SECTION -->
<section id="about" class="info-section">
<h3>About Pensioners Portal</h3>
<p>
The Pensioners Portal provides an easy way for retired employees to manage pension services,
track payments, submit life certificates, and raise complaints online.
</p>
</section>

<section id="services" class="info-section">
<h3>Pension Services</h3>
<p>Apply for pension, check application status, view payment history, and download pension slips.</p>
</section>

<section id="circulars" class="info-section">
<h3>Latest Updates</h3>
<p>Stay informed about new pension rules, notifications, and government announcements.</p>
</section>

<section id="citizens" class="info-section">
<h3>Citizen Support</h3>
<p>Access online services designed to simplify pension management for retired employees.</p>
</section>

<section id="grievance" class="info-section">
<h3>Grievance Help</h3>
<p>Submit complaints and track resolution status easily through the portal.</p>
</section>


<!-- FAQ -->
<div class="faq-section" id="faq">
<h3>Frequently Asked Questions</h3>

<details>
<summary>Who can apply for pension through this portal?</summary>
Retired government employees eligible under pension rules can apply.
</details>

<details>
<summary>How can I check my pension payment details?</summary>
Login to dashboard and view Pension History section.
</details>

<details>
<summary>Is it mandatory to upload life certificate every year?</summary>
Yes, submission of life certificate ensures uninterrupted pension payments.
</details>

<details>
<summary>How can I raise a complaint?</summary>
Use Raise Complaint option in dashboard.
</details>
</div>

<!-- CONTACT -->
<section id="contact" class="info-section">
<h3>Contact Information</h3>
<p>Email: support@pensionportal.gov.in</p>
<p>Helpline: 1800-123-456</p>
<p>Working Hours: Mon–Fri 9:30 AM to 5:30 PM</p>
</section>

</div>

</body>
</html>
