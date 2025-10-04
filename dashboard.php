<?php
// Enable full PHP error reporting (debug mode)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the PostgreSQL database connection
require 'database.php';

// Check if connection is successful
if (!$conn) {
    die("Database connection failed: " . pg_last_error());
}

// Process login only if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement using pg_prepare / pg_execute for safety
    $result = pg_prepare($conn, "login_query", "SELECT * FROM students WHERE email = $1");
    $result = pg_execute($conn, "login_query", array($email));

    if ($result && pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Check subscription & payment
            if ($user['subscription_status'] === 'true' && $user['payment_status'] === 'paid') {
                // Redirect based on program
                if ($user['program_id'] == 1) {
                    header('Location: smns_dashboard.php');
                } elseif ($user['program_id'] == 2) {
                    header('Location: beng_dashboard.php');
                }
                exit();
            } else {
                echo "Your payment status is unpaid or your subscription has expired. Please contact support.";
            }
        } else {
            echo "Invalid login credentials.";
        }
    } else {
        echo "No user found with this email.";
    }
} else {
    echo "Please submit the login form.";
}
?>}
?>
