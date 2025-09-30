<?php
session_start(); // Start the session to manage user state

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
require_once 'database.php'; // Make sure this file contains your mysqli connection

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_email = $_POST['student_email'];

    // Sanitize the email input
    $student_email = filter_var($student_email, FILTER_SANITIZE_EMAIL);

    // Check if the email is valid
    if (!filter_var($student_email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } else {
        // Retrieve the student's payment status, name, and number
        $select_stmt = $conn->prepare("SELECT payment_status, first_name, last_name, phone_number FROM students WHERE email = ?");
        $select_stmt->bind_param("s", $student_email);
        $select_stmt->execute();
        $select_stmt->store_result();

        if ($select_stmt->num_rows > 0) {
            // Bind the result
            $select_stmt->bind_result($current_payment_status, $first_name, $last_name, $phone_number);
            $select_stmt->fetch();
            $select_stmt->close();

            // Check if the payment status is already 'paid'
            if ($current_payment_status === 'paid') {
                $error_message = "Payment status is already 'Paid'. No need to update.";
            } else {
                // Update payment status to 'paid'
                $stmt = $conn->prepare("UPDATE students SET payment_status = 'paid' WHERE email = ?");
                
                if ($stmt) {
                    $stmt->bind_param("s", $student_email);

                    if ($stmt->execute()) {
                        if ($stmt->affected_rows > 0) {
                            $success_message = "Payment status updated successfully!";
                            // Generate the URL for whatsapp_update.php with the student's details
                            $whatsapp_url = "whatsapp_update.php?first_name=" . urlencode($first_name) .
                                            "&last_name=" . urlencode($last_name) .
                                            "&email=" . urlencode($student_email) .
                                            "&phone_number=" . urlencode($phone_number);
                        } else {
                            $error_message = "Failed to update payment status. Please check the email provided.";
                        }
                    } else {
                        $error_message = "Execution failed: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    die("MySQLi prepare failed: " . $conn->error);
                }
            }
        } else {
            $error_message = "Email not found in the system.";
            $select_stmt->close();
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Update Payment Status</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        input, button {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Payment Status</h2>

    <?php if (isset($success_message)): ?>
        <div class="success"><?php echo htmlspecialchars($success_message); ?></div>
        <a href="<?php echo $whatsapp_url; ?>"><button>Inform Student</button></a>
        <form action="admin_dashboard.php" method="get">
            <button type="submit">Exit to Admin Dashboard</button>
        </form>
    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
        <form action="admin_dashboard.php" method="get">
            <button type="submit">Exit to Admin Dashboard</button>
        </form>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="student_email" placeholder="Student Email" required>
        <button type="submit">Update</button>
    </form>
</div>

</body>
</html>
