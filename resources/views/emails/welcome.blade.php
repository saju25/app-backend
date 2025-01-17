<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Platform</title>
</head>
<body>
    <h1>Welcome, {{ $fullname }}!</h1>
    <p>Thank you for registering with us. Please verify your email by using the following OTP code:</p>
    <p><strong>{{ $otp_code }}</strong></p>
    <p>Use this code to complete your verification process.</p>
</body>
</html>
