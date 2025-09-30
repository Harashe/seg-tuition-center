<?php
//include 'includes/header.php';
//include 'includes/footer.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check for the request method
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Render the homepage for a GET request with a nice design
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>SEG Tuition Centre</title>
        <style>
            /* Existing styles */
            body {
                font-family: 'Arial', sans-serif;
                background-image: url('images/background.jpg'); /* Correct path to your image */
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
                background-color: rgba(0, 0, 0, 0.5); /* Optional overlay for better contrast */
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1; /* Keeps the background behind everything */
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
            .description {
                background-color: rgba(0, 0, 0, 0.7);
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                width: 50%;
                color: white;
            }
            .description h2 {
                font-size: 2rem;
                margin-bottom: 20px;
            }
            .description p {
                font-size: 1.1rem;
                line-height: 1.5;
            }
            .welcome-section {
                background-color: rgba(0, 0, 0, 0.7);
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                text-align: center;
                width: 50%;
                color: white;
            }
            .welcome-section h2 {
                margin-bottom: 20px;
                font-size: 1.5rem;
            }
            .welcome-section p {
                margin-bottom: 30px;
                font-size: 1rem;
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

            /* Modal Styles */
            .modal {
                display: none; /* Hidden by default */
                position: fixed;
                z-index: 100;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
            }
            .modal-content {
                background-color: white;
                color: black;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                width: 80%;
                max-width: 400px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            }
            .close-btn {
                position: absolute;
                top: 10px;
                right: 20px;
                font-size: 1.5rem;
                cursor: pointer;
                color: red;
            }
            .enabled-button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #007BFF;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 20px;
            }
            .enabled-button:hover {
                background-color: #0056b3;
            }
        </style>
        <script>
            // JavaScript to open and close the modal
            function openModal() {
                document.getElementById('maintenanceModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('maintenanceModal').style.display = 'none';
            }

            // Open modal on page load
            window.onload = function() {
                openModal();
            };
        </script>
    </head>
    <body>
        <nav>
            <h1>Welcome to SEG Tuition Centre</h1>
        </nav>

        <!-- Modal Popup for Maintenance Notice -->
        <!--div id='maintenanceModal' class='modal'-->
            <!--div class='modal-content'-->
                <!--span class='close-btn' onclick='closeModal()'>&times;</span-->
                <!--h2>System Under Maintenance</h2-->
                <!--p>The system is currently undergoing maintenance. Please access the free SUP materials below.</p-->
                <!--a href='sup.php' class='enabled-button'>Access SUP Materials</a-->
            <!--/div-->
        <!--</div-->

        <div class='container'>
            <div class='description'>
                <h2>About SEG Tuition Centre</h2>
                <p>At SEG Tuitions, we provide personalized academic support to university students, 
                specifically those in the School of Natural Sciences (SMNS) and the BEng 2 programs at CBU. 
                Our mission is to help students achieve academic excellence by offering targeted tutoring that focuses on 
                understanding complex concepts, improving problem-solving skills, and preparing for assessments. 
                Join us to boost your learning experience and excel in your studies!</p>
            </div>

            <div class='welcome-section'>
                <h2>Enhance Your Learning Experience</h2>
                <p>Join us today and take your education to the next level.</p>
                <a href='signup.html' class='btn'>Sign Up</a>
                <a href='login.php' class='btn'>Log In</a>
                <a href='admin_login.php' class='btn btn-admin'>Admin Login</a>
            </div>
        </div>
    </body>
    </html>";
} else {
    // Respond to non-GET requests
    echo json_encode(["message" => "Invalid request method"]);
}