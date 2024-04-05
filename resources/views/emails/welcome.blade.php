<!DOCTYPE html>
<html>

<head>
    <style>
        /* Styles for the email content */
        .email-content {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }

        .button {
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <table class="email-content" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td style="text-align: center;">
                <h1>Welcome to Blog!</h1>
                <p>Thank you for registering on our blog. We're excited to have you as a member of our community.</p>
                <table class="action" align="center" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td style="text-align: center;">
                            <a href="{{ route('login') }}" class="button"
                                style="color: #ffffff; text-decoration: none;">Login</a>
                        </td>
                    </tr>
                </table>
                <p>If you have any questions or need assistance, feel free to reach out to us.</p>
                <p>Thanks,<br>{{ config('app.name') }}</p>
            </td>
        </tr>
    </table>
</body>

</html>
