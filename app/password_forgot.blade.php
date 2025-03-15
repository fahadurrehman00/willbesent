<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: transparent;
            overflow: hidden;
        }
        @media screen and (max-width:800px) {
            .email-container { margin: 0 auto; }
        }
        .header {
            display: block;
            margin: 0;
            padding: 0;
        }
        .header img {
            width: 100%;
            display: block;
            margin: 0;
            padding: 0;
        }
        .content {
            padding: 20px 50px;
            color: #000;
            line-height: 1.6;
            background-color: #fff;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .content_1 {
            padding: 0 12px;
            color: #000;
            line-height: 1.6;
        }
        @media screen and (max-width:800px) {
            .content { padding: 20px 30px; }
        }
        .content h2 {
            color: #000;
            font-size: 20px;
            margin: 0 0 10px;
        }
        .email_1 {
            font-size: 12px;
            color: #18004a;
            font-weight: 500;
        }
        .footer {
            display: flex;
        }
        .footer img {
            width: 100%;
            padding: 0;
        }
        .btn_link {
            font-size: 20px;
            width: 60%;
            color: #fff;
            height: 45px;
            border: none;
            cursor: pointer;
            border-radius: 50px;
            background-color: #140dda;
        }
        .btn_link_2 {
            text-decoration: none;
            cursor: pointer;
            width: 100%;
        }
        .btn_link_1 {
            width: 100%;
            margin: 20px 0;
        }
        @media screen and (max-width:500px) {
            .btn_link { font-size: 12px; }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="content_1">
            <h5 class="email_1"><strong>Email Subject:</strong> Don't Worry, We've Got Your Back! Reset Your Donate Directly Password</h5>
        </div>
        <div class="header">
            <div>
                <img src="{{ asset('assets/email/receipt_2.jpg') }}" alt="Donate Directly">
            </div>
            <div>
                <img src="{{ asset('assets/email/forgot.jpg') }}" alt="Donate Directly">
            </div>
        </div>
        <div class="content">
            <h2>Hey {{ $user->name }}!</h2>
            <p>Sometimes we all need a reset! Just click the link below to get back on
                track and continue your journey of giving, insha'Allah.</p>

            <div class="btn_link_1">
                <a href="{{ $actionUrl }}" class="btn_link_2">
                    <button type="button" class="btn_link">Reset your password here</button>
                </a>
            </div>
            <p>If you didn't request this, no worries—just ignore this email, or give us a
                shout if you need help at <b>support@donatedirectly.com</b></p>
            <p>Thank you for being with us and may your journey in giving continue to
                be blessed</p>
        </div>
        <div class="footer">
            <img src="{{ asset('assets/email/footer_img.jpg') }}" alt="">
        </div>
    </div>
</body>
</html>
