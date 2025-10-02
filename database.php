<?php
// Render PostgreSQL database connection
$host = "dpg-d3fd3o24d50c73a0i590-a";   // Replace with your Render host
$port = "5432";                               // PostgreSQL default port
$dbname = "seg_db";                  // Your database name
$user = "seg_db_user";                          // Your username
$pass = "ZG1hqzvV7MhD2G0KmRy1zZKqFYiIwTUx";                 // Your password

// Create PostgreSQL connection
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

// Check connection
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>
