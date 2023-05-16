<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to our website</title>
    <style>
        /* Reset default styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
        }

        /* Set max-width to prevent email from being too wide */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Style the header */
        .header {
            background-color: #2196F3;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        /* Style the content */
        .content {
            padding: 20px;
        }

        .code {
            font-weight: bold;
            font-size: 20px;
            color: #0088cc;
        }

        /* Style the footer */
        .footer {
            background-color: #eee;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Table - Website order cho mọi shop</h1>
        </div>
        <div class="content">
            @yield('content')
            <div class="footer">
                <p>&copy; 2023 Table. All rights reserved.</p>
            </div>
        </div>
</body>

</html>
