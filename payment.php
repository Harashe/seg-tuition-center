<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start a session

// Include database configuration file
require_once 'database.php'; // Make sure this file has $host, $user, $password, and $dbname variables

// Establish a connection with MySQL using MySQLi
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Retrieve the student's payment status
$email = $_SESSION['user_email'] ?? null;
if ($email) {
    $sql = "SELECT payment_status FROM students WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameter and execute the query
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);

    // Fetch the result
    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);

    if ($student) {
        $paymentStatus = strtolower(trim($student['payment_status']));
    } else {
        echo "Student data not found.";
        exit();
    }
} else {
    header("Location: login.php?error=Please log in to proceed with payment.");
    exit();
}

// Handle form submission for payment confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedMethod = $_POST['payment_method'] ?? null;
    $amountPaid = $_POST['amount_paid'] ?? null;
    $phoneNumber = $_POST['phone_number'] ?? null;

    if ($selectedMethod && $amountPaid && $phoneNumber) {
        // Update payment status to 'pending'
        $sqlUpdate = "UPDATE students SET payment_status = 'pending' WHERE email = ?";
        $stmtUpdate = mysqli_prepare($conn, $sqlUpdate);
        mysqli_stmt_bind_param($stmtUpdate, 's', $email);
        mysqli_stmt_execute($stmtUpdate);

        // Display confirmation message with WhatsApp link to upload receipt
        echo "<h2>Payment confirmed!</h2>";
        echo "<p>Your payment status is now: <strong>Pending</strong>.</p>";
        echo "<p>Please upload your payment receipt via WhatsApp.</p>";
        
        // WhatsApp link
        $whatsappMessage = urlencode("Hello, I've made my payment. Here are my details:\nEmail: $email\nAmount Paid: $amountPaid\nPhone Number: $phoneNumber");
        echo '<a href="https://wa.me/+260974353800?text=' . $whatsappMessage . '" class="upload-btn">Click here to upload your receipt via WhatsApp</a>';
        exit();
    } else {
        echo "Please complete all fields.";
    }
}

// Close the MySQLi connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="styles.css"> <!-- Make sure your custom styles are here -->
    <style>
        /* Basic resets */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: url('images/finances.jpg') no-repeat center center fixed; 
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .payment-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            width: 100%;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        h1 {
            margin-bottom: 20px;
            color: #f5ba1a;
        }

        form {
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #f5ba1a;
        }

        input[type="text"],
        input[type="radio"] {
            margin-bottom: 15px;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #f5ba1a;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #f79e0d;
        }

        .upload-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #25D366;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .upload-btn:hover {
            background-color: #1eb941;
        }

        p {
            margin: 10px 0;
        }

        .note {
            font-size: 14px;
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h1>Make a Payment</h1>

        <?php if ($paymentStatus === 'paid') : ?>
            <p>Your payment status is: <strong>Paid</strong>.</p>
            <p>No outstanding balance. Thank you!</p>
        <?php else : ?>
            <p>Your payment status is: <strong><?php echo ucfirst($paymentStatus); ?></strong>.</p>

            <form action="payment.php" method="POST">
                <h3>Select Mobile Money Payment Method:</h3>
                <label>
                    <input type="radio" name="payment_method" value="airtel" required>
                    Airtel Money (0974353800)
                </label>
                <br>
                <label>
                    <input type="radio" name="payment_method" value="mtn" required>
                    MTN Money (0769750580)
                </label>
                <br><br>

                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required>
                <br><br>

                <label for="amount_paid">Amount Paid (ZMW):</label>
                <input type="text" id="amount_paid" name="amount_paid" required>
                <br><br>

                <button type="submit">Confirm Payment</button>
            </form>

            <p class="note">Once you've made the payment, take a screenshot of your receipt and send it via WhatsApp using the link below:</p>

            <!-- WhatsApp button -->
            <a href="https://wa.me/+260974353800?text=I%20have%20made%20the%20payment,%20here%20are%20my%20details." class="upload-btn">Click to upload via WhatsApp</a>
        <?php endif; ?>
    </div>
</body>
</html>

