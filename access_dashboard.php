<?php
session_start(); // Start a session

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'database.php'; // mysqli connection from database.php

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Basic input validation
    if (empty($email) || empty($password)) {
        header("Location: login.php?error=Both fields are required!");
        exit();
    }

    // Implement rate limiting (3 failed attempts max)
    if (isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] >= 3) {
        header("Location: login.php?error=Too many failed login attempts. Please try again later.");
        exit();
    }

    // SQL query to retrieve the user by email using mysqli
    $sql = "SELECT * FROM students WHERE email = ?";
    $stmt = $conn->prepare($sql); // Use $conn from the database.php file (mysqli)
    $stmt->bind_param('s', $email); // 's' denotes string type

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows === 1) {
        // Fetch student data
        $student = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $student['password'])) {
            // Regenerate session ID for security
            session_regenerate_id(true);

            // Set session variables
            $_SESSION['user_email'] = $student['email'];
            $_SESSION['user_name'] = htmlspecialchars($student['first_name']);

            // Check the program ID and redirect accordingly
            switch ($student['program_id']) {
                case 1:
                    header('Location: smns_dashboard.php'); // Redirect to SMNS dashboard
                    break;
                case 2:
                    header('Location: beng2_dashboard.php'); // Redirect to BENG2 dashboard
                    break;
                default:
                    echo "Invalid program ID.";
                    exit();
            }
            exit();
        } else {
            // Invalid password, increment failed attempts
            $_SESSION['failed_attempts'] = ($_SESSION['failed_attempts'] ?? 0) + 1;
            header("Location: login.php?error=Invalid password.");
            exit();
        }
    } else {
        // User not found
        header("Location: login.php?error=User not found. Please sign up.");
        exit();
    }
}
?>
