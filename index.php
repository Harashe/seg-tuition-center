<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SEG Tuition Centre</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-image: url('images/background.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                color: white;
                position: relative;
                z-index: 1;
            }
            body::before {
                content: '';
                background-color: rgba(0, 0, 0, 0.5);
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
            }
            nav {
                width: 100%;
                background-color: rgba(0, 0, 0, 0.7);
                color: white;
                padding: 20px 0;
                text-align: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            nav h1 {
                margin: 0;
                font-size: 2rem;
            }
            .container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 80%;
                max-width: 1200px;
                margin: 50px auto;
                gap: 40px;
            }
            .description, .welcome-section {
                background-color: rgba(0, 0, 0, 0.7);
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                color: white;
                width: 50%;
            }
            .btn {
                display: block;
                padding: 15px 20px;
                background-color: #007BFF;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                margin: 10px auto;
                width: 80%;
                font-size: 1rem;
                transition: background-color 0.3s ease;
                text-align: center;
            }
            .btn:hover {
                background-color: #0056b3;
            }
            .btn-admin {
                background-color: #DC3545;
            }
            .btn-admin:hover {
                background-color: #c82333;
            }
            @media (max-width: 768px) {
                .container {
                    flex-direction: column;
                }
                .description, .welcome-section {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <nav>
            <h1>Welcome to SEG Tuition Centre</h1>
        </nav>

        <div class="container">
            <div class="description">
                <h2>About SEG Tuition Centre</h2>
                <p>At SEG Tuitions, we provide personalized academic support to university students, 
                specifically those in the School of Natural Sciences (SMNS) and the BEng 2 programs at CBU. 
                Our mission is to help students achieve academic excellence by offering targeted tutoring that focuses on 
                understanding complex concepts, improving problem-solving skills, and preparing for assessments. 
                Join us to boost your learning experience and excel in your studies!</p>
            </div>

            <div class="welcome-section">
                <h2>Enhance Your Learning Experience</h2>
                <p>Join us today and take your education to the next level.</p>
                <a href="signup.html" class="btn">Sign Up</a>
                <a href="login.php" class="btn">Log In</a>
                <a href="admin_login.php" class="btn btn-admin">Admin Login</a>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
