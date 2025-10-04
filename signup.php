<?php
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the PostgreSQL database connection
require_once 'database.php'; // This uses $conn (pg_connect)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        .message-container {
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 16px;
            color: #fff;
            text-align: center;
            max-width: 500px;
            margin: 20px auto;
            line-height: 1.6;
        }
        .message-container.error { background-color: #dc3545; }
        .message-container.info { background-color: #28a745; }
        .message-container.success { background-color: #28a745; }
        .message-container a { color: #BF77BD; }
        .message-container img { vertical-align: middle; margin-right: 5px; max-width: 50px; height: auto; }
        .login-button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .click-here { color: #FFCC00; font-weight: bold; margin-right: 5px; }
    </style>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $program_id = $_POST['program'];

    // Basic validation
    if (empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($password) || empty($program_id)) {
        echo '<div class="message-container error">All fields are required!</div>';
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="message-container error">Invalid email format!</div>';
        exit();
    }

    // Check if email already exists
    $checkEmailQuery = 'SELECT * FROM students WHERE email = $1';
    $result = pg_query_params($conn, $checkEmailQuery, [$email]);

    if (pg_num_rows($result) > 0) {
        echo '<div class="message-container info">';
        echo "Hi $fname $lname, it seems you already have an account. ";
        echo ' Please<br> ';
        echo '<span class="click-here">Click here</span>';
        echo '<img src="images/pd.png" alt="Hand pointing right" width="30" height="30"> ';
        echo 'to log in to your account.<br>';
        echo '<a class="login-button" href="login.php">Login Here</a>';
        echo '</div>';
        exit();
    }

    // Insert new student
    $insertQuery = "INSERT INTO students (first_name, last_name, email, phone_number, payment_status, password, program_id, subscription_status, date_enrolled)
                    VALUES ($1, $2, $3, $4, 'unpaid', $5, $6, 'false', NOW())";

    $insertResult = pg_query_params($conn, $insertQuery, [$fname, $lname, $email, $phone, $password, $program_id]);

    if ($insertResult) {
        echo '<div class="message-container success">';
        echo "Congrats $fname $lname for taking your first step in your academic journey with SEG Tuitions! ";
        echo 'Please ';
        echo '<span class="click-here">Click here</span>';
        echo '<img src="images/pd.png" alt="Hand pointing down" width="30" height="30"> ';
        echo 'to log in to your account.<br>';
        echo '<a class="login-button" href="login.php">Login Here</a>';
        echo '</div>';
        exit();
    } else {
        echo '<div class="message-container error">Error: Unable to sign up. ' . pg_last_error($conn) . '</div>';
        exit();
    }
}
?>

</body>
</html>            vertical-align: middle; 
            margin-right: 5px; 
            max-width: 50px; /* Set max width for images */
            height: auto; /* Maintain aspect ratio */
        }
        .login-button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007BFF; /* Button color */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .click-here {
            color: #FFCC00; /* Color for "Click here" text */
            font-weight: bold;
            margin-right: 5px; /* Space between text and button */
        }
    </style>
</head>
<body>

<?php
// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieving the form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];  // New field
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $program_id = $_POST['program'];

    // Basic input validation
    if (empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($password) || empty($program_id)) {
        echo '<div class="message-container error">All fields are required!</div>';
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="message-container error">Invalid email format!</div>';
        exit();
    }

    // Check if the email already exists using mysqli
    $checkEmailSql = "SELECT * FROM students WHERE email = ?";
    $checkEmailStmt = $conn->prepare($checkEmailSql);
    $checkEmailStmt->bind_param('s', $email); // 's' denotes the parameter type (string)
    $checkEmailStmt->execute();
    $result = $checkEmailStmt->get_result();

    if ($result->num_rows > 0) {
        echo '<div class="message-container info">';
        echo "Hi $fname $lname, it seems you already have an account. ";
        echo ' Please<br> ';
        echo '<span class="click-here">   Click here</span>'; // Styled text
        echo '<img src="images/pd.png" alt="Hand pointing right" width="30" height="30"> '; // Adjust size here if needed
        echo 'to log in to your account.<br>';
        echo '<a class="login-button" href="login.php">Login Here</a>'; // Button for logging in
        echo '</div>';
        exit();
    }

    // SQL query to insert the data into the students table
    $sql = "INSERT INTO students (first_name, last_name, email, phone_number, payment_status, password, program_id, subscription_status, date_enrolled)
            VALUES (?, ?, ?, ?, 'unpaid', ?, ?, 'false', NOW())";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param('sssssi', $fname, $lname, $email, $phone, $password, $program_id);

    // Execute query
    if ($stmt->execute()) {
        echo '<div class="message-container success">';
        echo "Congrats $fname $lname for taking your first step in your academic journey with SEG Tuitions! ";
        echo 'Please ';
        echo '<span class="click-here">Click here</span>'; // Styled text
        echo '<img src="images/pd.png" alt="Hand pointing down" width="30" height="30"> '; // Adjust size here if needed
        echo 'to log in to your account.<br>';
        echo '<a class="login-button" href="login.php">Login Here</a>'; // Button for logging in
        echo '</div>';
        exit();
    } else {
        echo '<div class="message-container error">Error: Unable to sign up. ' . $stmt->error . '</div>';
        exit();
    }
}
?>

</body>
</html>
