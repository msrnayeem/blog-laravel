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
                <h1>New Comment on "{{ $blog->title }}"</h1>
                <p>A new comment has been added to your blog post titled "{{ $blog->title }}".</p>

                <p><strong>Commenter:</strong> {{ $comment->name }}</p>
                @if ($comment->email)
                    <p><strong>Email:</strong> {{ $comment->email }}</p>
                @endif
                <p><strong>Comment:</strong></p>
                <p>{{ $comment->content }}</p>


                <p>If you have any questions or need further assistance, feel free to contact us.</p>
                <p>Thank you for engaging with our community!</p>
                <p>Best Regards,<br>{{ config('app.name') }}</p>
            </td>
        </tr>
    </table>
</body>

</html>
