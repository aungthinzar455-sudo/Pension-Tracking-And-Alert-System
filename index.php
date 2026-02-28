<!DOCTYPE html>
<html>
<head>
<title>Pensioners Portal</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="topbar">
    Government of India | Ministry of Pension & Welfare
</div>

<header class="portal-header">
    <div class="logo-area">
        <img src="assets/images/logo.png" class="logo">
        <div>
            <h2>Pensioners' Portal</h2>
            <small>Department of Pension & Pensioners' Welfare</small>
        </div>
    </div>

    <div class="header-buttons">
        <a href="login.php" class="btn-primary">Login</a>
        <a href="register.php" class="btn-secondary">Register</a>
    </div>
</header>

<nav class="navbar">
    <a href="#">Home</a>
    <a href="#">About</a>
    <a href="#">Pension</a>
    <a href="#">Circulars</a>
    <a href="#">Grievance</a>
    <a href="#">FAQs</a>
    <a href="#">Contact</a>
</nav>

<div class="notice-bar">
    🔔 Central Civil Services Pension Rules Updated — Check latest circulars
</div>

<!-- ✅ SLIDER ADDED -->
<div class="slider">
    <img class="slide active" src="assets/images/banner1.png">
    <img class="slide" src="assets/images/banner2.png">
    <img class="slide" src="assets/images/banner3.png">
</div>

<section class="services">
    <h3>Quick Services</h3>

    <div class="service-grid">
        <div class="service-card">Apply for Pension</div>
        <div class="service-card">Track Status</div>
        <div class="service-card">Life Certificate</div>
        <div class="service-card">Grievance</div>
        <div class="service-card">Download Forms</div>
        <div class="service-card">Helpdesk</div>
    </div>
</section>

<section class="faq">
    <h3>Frequently Asked Questions</h3>

    <details>
        <summary>How to apply for pension?</summary>
        Apply online through dashboard after login.
    </details>

    <details>
        <summary>How to upload life certificate?</summary>
        Go to dashboard → Upload Life Certificate.
    </details>

    <details>
        <summary>How to track application?</summary>
        Use My Application Status page.
    </details>
</section>

<footer class="footer">
    © 2026 Government Pension Portal | All Rights Reserved
</footer>

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

</body>
</html>

