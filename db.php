<?php
// Initialize the connection
$conn = mysqli_init();

// TiDB Cloud requires SSL for a secure connection
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL); 

// Get the 'Keys' from your Render Environment tab
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');
$port = getenv('DB_PORT');

// Establish the connection
$success = mysqli_real_connect(
    $conn, 
    $host, 
    $user, 
    $pass, 
    $db, 
    $port
);

if (!$success) {
    // If it fails, this will show the reason in your Render Logs
    error_log("Connection Error: " . mysqli_connect_error());
    die("Database connection failed. Please check the logs.");
}

// Success! Your $conn variable is now ready to use for queries.
?>
