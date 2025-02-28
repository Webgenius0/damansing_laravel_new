<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffc182;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #f7830d;
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 25px;
            color: #124c5f;
        }
        .content p {
            line-height: 1.6;
            margin: 0 0 15px;
        }
        .content strong {
            color: #f7830d;
        }
        .footer {
            background-color: #124c5f;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #ffffff;
            border-top: 1px solid #e0e0e0;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Message from {{ $contactData['full_name'] }}</h2>
        </div>
        <div class="content">
            <p><strong>Email:</strong> {{ $contactData['email'] }}</p>
            <p><strong>Phone Number:</strong> {{ $contactData['phone_number'] }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $contactData['message'] }}</p>
        </div>
        <div class="footer">
            <p>Thank you for your attention.</p>
        </div>
    </div>
</body>
</html>
