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
    
    <h2>{{ $verificationCode }}</h2>
    
    <p>Alternatively, you can click the following link to verify your email:</p>
    
    <a href="{{ url('/verify-email', [$user_id, $verificationCode]) }}">Verify Email</a>
    
    <p>If you did not register, please ignore this email.</p>
    
    <p>Best regards,<br>Your App Team</p>
</body>
</html>
