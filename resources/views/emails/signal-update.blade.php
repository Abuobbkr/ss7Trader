<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signal Update Notification!</title>
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
                                            Signal Updated!</h2>
                                    </td>
                                </tr>
                            </table>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td
                                        style="padding-top: 25px; text-align: center; font-family: 'Poppins', Arial, sans-serif; font-size: 1.1em; line-height: 1.7; color: #5d6d7e;">
                                        <p style="margin: 0 0 18px;">A trading signal has been updated:</p>
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
                                                                style="color: #2980b9;">Currency Pair:</span></strong>
                                                        {{ $signal->pair_name }}</p>
                                                    <p style="margin: 8px 0;"><strong><span
                                                                style="color: #2980b9;">Signal Type:</span></strong>
                                                        {{ ucfirst($signal->signal_type) }}</p>
                                                    <p style="margin: 8px 0;"><strong><span
                                                                style="color: #2980b9;">Market Type:</span></strong>
                                                        {{ ucfirst($signal->market_type) }}</p>
                                                    <p style="margin: 8px 0;"><strong><span
                                                                style="color: #2980b9;">Entry Price:</span></strong>
                                                        {{ number_format($signal->entry_price, 5) }}</p>
                                                    <p style="margin: 8px 0;"><strong><span style="color: #2980b9;">Stop
                                                                Loss:</span></strong>
                                                        {{ number_format($signal->stop_loss, 5) }}</p>
                                                    <p style="margin: 8px 0;"><strong><span style="color: #2980b9;">Take
                                                                Profit:</span></strong>
                                                        {{ number_format($signal->take_profit, 5) }}</p>
                                                    <p style="margin: 8px 0;"><strong><span
                                                                style="color: #2980b9;">Group Type:</span></strong>
                                                        {{ ucfirst($signal->group_type) }}</p>
                                                    <p style="margin: 8px 0;"><strong><span
                                                                style="color: #2980b9;">Status:</span></strong>
                                                        {{ $signal->is_open ? 'Active' : 'Closed' }}</p>

                                                    @if($signal->entry_price_premium || $signal->stop_loss_premium || $signal->take_profit_premium)
                                                        <p style="margin: 15px 0 5px; font-weight: 600; color: #2980b9;">
                                                            This signal includes premium features for:</p>
                                                        <ul
                                                            style="list-style-type: disc; margin: 0; padding-left: 20px; color: #34495e;">
                                                            @if($signal->entry_price_premium)
                                                                <li style="margin-bottom: 5px;">Entry Price</li>
                                                            @endif
                                                            @if($signal->stop_loss_premium)
                                                                <li style="margin-bottom: 5px;">Stop Loss</li>
                                                            @endif
                                                            @if($signal->take_profit_premium)
                                                                <li>Take Profit</li>
                                                            @endif
                                                        </ul>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="text-align: center; font-family: 'Poppins', Arial, sans-serif; font-size: 1.1em; line-height: 1.7; color: #5d6d7e;">
                                        <p style="margin: 0;">Stay tuned for more updates and trading opportunities!</p>
                                    </td>
                                </tr>
                                <tr>
                                    
                                </tr>
                                <tr>
                                    <td
                                        style="text-align: center; font-family: 'Poppins', Arial, sans-serif; font-size: 1.1em; line-height: 1.7; color: #5d6d7e;">
                                        <p style="margin: 0;">If you have any questions or need assistance, our
                                            dedicated support team is here to help. Just reach out!</p>
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