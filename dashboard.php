<?php
// Start session if you want to track users
session_start();

// Include PostgreSQL database connection
require_once 'database.php';

// Function to fetch a student by email
function getStudentByEmail($conn, $email) {
    $sql = "SELECT * FROM students WHERE email = $1"; // $1 is placeholder for pg_query_params
    $result = pg_query_params($conn, $sql, array($email));
    if ($result && pg_num_rows($result) > 0) {
        return pg_fetch_assoc($result);
    }
    return false;
}

// Handle POST request (login form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        $student = getStudentByEmail($conn, $email);

        if ($student && password_verify($password, $student['password'])) {
            // Check payment and subscription
            if ($student['payment_status'] === 'paid' && $student['subscription_status'] === 'true') {
                $_SESSION['student_email'] = $student['email'];
                $_SESSION['program_id'] = $student['program_id'];

                // Redirect based on program
                if ($student['program_id'] == 1) {
                    header('Location: smns_dashboard.php');
                    exit();
                } elseif ($student['program_id'] == 2) {
                    header('Location: beng_dashboard.php');
                    exit();
                } else {
                    $error = "Unknown program assigned to your account.";
                }
            } else {
                $error = "Your payment is unpaid or subscription has expired. Contact support.";
            }
        } else {
            $error = "Invalid login credentials.";
        }
    }
}

// Display login form (or error messages)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 90%;
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #003366;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background-color: #0044cc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0033aa;
        }
        .error {
            background-color: #dc3545;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p style="text-align:center; margin-top:10px;">
            <a href="index.php">Back to Homepage</a>
        </p>
    </div>
</body>
</html>                exit();
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
