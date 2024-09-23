<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer's Bid Amount Exceeded</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            border: 1px solid #ddd;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            background-color: #dc3545;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            margin: 20px 0;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
        }
        .content ul {
            list-style-type: none;
            padding: 0;
        }
        .content ul li {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .content ul li strong {
            color: #333;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <h1>Customer's Bid Exceeded Project Limit</h1>
    </div>
    <div class="content">
{{--        <p>Dear <strong>{{ $data['admin_name'] }}</strong>,</p>--}}
        <p>Dear <strong>Admin</strong>,</p>

        <p>We would like to inform you that the following customer has exceeded the allowed bid amount for a single project. Please find the details below:</p>

        <ul>
            <li><strong>Customer Name:</strong> {{ $data['name'] }}</li>
            <li><strong>Customer Email:</strong> {{ $data['email'] }}</li>
            <li><strong>Customer Phone Number:</strong> {{ $data['phone'] }}</li>
            <li><strong>Bid Amount:</strong> {{ $data['bid_amount'] }}</li>
            <li><strong>Allowed Project Limit:</strong> {{ $data['project_limit'] }}</li>

        </ul>

        <p>Please review this bid and take any necessary action. If you have any questions, feel free to contact the customer directly.</p>

        <p>Thank you for your prompt attention to this matter.</p>

        <p>Best regards,</p>
        <p><strong>The Project Team</strong></p>
    </div>
    <div class="footer">
        <p>For more information, feel free to contact us at <a href="mailto:support@cbfsu.com">support@cbfsu.com</a> or call us at (123) 456-7890.</p>
        <p>&copy; 2024 Credit Based Financial Service Unit. All rights reserved.</p>
    </div>
</div>
</body>
</html>
