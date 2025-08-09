<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>New Trading Signal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- No external fonts. System stack only -->
    <style>
        /* Clients ignore <style> mostly, but a few use it. Keep minimal. */
        @media (max-width:600px) {
            .container {
                width: 100% !important
            }

            .p-24 {
                padding: 16px !important
            }

            .cta {
                display: block !important;
                width: 100% !important
            }
        }
    </style>
</head>

<body style="margin:0;padding:0;background:#FBF4F2;">
    <!-- Preheader (hidden preview text) -->
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;">
        New {{ ucfirst($signal->market_type) }} signal on {{ strtoupper($signal->asset->pair_name) }} •
        {{ strtoupper($signal->signal_type) }} • Entry {{ $signal->entry_price }}
    </div>

    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%"
        style="background:#FBF4F2;">
        <tr>
            <td align="center" style="padding:20px 12px;">
                <table class="container" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600"
                    style="width:600px;max-width:600px;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #eee;">
                    <!-- Header -->
                    <tr>
                        <td style="padding:18px 24px;border-bottom:1px solid #f0f2f6;">
                            <table width="100%" role="presentation">
                                <tr>
                                    <td
                                        style="font:700 18px/1.2 -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial; color:#0A0B49;">
                                        SS7Trader • New Signal
                                    </td>
                                    <td align="right"
                                        style="font:500 12px/1 -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#6b6f7b;">
                                        Sent: {{ now()->format('M d, Y H:i') }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td class="p-24" style="padding:24px;">
                            <p
                                style="margin:0 0 12px;font:600 20px/1.3 -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#0A0B49;">
                                {{ strtoupper($signal->asset->pair_name) }} — {{ strtoupper($signal->signal_type) }}
                            </p>
                            <p
                                style="margin:0 0 18px;font:400 14px/1.6 -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#3b3f4a;">
                                A new {{ ucfirst($signal->market_type) }} signal is available. Manage your risk and
                                verify levels before executing.
                            </p>

                            <!-- Data table -->
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%"
                                style="border-collapse:collapse;border:1px solid #eef0f5;border-radius:8px;overflow:hidden;">
                                <tr style="background:#f7f8fb;">
                                    <td
                                        style="padding:10px 12px;font:700 12px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#0A0B49;">
                                        Entry</td>
                                    <td
                                        style="padding:10px 12px;font:700 12px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#0A0B49;">
                                        Stop Loss</td>
                                    <td
                                        style="padding:10px 12px;font:700 12px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#0A0B49;">
                                        Take Profit</td>
                                    <td
                                        style="padding:10px 12px;font:700 12px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#0A0B49;">
                                        Status</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding:12px;font:600 14px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#222;">
                                        {{ $signal->entry_price }}
                                    </td>
                                    <td
                                        style="padding:12px;font:600 14px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#222;">
                                        {{ $signal->stop_loss }}
                                    </td>
                                    <td
                                        style="padding:12px;font:600 14px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#222;">
                                        {{ $signal->take_profit }}
                                    </td>
                                    <td
                                        style="padding:12px;font:700 12px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#1dbf73;">
                                        {{ $signal->is_open ? 'Active' : 'Closed' }}
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                style="margin:18px 0 0;">
                                <tr>
                                    <td>
                                        <a href="https://signal.ss7trader.com" class="cta"
                                            style="background:#FF0054;color:#ffffff;text-decoration:none;font:700 14px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;padding:12px 18px;border-radius:10px;display:inline-block;">
                                            View in Dashboard
                                        </a>
                                    </td>
                                    <td width="12"></td>
                                    <td>
                                        <a href="https://ss7trader.com/premium-signals" class="cta"
                                            style="background:#0A0B49;color:#ffffff;text-decoration:none;font:700 14px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;padding:12px 18px;border-radius:10px;display:inline-block;">
                                            Go Premium — $14.99/mo
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p
                                style="margin:18px 0 0;font:400 12px/1.6 -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#6b6f7b;">
                                Note: Levels are provided for educational purposes. Always use your own judgment and
                                risk management.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:16px 24px;border-top:1px solid #f0f2f6;background:#fff;">
                            <p
                                style="margin:0 0 6px;font:700 12px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#0A0B49;">
                                SS7Trader Academy
                            </p>
                            <p
                                style="margin:0 0 2px;font:400 12px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#656b76;">
                                Support: <a href="mailto:support@ss7trader.com"
                                    style="color:#0A0B49;text-decoration:none;">support@ss7trader.com</a> ·
                                Web: <a href="https://ss7trader.com"
                                    style="color:#0A0B49;text-decoration:none;">ss7trader.com</a>
                            </p>
                            <p
                                style="margin:0 0 8px;font:400 12px -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#656b76;">
                                Telegram: <a href="https://t.me/SSsevenTrader"
                                    style="color:#0A0B49;text-decoration:none;">@SSsevenTrader</a>
                            </p>

                            <!-- Compliance -->
                            <p
                                style="margin:8px 0 0;font:400 11px/1.6 -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial;color:#8a8f9b;">
                                You’re receiving alerts because you opted in on our website. If you don’t want these
                                emails,
                                <a href="{{ $unsubscribeUrl ?? '#' }}"
                                    style="color:#FF0054;text-decoration:none;">unsubscribe here</a>.
                                <br>SS7Trader Academy, <span style="white-space:nowrap;">2nd Floor College House, 17
                                    King Edwards Road, Rui, London</span>
                            </p>
                        </td>
                    </tr>
                </table>

                <!-- small spacer -->
                <div style="height:20px;line-height:20px">&nbsp;</div>
            </td>
        </tr>
    </table>
</body>

</html>
