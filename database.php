<?php
// For MySQL (InfinityFree)
$host = 'sql204.infinityfree.com';  // Replace with the correct MySQL host provided by InfinityFree
$dbname = 'if0_37490309_seg_students_db';  // Replace with your actual database name
$user = 'if0_37490309';  // Replace with your MySQL username
$pass = 'Ssempt2002GMDB';  // Replace with your MySQL password

// Create MySQL connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "\nError Code: " . $conn->connect_errno);
}
?>