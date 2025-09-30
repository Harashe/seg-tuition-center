<?php 
// Retrieve the query parameters from the URL
$first_name = isset($_GET['first_name']) ? htmlspecialchars($_GET['first_name']) : '';
$last_name = isset($_GET['last_name']) ? htmlspecialchars($_GET['last_name']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
$phone_number = isset($_GET['phone_number']) ? htmlspecialchars($_GET['phone_number']) : '';

$wa_number = preg_match('/^\+26/', $phone_number) ? $phone_number : '26' . $phone_number;
$wa_link = "https://wa.me/" . urlencode($wa_number) . "?text=" . urlencode("Hello dear $first_name $last_name, be informed that your payment status has been updated to 'paid'. Please click here to log in to your dashboard and access your materials: segtuitions.great-site.net/login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Update</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .info {
            margin-bottom: 15px;
        }
        button {
            padding: 10px;
            background-color: #25D366;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #128C7E;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Confirm Details</h2>
    <div class="info">
        <p><strong>Name:</strong> <?php echo "$first_name $last_name"; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Number:</strong> <?php echo $phone_number; ?></p>
    </div>
    <a href="<?php echo $wa_link; ?>" target="_blank"><button>Confirm and Inform Student</button></a>
</div>

</body>
</html>
<?php 
