<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login Notification</title>
    <style>
        /* Internal CSS - pastikan sederhana */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            background: #ffffff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            background-color: #3b82f6;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
        }

        .btn:hover {
            background-color: #2563eb;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login Notification</h2>
        <p>Hi {{ $user->name }},</p>
        <p>We noticed a login to your account from:</p>
        <ul>
            <li>IP Address: {{ $ip }}</li>
            <li>Time: {{ $time }}</li>
            <li>Browser: {{ $browser }}</li>
        </ul>
        <p>If this was you, you can ignore this email.
            If not, please <a href="" class="btn">Reset
                Password</a>.
        </p>
    </div>
</body>

</html>
