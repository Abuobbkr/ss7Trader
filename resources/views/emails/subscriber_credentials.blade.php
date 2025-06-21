<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Platform!</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        /* Basic resets for email clients */
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

        .apple-link a {
            color: inherit !important;
            text-decoration: none !important;
        }

        /* Responsive styles (for clients that support it) */
        @media screen and (max-width: 600px) {
            .full-width-image img {
                width: 100% !important;
                height: auto !important;
            }

            .content-padding {
                padding: 20px !important;
            }

            .button-wrapper {
                padding: 10px 0 !important;
            }

            .button-cell {
                padding: 10px 20px !important;
            }

            .header h2 {
                font-size: 1.8em !important;
            }

            .content p {
                font-size: 1em !important;
            }

            .credentials {
                padding: 15px !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; background-color: #e0f2f7; font-family: 'Poppins', Arial, sans-serif;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #e0f2f7;">
        <tr>
            <td align="center" style="padding: 40px 20px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                    style="max-width: 650px; background-color: #ffffff; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    <tr>
                        <td align="center" style="padding: 35px 45px; border-radius: 12px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center"
                                        style="border-bottom: 2px solid #a7d9f7; padding-bottom: 15px; margin-bottom: 25px;">
                                        <h2
                                            style="font-family: 'Poppins', Arial, sans-serif; color: #2980b9; font-size: 2.2em; margin: 0; font-weight: 700; letter-spacing: -0.5px;">
                                            Welcome, {{ $subscriber->username }}!</h2>
                                    </td>
                                </tr>
                            </table>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td
                                        style="padding-top: 25px; text-align: center; font-family: 'Poppins', Arial, sans-serif; font-size: 1.1em; line-height: 1.7; color: #5d6d7e;">
                                        <p style="margin: 0 0 18px;">Thank you for joining our community! We're thrilled
                                            to have you on board. Your journey to explore all our exciting features
                                            begins now.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding: 25px 0;">
                                        <table border="0" cellpadding="0" cellspacing="0"
                                            style="width: 100%; max-width: 400px; background-color: #ecf8ff; padding: 20px 25px; border: 1px solid #b3e5fc; border-radius: 8px; box-shadow: inset 0 1px 5px rgba(0,0,0,0.05);">
                                            <tr>
                                                <td
                                                    style="font-family: 'Poppins', Arial, sans-serif; font-size: 1em; line-height: 1.6; color: #34495e; text-align: left;">
                                                    <p style="margin: 8px 0;"><strong><span
                                                                style="color: #2980b9;">Email:</span></strong>
                                                        {{ $subscriber->email }}</p>
                                                    <p style="margin: 8px 0;"><strong><span
                                                                style="color: #2980b9;">Password:</span></strong>
                                                        {{ $plainPassword }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="text-align: center; font-family: 'Poppins', Arial, sans-serif; font-size: 1.1em; line-height: 1.7; color: #5d6d7e;">
                                        <p style="margin: 0 0 18px;">For your security, we recommend changing your
                                            password after your first login. Ready to dive in?</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding: 30px 0;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" bgcolor="#3498db"
                                                    style="border-radius: 50px; padding: 0;">
                                                    <a href="YOUR_LOGIN_PAGE_URL_HERE" target="_blank"
                                                        style="font-family: 'Poppins', Arial, sans-serif; font-size: 1.1em; font-weight: 600; color: #ffffff; text-decoration: none; padding: 14px 30px; display: inline-block; border-radius: 50px; background-color: #3498db;">
                                                        Log In Now <span
                                                            style="font-size: 1.5em; vertical-align: middle; margin-left: 5px; line-height: 1;">🚀</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="text-align: center; font-family: 'Poppins', Arial, sans-serif; font-size: 1.1em; line-height: 1.7; color: #5d6d7e;">
                                        <p style="margin: 0;">If you have any questions or need assistance, our
                                            dedicated support team is here to help. Just reach out!</p>
                                    </td>
                                </tr>
                            </table>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center"
                                        style="font-family: 'Poppins', Arial, sans-serif; font-size: 0.9em; color: #95a5a6; margin-top: 40px; padding-top: 20px; border-top: 1px solid #eceff1;">
                                        &copy; {{ date('Y') }} Your Company Name. All rights reserved.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>