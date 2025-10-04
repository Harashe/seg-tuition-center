<?php
// Include the PostgreSQL database connection
require 'database.php';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare SQL query using placeholders ($1)
    $sql = "SELECT * FROM students WHERE email = $1";
    $result = pg_prepare($conn, "fetch_user", $sql);
    $result = pg_execute($conn, "fetch_user", [$email]);

    // Fetch user as associative array
    $user = pg_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Check the payment and subscription status
        if ($user['subscription_status'] === 'true' && $user['payment_status'] === 'paid') {
            // Redirect based on program_id
            if ($user['program_id'] == 1) {
                header('Location: smns_dashboard.php');
            } elseif ($user['program_id'] == 2) {
                header('Location: beng_dashboard.php');
            } else {
                echo "Unknown program. Contact support.";
            }
            exit();
        } else {
            echo "<p>Your payment status is unpaid or your subscription has expired. Please contact support.</p>";
        }
    } else {
        echo "<p>Invalid login credentials.</p>";
    }
}
?>
