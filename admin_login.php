<?php
session_start(); // Start the session to manage user state

// Database connection
require_once 'database.php'; // Include your database connection script

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $secret_code = $_POST['secret_code'];

    // Validate credentials against the admin table
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ? AND secret_code = ?");
    $stmt->bind_param("sss", $email, $password, $secret_code);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin) {
        $_SESSION['admin_logged_in'] = true; // Set session variable
        header('Location: admin_dashboard.php'); // Redirect to dashboard
        exit();
    } else {
        $error_message = "Access Denied! You're not an admin. <a href='index.php'>Click here to signup or login as a student</a>";
    }

    $stmt->close(); // Close the statement
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Admin Login</title>
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
            margin-top: 10px;
        }
        input {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome Admin</h2>
    <p>Please input your credentials to continue</p>

    <?php if (isset($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="secret_code" placeholder="Secret Code" required>
        <button type="submit">Confirm</button>
    </form>
</div>

</body>
</html>
