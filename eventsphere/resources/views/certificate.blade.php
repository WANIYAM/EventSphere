<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate of Participation</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; text-align: center; padding: 50px; }
        .container { border: 10px solid #4CAF50; padding: 50px; width: 800px; margin: 50px auto; background: white; }
        .title { font-size: 32px; font-weight: bold; margin-top: 20px; }
        .subtitle { font-size: 20px; margin-top: 10px; }
        .name { font-size: 28px; font-weight: bold; margin: 40px 0; }
        .event { font-size: 18px; margin-top: 20px; }
        .footer { margin-top: 50px; display: flex; justify-content: space-between; font-size: 16px; }
        .signature { border-top: 1px solid #333; width: 200px; text-align: center; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Certificate of Participation</div>
        <div class="subtitle">This certificate is proudly presented to</div>
        <div class="name">{{ $participant->name }}</div>
        <div class="event">
            For participating in <strong>{{ $event->title }}</strong><br>
            held on {{ \Carbon\Carbon::parse($event->date)->format('d M, Y') }} at {{ $event->venue }}
        </div>
        <div class="footer">
            <div><div class="signature">Organizer</div></div>
            <div><div class="signature">Date: {{ now()->format('d M, Y') }}</div></div>
        </div>
    </div>
</body>
</html>
