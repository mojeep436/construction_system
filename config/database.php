<?php

/* ============================
   Database Configuration
   Reads from environment variables for deployment
   Falls back to local defaults for development
============================ */

$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'construction_system';
$username = getenv('DB_USERNAME') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$port = getenv('DB_PORT') ?: '3306';

/* ============================
   Create Database Connection
============================ */

$conn = mysqli_init();

// Enable SSL for remote database connections (Render)
$flags = 0;
if ($host !== 'localhost') {
    // Most cloud MySQL providers require SSL
    $conn->ssl_set(NULL, NULL, NULL, NULL, NULL);
    $flags = MYSQLI_CLIENT_SSL;
}

// Connect
if (!$conn->real_connect($host, $username, $password, $dbname, (int)$port, NULL, $flags)) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

/* ============================
   Set Charset (Important for Arabic support)
============================ */
$conn->set_charset("utf8mb4");

?>
