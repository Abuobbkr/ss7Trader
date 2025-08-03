<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Welcome to SS7Trader Academy!</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

    body,
    table,
    td,
    a {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    table,
    td {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    img {
      -ms-interpolation-mode: bicubic;
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
    }

    a[x-apple-data-detectors] {
      color: inherit !important;
      text-decoration: none !important;
      font-size: inherit !important;
      font-family: inherit !important;
      font-weight: inherit !important;
      line-height: inherit !important;
    }

    body {
      margin: 0;
      padding: 0;
      background-color: #0c1126;
      font-family: 'Poppins', Arial, sans-serif;
      color: #e1e1e1;
    }

    .container {
      max-width: 650px;
      margin: 40px auto;
      background-color: #121a40;
      border-radius: 15px;
      box-shadow: 0 0 40px rgba(255, 20, 147, 0.6);
      padding: 45px 40px;
    }

    .header {
      border-bottom: 3px solid #ff14a1;
      padding-bottom: 15px;
      margin-bottom: 30px;
      text-align: center;
    }

    .header h2 {
      color: #ff14a1;
      font-size: 2.4em;
      margin: 0;
      font-weight: 700;
      letter-spacing: -0.5px;
      text-transform: uppercase;
    }

    .content p {
      font-size: 1.1em;
      line-height: 1.6;
      color: #b0b6cc;
      margin: 0 0 18px 0;
      text-align: center;
    }

    .credentials {
      background-color: #1e2a6f;
      border: 1px solid #ff14a1;
      border-radius: 12px;
      padding: 25px 30px;
      max-width: 420px;
      margin: 25px auto;
      color: #fff;
      font-size: 1.05em;
      box-shadow: 0 0 15px rgba(255, 20, 147, 0.4);
    }

    .credentials p {
      margin: 12px 0;
      text-align: left;
    }

    .credentials strong {
      color: #ff14a1;
      display: inline-block;
      width: 110px;
    }

    .btn-wrapper {
      text-align: center;
      margin: 35px 0 30px 0;
    }

    .btn-login {
      background: linear-gradient(90deg, #ff14a1 0%, #ff5da3 100%);
      color: #fff !important;
      padding: 16px 48px;
      font-size: 1.15em;
      font-weight: 700;
      border-radius: 50px;
      text-decoration: none;
      display: inline-block;
      box-shadow: 0 4px 18px rgba(255, 20, 147, 0.6);
      transition: background 0.3s ease;
    }

    .btn-login:hover {
      background: linear-gradient(90deg, #ff5da3 0%, #ff14a1 100%);
      box-shadow: 0 6px 25px rgba(255, 20, 147, 0.8);
    }

    .footer-text {
      text-align: center;
      font-size: 0.9em;
      color: #707a9c;
      margin-top: 40px;
      border-top: 1px solid #28315b;
      padding-top: 20px;
      line-height: 1.5;
    }

    .footer-text a {
      color: #ff14a1;
      text-decoration: none;
    }

    @media screen and (max-width: 600px) {
      .container {
        margin: 20px 15px;
        padding: 30px 20px;
      }

      .header h2 {
        font-size: 1.8em;
      }

      .credentials {
        padding: 18px 20px;
      }

      .btn-login {
        padding: 14px 36px;
        font-size: 1em;
      }
    }
  </style>
</head>

<body>
  <div class="container" role="main">
    <div class="header">
      <h2>Welcome, {{ $subscriber->username }}!</h2>
    </div>

    <div class="content">
      <p>Thank you for joining the SS7Trader Academy family! Your journey to mastering elite trading signals and
        strategies starts here.</p>
    </div>

    <div class="credentials" aria-label="Your login credentials">
      <p><strong>Email:</strong> {{ $subscriber->email }}</p>
      <p><strong>Password:</strong> {{ $plainPassword }}</p>
    </div>

    <div class="content">
      <p>For your security, we highly recommend changing your password after your first login. Ready to dominate the
        market?</p>
    </div>

    <div class="btn-wrapper">
      <a href="YOUR_LOGIN_PAGE_URL_HERE" target="_blank" rel="noopener" class="btn-login" aria-label="Log In Now">
        Log In Now
      </a>
    </div>

    <div class="content">
      <p>If you have any questions or need support, our dedicated team is standing by to assist you 24/7.</p>
    </div>

    <div class="footer-text" aria-label="footer">
      &copy; {{ date('Y') }} SS7Trader Academy. All rights reserved.<br />
      Support: <a href="mailto:support@ss7trader.com">support@ss7trader.com</a> | Website: <a
        href="https://signal.ss7trader.com">signal.ss7trader.com</a><br />
      Telegram: <a href="https://t.me/SSsevenTrader">@SSsevenTrader</a> | Social: @ss7traderacademy on all platforms
    </div>
  </div>
</body>

</html>
