<!DOCTYPE html>
<html>

<head>
    <style>
        .email-content {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }
    </style>
</head>

<body>
    <table class="email-content" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td style="text-align: center;">
                <h1>Your Blog Post Has Been Approved!</h1>
                <p>Congratulations! Your blog post on "{{ $blog->title }}" has been approved and published.</p>


                <p>If you have any questions or need further assistance, feel free to contact us.</p>


                <p>Thank you for sharing your insights with our community!</p>
                <p>Best Regards,<br>{{ config('app.name') }}</p>
            </td>
        </tr>
    </table>
</body>

</html>
