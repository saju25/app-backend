<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Low Stock Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
        }
        p {
            color: #333;
            font-size: 16px;
        }
        .alert {
            background-color: #ffcccc;
            color: #cc0000;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dear Shop Owner,</h1>
        <p>We wanted to inform you that your shop product <strong>{{ $get_product_name }}</strong> is running low on stock.</p>
        <p class="alert">Current stock is less than <strong>{{ $get_product_quantity }}</strong> units.</p>
        <p>Please restock the product as soon as possible to avoid any inconvenience.</p>
        <p>Thank you for your attention!</p>
        <div class="footer">
            <p>If you need assistance, feel free to contact our support team.</p>
        </div>
    </div>
</body>
</html>
