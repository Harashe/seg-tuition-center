<?php
session_start(); // Start the session

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require_once 'database.php'; // Make sure this file contains the connection details

// Check if the token is set in the URL
if (!isset($_GET['token'])) {
    echo "No verification token provided.";
    exit();
}

$token = $_GET['token'];

// Prepare a query to check the token in the pending_signups table
$sql = "SELECT * FROM pending_signups WHERE token = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $token);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$pendingUser = mysqli_fetch_assoc($result);

if ($pendingUser) {
    // Token is valid, now transfer the user information to the students table
    $email = $pendingUser['email'];
    $password = $pendingUser['password']; // Make sure this is hashed
    $created_at = $pendingUser['created_at'];

    // Insert the user into the students table
    $insertSql = "INSERT INTO students (email, password, created_at) VALUES (?, ?, ?)";
    $stmtInsert = mysqli_prepare($conn, $insertSql);
    mysqli_stmt_bind_param($stmtInsert, 'sss', $email, $password, $created_at);

    if (mysqli_stmt_execute($stmtInsert)) {
        // Successful insert, now delete the user from pending_signups
        $deleteSql = "DELETE FROM pending_signups WHERE token = ?";
        $stmtDelete = mysqli_prepare($conn, $deleteSql);
        mysqli_stmt_bind_param($stmtDelete, 's', $token);
        mysqli_stmt_execute($stmtDelete);

        // Display a success message
        echo "<h2>Account verified successfully!</h2>";
        echo "<p>Your account has been verified. Please <a href='login.php'>login</a> to access your course materials.</p>";
    } else {
        // Failed to insert into students table
        echo "<p>There was an error verifying your account. Please try again later.</p>";
    }

    // Close prepared statements
    mysqli_stmt_close($stmtInsert);
    mysqli_stmt_close($stmtDelete);

} else {
    // Invalid or expired token
    echo "<p>Invalid or expired token. Please check your verification email again.</p>";
}

// Close the database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
