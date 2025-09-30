<?php include '../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DC Circuits Webbook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        h1, h2, h3 {
            color: #2c3e50;
        }

        .chapter {
            margin-bottom: 2rem;
            padding: 1rem;
            border-left: 4px solid #3498db;
            background: #f9f9f9;
        }

        .chapter h2 {
            color: #3498db;
        }

        blockquote {
            font-size: 1.2rem;
            font-style: italic;
            background: #ecf0f1;
            padding: 1rem;
            border-left: 4px solid #2980b9;
        }

        .resources ul {
            list-style: square;
            padding-left: 1.5rem;
        }
    </style>
</head>
<body>
    <!-- DC Circuits Webbook -->
    <section id="dc-circuits">
        <div class="container">
            <h1>DC Circuit Analysis</h1>
            <p>Welcome to the summarized webbook on DC Circuit Analysis! Here you'll learn the basics of analyzing direct current (DC) circuits with practical examples and links to online resources.</p>

            <!-- Chapter 1: Introduction -->
            <div class="chapter">
                <h2>Chapter 1: Basics of DC Circuits</h2>
                <p>DC circuits involve current that flows in a single direction. Key concepts include voltage, current, and resistance. The relationship between these is defined by Ohm's Law:</p>
                <blockquote><strong>Ohm's Law:</strong> \( V = IR \)</blockquote>
                <p>Where:
                    <ul>
                        <li>\( V \) = Voltage (Volts)</li>
                        <li>\( I \) = Current (Amps)</li>
                        <li>\( R \) = Resistance (Ohms)</li>
                    </ul>
                </p>
                <p><a href="https://www.circuitlab.com/" target="_blank">Try building a circuit online with CircuitLab</a></p>
            </div>

            <!-- Chapter 2: Series and Parallel Circuits -->
            <div class="chapter">
                <h2>Chapter 2: Series and Parallel Circuits</h2>
                <p>In a series circuit, components are connected end-to-end, so the current is the same through all components. In a parallel circuit, components are connected across the same two points, so the voltage is the same across each branch.</p>
                <p><a href="https://www.tinkercad.com/circuits" target="_blank">Simulate a series or parallel circuit in Tinkercad</a></p>
            </div>

            <!-- Chapter 3: Kirchhoff's Laws -->
            <div class="chapter">
                <h2>Chapter 3: Kirchhoff's Laws</h2>
                <p>Kirchhoff’s Voltage Law (KVL) states that the sum of all voltages in a closed loop equals zero, while Kirchhoff’s Current Law (KCL) states that the total current entering a junction equals the total current leaving the junction.</p>
                <p><a href="https://www.falstad.com/circuit/" target="_blank">Experiment with Kirchhoff’s Laws using Falstad's Circuit Simulator</a></p>
            </div>

            <!-- Chapter 4: Practical Applications -->
            <div class="chapter">
                <h2>Chapter 4: Practical Applications</h2>
                <p>DC circuits are used in batteries, solar panels, and low-voltage electronics. Explore practical circuit designs below:</p>
                <ul>
                    <li><a href="https://learn.sparkfun.com/tutorials/voltage-divider" target="_blank">Voltage Divider Circuits</a></li>
                    <li><a href="https://www.allaboutcircuits.com/tools/ohms-law-calculator/" target="_blank">Ohm's Law Calculator</a></li>
                </ul>
            </div>

            <!-- Additional Resources -->
            <div class="resources">
                <h3>Additional Resources</h3>
                <ul>
                    <li><a href="https://www.khanacademy.org/science/physics/circuits-topic" target="_blank">Khan Academy - DC Circuits</a></li>
                    <li><a href="https://www.edx.org/course/basic-circuit-theory" target="_blank">edX - Basic Circuit Theory</a></li>
                </ul>
            </div>
        </div>
    </section>
</body>
</html>

<?php include '../includes/footer.php'; ?>
