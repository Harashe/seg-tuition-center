<?php
include '../test/includes/header.php';
session_start(); // Start the session to manage user state


// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: admin_login.php'); // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Admin Dashboard</title>
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
        button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 0;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
        .logout {
            background-color: #DC3545; /* Red for logout */
        }
        .logout:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome Admin</h2>
    <button onclick="window.location.href='payment_status_update.php'">Confirm Student Payment Status</button>
    <button onclick="window.location.href='https://dash.infinityfree.com/accounts'">Connect to Database</button>
    <button class="logout" onclick="window.location.href='logout.php'">Logout</button>
</div>

</body>
</html>
