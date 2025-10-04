<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include PostgreSQL connection
require_once 'database.php'; // uses $conn (pg_connect)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Basic validation
    if (empty($email) || empty($password)) {
        $error = "Both fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Fetch user from PostgreSQL
        $query = "SELECT password, first_name, last_name, subscription_status, payment_status, program_id 
                  FROM students WHERE email = $1";
        $result = pg_query_params($conn, $query, [$email]);

        if ($result && pg_num_rows($result) > 0) {
            $user = pg_fetch_assoc($result);

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['email'] = $email;
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['program_id'] = $user['program_id'];
                $_SESSION['subscription_status'] = $user['subscription_status'];
                $_SESSION['payment_status'] = $user['payment_status'];

                // Redirect to dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No account found with this email.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Login</title>
<style>
    body { background-color: #f0f8ff; font-family: Arial, sans-serif; }
    .container { width: 50%; margin: auto; background-color: white; padding: 20px;
                 box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px; margin-top:50px; }
    h1 { text-align: center; color: #003366; }
    input[type="email"], input[type="password"] { width: 100%; padding: 12px; margin: 8px 0;
                                                 border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
    button { width: 100%; background-color: #0044cc; color: white; padding: 14px 20px; margin: 8px 0;
             border: none; border-radius: 4px; cursor: pointer; }
    button:hover { background-color: #0033aa; }
    .error-msg { color: red; text-align: center; margin-bottom: 10px; }
</style>
</head>
<body>
<div class="container">
    <h1>Login to Your Account</h1>
    <?php if(isset($error)) echo "<div class='error-msg'>$error</div>"; ?>
    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
        <a href="index.php">Back to Homepage</a>
    </form>
</div>
</body>
</html>            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0033aa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login to Your Account</h1>
        <form method="POST" action="access_dashboard.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        
            <button type="submit">Login</button>
            <a href="index.php">Back to Homepage.</a>
        </form>
    </div>
</body>
</html>
