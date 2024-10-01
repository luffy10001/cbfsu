<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General Notifications</title>
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
            background-color: #007bff;
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
        <h1>Notification</h1>
    </div>
    <div class="content">
        <p>Dear <strong>{{ $data['name'] }}</strong>,</p>
        <p>{{$data['message']}}</p>


        <p><a href="{{ url($data['url']) }}"> View Details </a></p>



        <p>Best regards,</p>
        <p><strong>The Project Team</strong></p>
    </div>
    <div class="footer">
        <p>For more information, feel free to contact us at <a href="mailto:support@example.com">support@cbfsu.com</a> or call us at (123) 456-7890.</p>
        <p>&copy; 2024 Credit Based Financial Service Unit. All rights reserved.</p>
    </div>
</div>
</body>
</html>
