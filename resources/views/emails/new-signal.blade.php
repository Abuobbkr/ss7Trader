<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trading Signal Alert</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

        body {
            margin: 0;
            padding: 0;
            background: #0b0f1a;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 620px;
            margin: 0 auto;
            background: #12192c;
            border-radius: 10px;
            padding: 40px 30px;
            box-shadow: 0 0 20px rgba(255, 105, 180, 0.25);
        }

        .header {
            border-bottom: 2px solid #ff69b4;
            padding-bottom: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 26px;
            font-weight: 700;
            color: #ff69b4;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .signal-info {
            background: #1c2436;
            padding: 25px;
            border-radius: 8px;
            border: 1px solid #2f3b57;
        }

        .signal-info p {
            font-size: 15px;
            margin: 10px 0;
            line-height: 1.6;
        }

        .signal-info strong {
            color: #ff69b4;
            display: inline-block;
            width: 140px;
        }

        .footer {
            border-top: 1px solid #2c344c;
            margin-top: 40px;
            padding-top: 25px;
            font-size: 13px;
            color: #999;
            text-align: center;
        }

        .footer p {
            margin: 4px 0;
        }

        .footer a {
            color: #ff69b4;
            text-decoration: none;
        }

        @media screen and (max-width: 620px) {
            .container {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 22px;
            }

            .signal-info strong {
                width: 120px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>New Signal Alert</h1>
        </div>

        <div class="signal-info">
            <p><strong>Currency Pair:</strong> {{ $signal->pair_name }}</p>
            <p><strong>Signal Type:</strong> {{ ucfirst($signal->signal_type) }}</p>
            <p><strong>Market Type:</strong> {{ ucfirst($signal->market_type) }}</p>
            <p><strong>Entry Price:</strong> {{ number_format($signal->entry_price, 5) }}</p>
            <p><strong>Stop Loss:</strong> {{ number_format($signal->stop_loss, 5) }}</p>
            <p><strong>Take Profit:</strong> {{ number_format($signal->take_profit, 5) }}</p>
            <p><strong>Status:</strong> {{ $signal->is_open ? 'Active' : 'Closed' }}</p>
        </div>

        <div style="margin-top: 30px; color: #ccc; font-size: 15px; text-align: center;">
            Stay sharp. More signals are coming.
            Our expert analysts are always on the charts.
        </div>

        <div class="footer">
            <p><strong>SS7Trader Academy</strong></p>
            <p>Email: <a href="mailto:support@ss7trader.com">support@ss7trader.com</a></p>
            <p>Website: <a href="https://signal.ss7trader.com">signal.ss7trader.com</a></p>
            <p>Telegram: <a href="https://t.me/SSsevenTrader">@SSsevenTrader</a></p>
            <p>Social: @ss7traderacademy on YouTube, IG, FB, X</p>
            <p style="margin-top: 15px; color: #666;">Risk Warning: Trading financial instruments involves high risk and
                may not be suitable for all investors. Always trade responsibly.</p>
            <p>&copy; {{ date('Y') }} SS7Trader Academy. All Rights Reserved.</p>
        </div>
    </div>

</body>

</html>