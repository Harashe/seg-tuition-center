<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webbook</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional if you decide to use an external stylesheet -->
</head>
<body>
    <header>
        <div class="container">
            <h1>Webbook: DC Circuits</h1>
            <nav>
                <ul>
                    <!-- Adjusted logo size using embedded CSS -->
                    <img src="/test/media/seg_logo.webp" class="logo">
                    <li><a href="/index.php">Home</a></li>
                    <li><a href="/test/dc-circuits.php">DC Circuits</a></li>
                    <li><a href="/test/resources.php">Resources</a></li>
                    <li><a href="/test/about.php">About</a></li>
                    <li><a href="/test/contacts.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #3498db;
            color: white;
            padding: 1rem 0;
        }

        header h1 {
            text-align: center;
            margin: 0;
        }

        nav ul {
            list-style: none;
            text-align: center;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 1rem;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        /* CSS for the logo */
        .logo {
            width: 100px; /* Set desired width */
            height: auto; /* Maintain aspect ratio */
            display: inline-block; /* Ensures the image aligns properly */
            vertical-align: middle; /* Aligns the image with the navigation items */
        }
    </style>
</body>
</html>
