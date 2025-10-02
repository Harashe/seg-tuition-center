<?php
// Get database credentials from environment variables
$host = getenv("DB_HOST");
$port = getenv("DB_PORT") ?: "5432";   // default port
$dbname = getenv("DB_NAME");
$user = getenv("DB_USER");
$pass = getenv("DB_PASS");

// Create PostgreSQL connection
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>
