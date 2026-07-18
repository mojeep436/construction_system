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

$conn = new mysqli($host, $username, $password, $dbname, (int)$port);

/* ============================
   Check Connection
============================ */

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

/* ============================
   Set Charset (Important for Arabic support)
============================ */
$conn->set_charset("utf8mb4");

/* ============================
   Enable SSL for remote database connections (Render)
============================ */
if (getenv('DB_HOST') && getenv('DB_HOST') !== 'localhost') {
    // Most cloud MySQL providers require SSL
    $conn->ssl_set(NULL, NULL, NULL, NULL, NULL);
}

?>
