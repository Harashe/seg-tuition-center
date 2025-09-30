<?php
session_start(); // Start the session

// Include the MySQL database connection
require_once 'database.php'; // Ensure this path is correct

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php?error=You must log in first!");
    exit();
}

// Retrieve the user's information
$email = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMNS Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user-info {
            position: relative;
            display: inline-block;
        }
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }
        .dropdown {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 10px;
            z-index: 1;
        }
        .dropdown a {
            display: block;
            padding: 8px;
            text-decoration: none;
            color: #333;
        }
        .dropdown a:hover {
            background-color: #f4f4f4;
        }

        /* Ensure the dropdown stays visible when clicked */
        .dropdown.show {
            display: block;
        }
                /* Grid container for courses */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Adjust column count based on screen width */
            gap: 20px;
            padding: 20px;
            margin: 20px;
        }

        /* Styling for individual course containers */
        .course-container {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-height: 300px;
            text-align: left;
        }

        h2 {
            margin-top: 0;
            font-size: 1.2em;
        }

        .container {
            width: 100%;
            max-width: 800px;
            background-color: rgba(255, 255, 255, 0.85);
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 20px auto;
            max-height: 70vh;
            overflow-y: auto;
            text-align: left;
    </style>
</head>
<body>
    <header>
        <h1>B.ENG 2 Dashboard</h1>
        
        <!-- User info section with dropdown -->
        <div class="user-info">
            <img src="images/user_icon.webp" alt="User Icon" id="avatar" /> <!-- Placeholder image for head icon -->
            <span id="user-email"><?php echo $email; ?></span> <!-- Display user email -->
            
            <!-- Dropdown menu -->
            <div class="dropdown" id="dropdown-menu">
                <a href="logout.php">Logout</a> <!-- Link to the logout page -->
            </div>
        </div>
    </header>
    
    <section>
        <!-- Link to access materials -->
        <div class="container">
         <p>This is where you can access your courses and materials for Bachelor Of Engineering.</p>
            <a href="beng2.php">Click here to access your course materials</a>
        </div>
    </section>

    <script>
        // JavaScript to handle dropdown behavior on click
        const avatar = document.getElementById('avatar');
        const userEmail = document.getElementById('user-email');
        const dropdownMenu = document.getElementById('dropdown-menu');

        // Toggle the dropdown visibility on click
        avatar.addEventListener('click', function() {
            dropdownMenu.classList.toggle('show');
        });

        userEmail.addEventListener('click', function() {
            dropdownMenu.classList.toggle('show');
        });

        // Close the dropdown when clicking outside of it
        window.addEventListener('click', function(event) {
            if (!event.target.matches('#avatar') && !event.target.matches('#user-email')) {
                if (dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                }
            }
        });
    </script>

        <!-- Please Note container -->
        <div class="container">
            <h2>Please Note the Following:</h2>
            <p>They say Bachelor of Engineering (NQ) is the hardest year at CBU. Well, that is absolutely true due to the pressure lecturers put on you. Nevertheless, you are stronger than those fears, and you came here to win and not to lose.</p>
        </div>
        
        <!-- Grid container for additional courses -->
        <div class="courses-grid">
            <!-- Course 1: Engineering Mathematics MA210 -->
            <div class="course-container">
                <h2>ENGINEERING MATHEMATICS MA210</h2>
                <p>This Course covers topics in Calculus and part of matrices</p>
                <p>That is:</p>
                <ul>
                    <li>Differentiation</li>
                    <li>Integration</li>
                    <li>Differential Equations</li>
                    <li>Matrices</li>
                </ul>
            </div>

            <!-- Course 2: APPLIED COMPUTING CS211 -->
            <div class="course-container">
                <h2>APPLIED COMPUTING CS211</h2>
                <p>Course description goes here...</p>
            </div>

            <!-- Course 3: STATICS & DYNAMICS EG231 -->
            <div class="course-container">
                <h2>STATICS & DYNAMICS EG231</h2>
                <p>Course description goes here...</p>
            </div>

            <!-- Course 4: ELECTRICITY AND ELECTRONICS EE220 -->
            <div class="course-container">
                <h2>ELECTRICITY AND ELECTRONICS EG220</h2>
                <p>Course description goes here...</p>
            </div>

            <!-- Course 5: ENGINEERING MEASUREMENTS EG232 -->
            <div class="course-container">
                <h2>ENGINEERING MEASUREMENTS EG232</h2>
                <p>Course description goes here...</p>
            </div>
        </div>
    </section>
</body>
</html>
