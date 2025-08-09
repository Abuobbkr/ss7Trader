<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="SS7 TRADER Academy - Learn trading skills, explore our services, and stay updated with our newsletter." />
    <meta name="keywords" content="Trading Academy, SS7 Trader, Financial Education, Newsletter, Forex, Crypto" />
    <meta name="author" content="SS7 TRADER Academy" />
    <title>SS7 TRADER Academy | Learn Trading & Financial Skills</title>
    <link rel="icon" type="image/x-icon" href="https://ss7trader.com/wp-content/uploads/2025/05/e5rhrtyh6rth.png">

    <!-- External Fonts & Icons -->
    <link href="{{ asset('frontend/bootstrap/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/bootstrap/bootstrapicon.css') }}" rel="stylesheet">



    <!-- SS7Trader Signals Page (table untouched) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --pink: #FF0054;
            --navy: #0A0B49;
            --soft: #FBF4F2;
            --neon: #057BFE;
            --badge: #FFAE01;
            --ink: #222;
        }

        body {
            margin: 0
        }

        .ss7-wrap {
            font-family: 'Poppins', system-ui, Segoe UI, Arial, sans-serif;
            background: var(--soft)
        }

        /* Hero */
        .ss7-hero {
            padding: 72px 16px 48px;
            text-align: center;
            position: relative;
            background: radial-gradient(1000px 500px at 50% -10%, rgba(255, 0, 84, .10), transparent 60%), var(--soft);
        }

        .ss7-hero .badge {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            padding: 6px 12px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid rgba(10, 11, 73, .08);
            color: var(--navy);
            font-size: 12px;
            font-weight: 700;
        }

        .ss7-hero .badge .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--pink);
            box-shadow: 0 0 10px rgba(255, 0, 84, .8)
        }

        .ss7-hero h1 {
            margin: 14px 0 8px;
            font-size: 38px;
            color: var(--navy);
            letter-spacing: .2px
        }

        .ss7-hero p {
            margin: 0 auto;
            color: #51535a;
            max-width: 760px
        }

        .ss7-hero .labels {
            margin-top: 16px;
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap
        }

        .chip {
            font-size: 12px;
            font-weight: 800;
            padding: 6px 10px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid rgba(10, 11, 73, .08)
        }

        .chip.pink {
            background: #ffe7ef;
            border-color: rgba(255, 0, 84, .35)
        }

        .chip.blue {
            background: #eaf3ff;
            border-color: rgba(5, 123, 254, .35)
        }

        /* Grid: table + sidebar */
        .ss7-grid {
            max-width: 1300px;
            margin: 0 auto;
            padding: 24px 16px 56px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 22px
        }

        @media(min-width:1024px) {
            .ss7-grid {
                grid-template-columns: 1.7fr .95fr
            }
        }

        /* Card shells around existing elements */
        .card {
            background: #fff;
            border: 1px solid rgba(10, 11, 73, .08);
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(10, 11, 73, .08);
        }

        .card.pad {
            padding: 16px
        }

        /* ====== PLACEHOLDER FRAME FOR YOUR TABLE ====== */
        .table-shell {
            padding: 18px
        }

        .table-note {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px
        }

        .table-note .updated {
            font-size: 12px;
            color: #6b6f7b
        }

        .table-note .legend {
            display: flex;
            gap: 8px;
            flex-wrap: wrap
        }

        .legend .chip {
            background: #f7f8fb
        }

        /* Sidebar (brokers/ads) */
        .side-stack {
            display: flex;
            flex-direction: column;
            gap: 16px
        }

        .side-title {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 16px;
            border-bottom: 1px solid rgba(10, 11, 73, .06)
        }

        .side-title h3 {
            margin: 0;
            font-size: 18px;
            color: var(--navy)
        }

        .side-title .trophy {
            width: 18px;
            height: 18px
        }

        .broker {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            align-items: center;
            padding: 14px;
            border-top: 1px dashed #e6e8f2
        }

        .broker:first-of-type {
            border-top: none
        }

        .b-left {
            display: flex;
            align-items: center;
            gap: 12px
        }

        .b-logo {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: #f7f8fb;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .b-logo img {
            max-width: 70%;
            max-height: 70%
        }

        .b-name {
            font-weight: 800;
            color: #1c2030
        }

        .b-sub {
            font-size: 12px;
            color: #6b6f7b
        }

        .b-cta {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            padding: 10px 12px;
            border-radius: 10px;
            background: var(--navy);
            color: #fff;
            text-decoration: none;
            font-weight: 800;
            transition: box-shadow .2s ease, transform .2s ease
        }

        .b-cta:hover {
            box-shadow: 0 0 18px rgba(5, 123, 254, .35);
            transform: translateY(-1px)
        }

        .b-cta .arrow {
            width: 16px;
            height: 16px;
            fill: #fff
        }

        /* Banner Ads */
        .banner {
            display: block;
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            text-decoration: none;
            color: #fff
        }

        .banner .inner {
            padding: 22px
        }

        .banner .kicker {
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .3px;
            opacity: .9
        }

        .banner h4 {
            margin: 6px 0 8px;
            font-size: 20px
        }

        .banner p {
            margin: 0;
            font-size: 13px;
            opacity: .9
        }

        .banner .cta {
            margin-top: 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: var(--navy);
            padding: 8px 12px;
            border-radius: 10px;
            font-weight: 800
        }

        .banner.blue {
            background: linear-gradient(135deg, #0a2a6e, #057BFE)
        }

        .banner.pink {
            background: linear-gradient(135deg, #6a0031, #FF0054)
        }

        .banner:hover {
            box-shadow: 0 14px 34px rgba(0, 0, 0, .18)
        }

        /* How-to Section */
        .howto {
            max-width: 1300px;
            margin: 0 auto 64px;
            padding: 0 16px
        }

        .how-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px
        }

        @media(min-width:820px) {
            .how-grid {
                grid-template-columns: repeat(3, 1fr)
            }
        }

        .how {
            background: #fff;
            border: 1px solid rgba(10, 11, 73, .08);
            border-radius: 16px;
            padding: 18px;
            box-shadow: 0 10px 26px rgba(10, 11, 73, .07)
        }

        .how h5 {
            margin: 8px 0 6px;
            font-size: 16px;
            color: var(--navy)
        }

        .how p {
            margin: 0;
            font-size: 13px;
            color: #4b4e59
        }

        .num {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: var(--pink);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            box-shadow: 0 0 16px rgba(255, 0, 84, .35)
        }

        /* Bottom CTA */
        .bottom-cta {
            max-width: 1300px;
            margin: 0 auto 80px;
            padding: 0 16px
        }

        .cta-box {
            background: #fff;
            border: 1px solid rgba(10, 11, 73, .08);
            border-radius: 16px;
            padding: 22px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 10px 26px rgba(10, 11, 73, .07)
        }

        .cta-box h3 {
            margin: 0;
            color: var(--navy);
            font-size: 22px
        }

        .cta-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap
        }

        .cta-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            text-decoration: none;
            color: #fff;
            font-weight: 800;
            transition: box-shadow .2s ease, transform .2s ease
        }

        .cta-btn:hover {
            transform: translateY(-1px)
        }

        .cta-btn.wa {
            background: var(--pink);
            box-shadow: 0 0 18px rgba(255, 0, 84, .45)
        }

        .cta-btn.tg {
            background: var(--navy);
            box-shadow: 0 0 18px rgba(5, 123, 254, .35)
        }

        .cta-btn img {
            width: 20px;
            height: 20px;
            border-radius: 4px
        }

        /* Small reveal on scroll */
        .reveal {
            opacity: 0;
            transform: translateY(10px);
            transition: opacity .5s ease, transform .5s ease
        }

        .reveal.show {
            opacity: 1;
            transform: translateY(0)
        }



        :root {
            --pink: #FF0054;
            --navy: #0A0B49;
            --soft: #FBF4F2;
            --neon: #057BFE;
            --badge: #FFAE01;
        }

        body {
            margin: 0
        }

        .ss7-wrap {
            font-family: 'Poppins', system-ui, Segoe UI, Arial, sans-serif;
            background: var(--soft)
        }

        /* Hero */
        .ss7-hero {
            padding: 70px 16px 48px;
            text-align: center;
            background:
                radial-gradient(900px 500px at 50% -10%, rgba(255, 0, 84, .10), transparent 60%), var(--soft);
        }

        .ss7-hero h1 {
            margin: 0 0 8px;
            font-size: 38px;
            color: var(--navy)
        }

        .ss7-hero p {
            margin: 0 auto;
            max-width: 760px;
            color: #51535a
        }

        .ss7-hero .chips {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 14px
        }

        .chip {
            font-size: 12px;
            font-weight: 800;
            padding: 6px 10px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid rgba(10, 11, 73, .08)
        }

        .chip.pink {
            background: #ffe7ef;
            border-color: rgba(255, 0, 84, .35)
        }

        .chip.blue {
            background: #eaf3ff;
            border-color: rgba(5, 123, 254, .35)
        }

        /* Grid */
        .ss7-grid {
            max-width: 1300px;
            margin: 0 auto;
            padding: 24px 16px 64px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 22px
        }

        @media(min-width:1024px) {
            .ss7-grid {
                grid-template-columns: 1.7fr .95fr
            }
        }

        /* Cards */
        .card-shell {
            background: #fff;
            border: 1px solid rgba(10, 11, 73, .08);
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(10, 11, 73, .08)
        }

        .card-shell.pad {
            padding: 16px
        }

        /* ===== SS7 Signals table cleanup (no Blade changes) ===== */
        .table-shell .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 0;
        }

        /* Header */
        .table-shell .table thead.table-light th {
            background: #f7f8fb !important;
            color: #0A0B49;
            font-weight: 800;
            white-space: nowrap;
            border-bottom: 1px solid #e7eaf3 !important;
            padding: 12px 16px !important;
        }

        /* Body cells */
        .table-shell .table tbody td {
            vertical-align: middle;
            padding: 12px 16px !important;
            /* override py-4 heaviness */
            border-bottom: 1px solid #f0f2f8;
        }

        /* You used .py-4 on tds – trim it just inside this table */
        .table-shell .table tbody td.py-4 {
            padding-top: 12px !important;
            padding-bottom: 12px !important;
        }

        /* Row hover + stripe clean */
        .table-shell .table.table-hover tbody tr:hover {
            background: #fff9fb;
        }

        .table-shell .table.table-striped>tbody>tr:nth-of-type(odd)>* {
            --bs-table-accent-bg: #fcfdff;
            /* softer */
        }

        /* Pair column layout */
        .table-shell td[data-label="Pair"] .d-flex.align-items-center {
            gap: 10px;
        }

        .table-shell td[data-label="Pair"] img {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
        }

        .table-shell td[data-label="Pair"] .fw-bold {
            line-height: 1.2;
        }

        /* Badges consistent */
        .table-shell .badge.bg-success {
            background: #1dbf73 !important;
            font-weight: 800;
        }

        .table-shell .badge.bg-danger {
            background: #ff475d !important;
            font-weight: 800;
        }

        .table-shell .badge.bg-warning {
            background: #FFAE01 !important;
            color: #141414;
            font-weight: 800;
        }

        /* Trade button pop but not oversized */
        .table-shell .btn.btn-success.btn-sm {
            font-weight: 800;
            padding: 8px 14px;
            line-height: 1;
            background: #1dbf73;
            border-color: #17a864;
        }

        .table-shell .btn.btn-success.btn-sm:hover {
            box-shadow: 0 0 14px rgba(23, 168, 100, .35);
        }

        /* Fix header rounding & container look */
        .table-shell .table-responsive {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 22px rgba(10, 11, 73, .06);
            background: #fff;
        }

        .premium-alert {
            margin: 14px auto 0;
            max-width: 820px;
            text-align: center;
            background: #fff;
            border: 1px solid rgba(10, 11, 73, .08);
            border-radius: 12px;
            padding: 10px 14px;
            font-weight: 700;
            color: #0A0B49;
            box-shadow: 0 8px 20px rgba(10, 11, 73, .06)
        }

        .premium-alert a {
            display: inline-block;
            margin-left: 8px;
            padding: 6px 10px;
            border-radius: 8px;
            background: #FF0054;
            color: #fff;
            text-decoration: none
        }

        .premium-alert a:hover {
            box-shadow: 0 0 14px rgba(255, 0, 84, .45)
        }

        .banner.navy{ background: linear-gradient(135deg,#0a0b49,#1b57d8) }
    </style>



</head>

<body>