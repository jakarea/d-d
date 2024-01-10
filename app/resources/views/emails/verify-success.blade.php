<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <p>Dear {{ $user->name }},</p>
    
    <p>Thank you for registering. Please use the following verification code to verify your email:</p>
    
    <h2>Verification Success!</h2>
    
    <p>You have successfully verified your account in DnD, now you can login with your credintials</p>
    
    <p>Best regards,<br>DnD</p>
</body>
</html>
