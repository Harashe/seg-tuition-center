<?php
// Get database credentials from environment variables
$host = getenv("DB_HOST") ?: die("DB_HOST not set");
$port = getenv("DB_PORT") ?: "5432";
$dbname = getenv("DB_NAME") ?: die("DB_NAME not set");
$user = getenv("DB_USER") ?: die("DB_USER not set");
$pass = getenv("DB_PASS") ?: die("DB_PASS not set");

// Build connection string
$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$pass";

// Create PostgreSQL connection
$conn = pg_connect($conn_string);

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error($conn));
}
?>
