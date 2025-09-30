<?php include '../test/includes/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DC Circuits Webbook</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 2rem 0;
        }

        h1, h2, h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .chapter {
            margin-bottom: 2rem;
            padding: 1rem;
            border-left: 4px solid #3498db;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .chapter h2 {
            color: #3498db;
            margin-bottom: 1rem;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        blockquote {
            font-size: 1.2rem;
            font-style: italic;
            background: #ecf0f1;
            padding: 1rem;
            border-left: 4px solid #2980b9;
            margin: 1rem 0;
        }

        ul {
            list-style: square;
            padding-left: 1.5rem;
        }

        .example {
            background-color: #e8f4f8;
            padding: 1rem;
            margin-top: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .example strong {
            display: block;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <section id="dc-circuits">
        <div class="container">
            <h1>DC Circuit Analysis Webbook</h1>
            <p>Welcome to the summarized webbook on DC Circuit Analysis! This guide provides a concise review of key concepts, worked examples, and additional resources to enhance your learning.</p>

            <!-- Chapter 1: Resistivity and Temperature Coefficient -->
            <div class="chapter">
                <h2>Chapter 1: Resistivity and Temperature Coefficient of Resistance</h2>
                <h3>SEG Tuitions</h3>
                <p>Revising the Analysis of Direct Current Networks</p>
                <p><strong>Introduction:</strong> This study guide builds on your foundational knowledge of electrical circuits—covering key definitions, circuit laws, rules, and more. It’s designed for quick, effective revision, helping you grasp core concepts and advanced topics to aid in your exam prep.</p>
                <p><strong>Definition:</strong> Resistivity is a material property that quantifies how strongly a material opposes the flow of electric current.</p>
                <h3>Factors That Affect Resistance:</h3>
                <ul>
                    <li>Material</li>
                    <li>Length</li>
                    <li>Cross-sectional area</li>
                    <li>Temperature</li>
                </ul>
                <blockquote>
                    Law of resistance: \( R = \rho \frac{l}{A} \)
                    <br>Where:
                    <ul>
                        <li>\( R \): Resistance (Ohms)</li>
                        <li>\( \rho \): Resistivity (Ohm meters)</li>
                        <li>\( l \): Length of the conductor (meters)</li>
                        <li>\( A \): Cross-sectional area (m²)</li>
                    </ul>
                </blockquote>
                <img src="/test/media/resistivity.png" alt="Example of Resistivity in Conductors">

                <h3>Temperature Dependence of Resistance:</h3>
                <p>Temperature greatly impacts the resistance of conductors, semiconductors, and insulators. For a conductor with initial resistance \( R_0 \) at \( \theta^\circ C \) and final resistance \( R_T \) at \( T^\circ C \):</p>
                <ol>
                    <li>The resistance change (\( R_T - R_0 \)) is:
                        <ul>
                            <li>Directly proportional to the initial resistance, \( R_0 \).</li>
                            <li>Directly proportional to the temperature increase (\( T - \theta \)).</li>
                            <li>Dependent on the material's temperature coefficient of resistance, \( \alpha_0 \).</li>
                        </ul>
                    </li>
                </ol>
                <p>Combining these, we find:</p>
                <blockquote>
                    \( R_T = R_0 \{ 1 + \alpha_0 (T - \theta) \} \)
                </blockquote>
            </div>

            <!-- Chapter 2: Series and Parallel Connections -->
            <div class="chapter">
                <h2>Chapter 2: Series and Parallel Connections</h2>
                <p><strong>Series Connection:</strong> Components connected end-to-end. Current is the same across all elements.</p>
                <img src="/test/media/series_connection.png" alt="Series Connection Example">
                <p><strong>Parallel Connection:</strong> Components connected across the same two points. Voltage is the same across each branch.</p>
                <img src="/test/media/parallel_connection.png" alt="Parallel Connection Example">
            </div>

            <!-- Chapter 3: Worked Examples -->
            <div class="chapter">
                <h2>Chapter 3: Worked Examples</h2>
                <p>Find the total resistance and current in the circuit below:</p>
                <img src="/test/media/series_ex.png" alt="Example Circuit Diagram">
                <div class="example">
                    <strong>Solution:</strong>
                    Total resistance \( R_{total} = R_1 + R_2 + R_3 \)<br>
                    \( R_{total} = 3 + 3 + 3 = 9 \, \Omega \)
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<?php include '../test/includes/footer.php'; ?>
