<?php
// 1. Initialize MySQLi
$conn = mysqli_init();

// 2. THE FIX: Force the connection to use SSL (Secure Transport)
// This is required by TiDB Cloud to prevent data from being intercepted.
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);

// 3. Get your credentials from Render Environment Variables
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');
$port = getenv('DB_PORT');

// 4. Connect using the SSL-enabled object
$success = mysqli_real_connect(
    $conn, 
    $host, 
    $user, 
    $pass, 
    $db, 
    $port,
    NULL,
    MYSQLI_CLIENT_SSL // This flag tells PHP to use a secure connection
);

if (!$success) {
    error_log("Connection Error: " . mysqli_connect_error());
    die("Database connection failed. Please check back later.");
}

// Success! Your $conn is now secure and ready.
?>
