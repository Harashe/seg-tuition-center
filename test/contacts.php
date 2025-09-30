<?php include '../test/includes/header.php'; ?>

<section id="contact">
    <div class="container">
        <h1>Contact Us</h1>
        <p>We'd love to hear from you! Whether you have questions, feedback, or suggestions, please don't hesitate to get in touch.</p>
        <form action="contact_form_handler.php" method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" placeholder="Your full name" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" placeholder="Your email address" required><br><br>

            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="5" placeholder="Write your message here" required></textarea><br><br>

            <button type="submit">Send Message</button>
        </form>
    </div>
</section>

<style>
    form {
        background: #f9f9f9;
        padding: 1.5rem;
        border-radius: 8px;
        border: 1px solid #ddd;
        max-width: 600px;
        margin: auto;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 0.5rem;
    }

    input, textarea {
        width: 100%;
        padding: 0.75rem;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
    }

    button {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        cursor: pointer;
        border-radius: 4px;
        font-size: 1rem;
    }

    button:hover {
        background-color: #2980b9;
    }

    .container {
        text-align: center;
        padding-top: 2rem;
    }

    h1 {
        margin-bottom: 1.5rem;
    }
</style>

<?php include '../test/includes/footer.php'; ?>
