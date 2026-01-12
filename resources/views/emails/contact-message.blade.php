<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            background-color: #2E7D32;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px  20px;
            background-color: #f9f9f9;
        }
        .field {
            margin-bottom: 20px;
        }
        .label {
            font-weight: bold;
            color: #666;
            text-transform: uppercase;
            font-size: 12px;
            margin-bottom: 5px;
        }
        .value {
            color: #333;
            padding: 10px;
            background-color: white;
            border-left: 3px solid #2E7D32;
        }
        .message-box {
            background-color: white;
            padding: 15px;
            border-left: 3px solid #2E7D32;
            white-space: pre-wrap;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">New Contact Message</h1>
        <p style="margin: 5px 0 0 0;">From your website contact form</p>
    </div>

    <div class="content">
        <div class="field">
            <div class="label">From</div>
            <div class="value">{{ $contactMessage->name }}</div>
        </div>

        <div class="field">
            <div class="label">Email</div>
            <div class="value">
                <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>
            </div>
        </div>

        @if($contactMessage->phone)
        <div class="field">
            <div class="label">Phone</div>
            <div class="value">{{ $contactMessage->phone }}</div>
        </div>
        @endif

        @if($contactMessage->location)
        <div class="field">
            <div class="label">Project Location</div>
            <div class="value">{{ $contactMessage->location }}</div>
        </div>
        @endif

        <div class="field">
            <div class="label">Message</div>
            <div class="message-box">{{ $contactMessage->message }}</div>
        </div>

        <div class="field">
            <div class="label">Received At</div>
            <div class="value">{{ $contactMessage->created_at->format('d M Y, H:i') }}</div>
        </div>
    </div>

    <div class="footer">
        <p>This message was sent from your website contact form.</p>
        <p>You can view and manage all messages from your admin dashboard.</p>
    </div>
</body>
</html>
