<?php
// Start session to ensure user authentication is managed
session_start();

// Include database configuration file
require_once 'database.php';

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php?error=You must log in first!");
    exit();
}

// Retrieve the user's email from the session
$email = $_SESSION['user_email'];

// SQL query to retrieve the user's payment and subscription status
$sql = "SELECT subscription_status, payment_status FROM students WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 1) {
    // Fetch the user's data
    $user = mysqli_fetch_assoc($result);

    // Check payment status
    $paymentStatus = trim(strtolower($user['payment_status']));
    
    if ($paymentStatus !== 'paid') {
        // User has not paid; show access denied page
        $fullname = htmlspecialchars($_SESSION['user_name']);
        renderAccessDeniedPage($fullname);
    } else {
        // User has paid; show the courses page
        renderCoursesPage();
    }
} else {
    // User not found, redirect to login page
    header("Location: login.php?error=User not found.");
    exit();
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

// Functions to render the different pages

function renderAccessDeniedPage($fullname) {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Access Denied</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
                color: #343a40;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .container {
                text-align: center;
                padding: 20px;
                border-radius: 8px;
                background-color: #ffffff;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 90%;
                max-width: 500px;
            }
            h1 {
                color: #dc3545;
            }
            p {
                font-size: 1.2em;
                margin: 20px 0;
            }
            .contact {
                font-weight: bold;
                color: #28a745;
            }
            a {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                color: white;
                background-color: #007bff;
                border-radius: 5px;
                text-decoration: none;
            }
            a:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Access Denied, ' . $fullname . '!</h1>
            <p>Your payment status is <strong>unpaid</strong>. Please make your full payment to access course materials.</p>
            <p>For assistance, contact your tutor at <span class="contact">0974353800</span>.</p>
            <a href="smns_dashboard.php">Return to Dashboard</a>
            <a href="payment.php">Go to Payment Page</a>
        </div>
    </body>
    </html>';
    exit();
}

function renderCoursesPage() {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SMNS(NQ) Courses</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            nav {
                background-color: #333;
                color: white;
                padding: 10px;
                text-align: center;
            }
            nav h1 {
                margin: 0;
            }
            section {
                margin: 20px;
                padding: 20px;
                background-color: white;
                text-align: center;
            }
            details {
                margin: 10px 0;
                width: 300px;
                margin-left: auto;
                margin-right: auto;
            }
            summary {
                font-weight: bold;
                cursor: pointer;
                background-color: #28A745;
                color: white;
                padding: 10px;
                border-radius: 5px;
            }
            summary:hover {
                background-color: #218838;
            }
            ul {
                list-style-type: none;
                padding-left: 0;
                margin-top: 10px;
            }
            ul li {
                margin: 5px 0;
            }
            ul li a {
                color: #333;
                text-decoration: none;
            }
            ul li a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>

        <!-- Navigation Bar -->
        <nav>
            <h1>SMNS(NQ) Courses</h1>
            <a href="smns_dashboard.php" style="color: white; text-decoration: underline;">Back to Dashboard</a>
        </nav>

        <!-- Course List -->
        <section>
            <h2>Select a Course</h2>

            <!-- Mathematics 110 -->
            <details>
                <summary>Mathematics 110 (MA110)</summary>
                <details>
                    <summary>Lecture Notes</summary>
                    <ul>
                        <li><a href="materials/smns/MA110/LECTURE 1-set-theory.pdf" download>Lecture 1 (PDF)</a></li>
                        <li><a href="materials/smns/MA110/LECTURE 2.pdf" download>Lecture 2 (PDF)</a></li>
                        <li><a href="materials/smns/MA110/LECTURE 3.pdf" download>Lecture 3 (PDF)</a></li>
                        <li><a href="materials/smns/MA110/LECTURE 4.pdf" download>Lecture 4 (PDF)</a></li>
                    </ul>
                </details>
                <details>
                    <summary>Lecture Videos</summary>
                    <ul>
                        <li><a href="https://www.youtube.com/watch?v=video1" target="_blank">Lecture Video 1</a></li>
                        <l         <li><a href="materials/smns/mathematics_past_paper_2.pdf" download>Past Paper 2 (PDF)</a></li>
                    </ul>
                </details>
            </details>

                        <!-- Physics 110 -->
            <details>
                <summary>Physics 110 (PH110)</summary>
                <details>
                    <summary>Lecture Notes</summary>
                    <ul>
                        <li><a href="materials/smns/PH110/LECTURE 1-Chemical Bonding.pdf" download>Lecture 1 (PDF)</a></li>
                        <li><a href="materials/smns/PH110/LECTURE 2.pdf" download>Lecture 2 (PDF)</a></li>
                        <li><a href="materials/smns/PH110/LECTURE 3.pdf" download>Lecture 3 (PDF)</a></li>
                        <li><a href="materials/smns/PH110/LECTURE 4.pdf" download>Lecture 4 (PDF)</a></li>
                    </ul>
                </details>
                <details>
                    <summary>Lecture Videos</summary>
                    <ul>
                        <li><a href="https://www.youtube.com/watch?v=video5" target="_blank">Lecture Video 1</a></li>
                        <li><a href="https://www.youtube.com/watch?v=video6" target="_blank">Lecture Video 2</a></li>
                    </ul>
                </details>
                <details>
                    <summary>Past Papers</summary>
                    <ul>
                        <li><a href="materials/smns/physics_past_paper_1.pdf" download>Past Paper 1 (PDF)</a></li>
                        <li><a href="materials/smns/physics_past_paper_2.pdf" download>Past Paper 2 (PDF)</a></li>
                    </ul>
                </details>
                <details>
                    <summary>Past Papers</summary>
                    <ul>
                        <li><a href="materials/smns/physics_past_paper_1.pdf" download>Past Paper 1 (PDF)</a></li>
                        </ul>
                </details>
            </details>

            <!-- Chemistry 110 -->
            <details>
                <summary>Chemistry 110 (CH110)</summary>
                <details>
                    <summary>Lecture Notes</summary>
                    <ul>
                        <li><a href="materials/smns/CH110/LECTURE 1-Chemical Bonding.pdf" download>Lecture 1 (PDF)</a></li>
                        <li><a href="materials/smns/CH110/LECTURE 2.pdf" download>Lecture 2 (PDF)</a></li>
                        <li><a href="materials/smns/CH110/LECTURE 3.pdf" download>Lecture 3 (PDF)</a></li>
                        <li><a href="materials/smns/CH110/LECTURE 4.pdf" download>Lecture 4 (PDF)</a></li>
                    </ul>
                </details>
                <details>
                    <summary>Lecture Videos</summary>
                    <ul>
                        <li><a href="https://www.youtube.com/watch?v=video5" target="_blank">Lecture Video 1</a></li>
                        <li><a href="https://www.youtube.com/watch?v=video6" target="_blank">Lecture Video 2</a></li>
                    </ul>
                </details>
                <details>
                    <summary>Past Papers</summary>
                    <ul>
                        <li><a href="materials/smns/chemistry_past_paper_1.pdf" download>Past Paper 1 (PDF)</a></li>
                        <li><a href="materials/smns/chemistry_past_paper_2.pdf" download>Past Paper 2 (PDF)</a></li>
                    </ul>
                </details>
            </details>
               

            <!-- Biology 110 -->
            <details>
                <summary>Biology 110 (BI110)</summary>
                <details>
                    <summary>Lecture Notes</summary>
                    <ul>
                        <li><a href="materials/smns/BI110/LECTURE 1-Biology Basics.pdf" download>Lecture 1 (PDF)</a></li>
                    </ul>
                </details>
                <details>
                    <summary>Lecture Videos</summary>
                    <ul>
                        <li><a href="https://www.youtube.com/watch?v=video7" target="_blank">Lecture Video 1</a></li>
                    </ul>
                </details>
            </details>
        </section>

    </body>
    </html>';
    exit();
}
?>
