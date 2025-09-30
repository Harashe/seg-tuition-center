<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMNS Supplementary Support</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .dropdown {
            background-color: #333;
            color: white;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .dropdown-content {
            display: none;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
        }
        .dropdown-content a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            margin: 5px 0;
        }
        .dropdown-content a:hover {
            background-color: #ddd;
        }
        .iframe-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }
        iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
    </style>
    <script>
        function toggleDropdown(id) {
            var content = document.getElementById(id);
            content.style.display = content.style.display === 'block' ? 'none' : 'block';
        }

        function loadMaterial(filePath) {
            document.getElementById('material-frame').src = filePath;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>SMNS Supplementary Support</h1>
        
        <div class="dropdown" onclick="toggleDropdown('ma110')">MA110 SUP</div>
        <div id="ma110" class="dropdown-content">
            <a href="#" onclick="loadMaterial('materials/sup/smns/ma110/revisionnotes.pdf')">Revision Notes</a>
            <a href="#" onclick="toggleDropdown('ma110-solved')">Solved Question Papers</a>
            <div id="ma110-solved" class="dropdown-content">
                <a href="#" onclick="loadMaterial('materials/sup/smns/ma110/2019_solutions.pdf')">2019 solutions</a>
                <a href="#" onclick="loadMaterial('materials/sup/smns/ma110/2020_solutions.pdf')">2020 solutions</a>
            </div>
            <a href="#" onclick="loadMaterial('path/to/your/video_example_drive_link.mp4')">Revision Videos</a>
        </div>
        
        <div class="dropdown" onclick="toggleDropdown('ph110')">PH110 SUP</div>
        <div id="ph110" class="dropdown-content">
            <a href="#" onclick="loadMaterial('materials/sup/smns/ph110/revisionnotes.pdf')">Revision Notes</a>
            <a href="#" onclick="toggleDropdown('ph110-solved')">Solved Question Papers</a>
            <div id="ph110-solved" class="dropdown-content">
                <a href="#" onclick="loadMaterial('materials/sup/smns/ph110/2019_solutions.pdf')">2019 solutions</a>
                <a href="#" onclick="loadMaterial('materials/sup/smns/ph110/2020_solutions.pdf')">2020 solutions</a>
            </div>
            <a href="#" onclick="loadMaterial('path/to/your/video_example_drive_link.mp4')">Revision Videos</a>
        </div>
        
        <div class="dropdown" onclick="toggleDropdown('ch110')">CH110 SUP</div>
        <div id="ch110" class="dropdown-content">
            <a href="#" onclick="loadMaterial('materials/sup/smns/ch110/revisionnotes.pdf')">Revision Notes</a>
            <a href="#" onclick="toggleDropdown('ch110-solved')">Solved Question Papers</a>
            <div id="ch110-solved" class="dropdown-content">
                <a href="#" onclick="loadMaterial('materials/sup/smns/ch110/2019_solutions.pdf')">2019 solutions</a>
                <a href="#" onclick="loadMaterial('materials/sup/smns/ch110/2020_solutions.pdf')">2020 solutions</a>
            </div>
            <a href="#" onclick="loadMaterial('path/to/your/video_example_drive_link.mp4')">Revision Videos</a>
        </div>

        <!-- Iframe container for displaying PDF and video content -->
        <div class="iframe-container">
            <iframe id="material-frame" src="" title="Material Display"></iframe>
        </div>
    </div>
</body>
</html>
