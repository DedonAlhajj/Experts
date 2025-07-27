<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $newsletter->title }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.07);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .header h1 {
            font-size: 24px;
            color: #0077cc;
            margin: 0;
        }

        .image {
            margin: 20px 0;
            text-align: center;
        }

        .image img {
            max-width: 100%;
            border-radius: 6px;
        }

        .content {
            font-size: 16px;
            line-height: 1.8;
        }

        .button {
            display: block;
            width: fit-content;
            margin: 30px auto;
            padding: 12px 25px;
            background-color: #0077cc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>{{ $newsletter->title }}</h1>
    </div>

    @if($bgUrl)
        <div class="image">
            <img src="{{ $bgUrl }}" alt="صورة النشرة" style="max-width:100%; border-radius:6px;">
        </div>
    @endif


    <div class="content">
        {!! nl2br(e($newsletter->body)) !!}
    </div>

    @if($newsletter->cta_url)
        <a href="{{ $newsletter->cta_url }}" class="button">
            {{ $newsletter->cta_label ?? 'اطلع على المزيد' }}
        </a>
    @endif

    <div class="footer">
        Thank you for subscribing to our website!<br>
        Team Almounkez 💙
    </div>
</div>
</body>
</html>
