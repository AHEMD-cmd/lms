<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Someone Replied to Your Question</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
        }
        .email-header {
            background-color: #3490dc;
            padding: 20px;
            color: #fff;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .email-header h1 {
            font-size: 24px;
            margin: 0;
        }
        .email-body {
            padding: 20px;
            font-size: 16px;
            color: #333;
        }
        .email-body p {
            margin-bottom: 10px;
        }
        .email-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #999;
        }
        .email-footer a {
            color: #3490dc;
            text-decoration: none;
        }
        .button {
            background-color: #3490dc;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="email-header">
            <h1>You've Got a New Reply!</h1>
        </div>

        <div class="email-body">
            <p>Hi {{ $questionOwner->name }},</p>
            <p>Someone has replied to your question: <strong>{{ $question->subject }}</strong></p>

            <p><strong>{{ $replier->name }}</strong> has replied to your question.</p>

            <p><em>Here is the reply:</em></p>
            <blockquote style="background-color: #f9f9f9; border-left: 4px solid #3490dc; padding: 10px; margin: 10px 0;">
                {{ $question->question }}
            </blockquote>

            <a href="{{ route('courses.lectures.index', $question->course->slug) }}" class="button">View Reply</a>
        </div>

        <div class="email-footer">
            <p>Best regards,</p>
            <p><strong>{{ config('app.name') }}</strong></p>
            <p><a href="{{ url('/') }}">Visit Our Website</a></p>
        </div>
    </div>

</body>
</html>
