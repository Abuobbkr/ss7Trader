@extends('frontend.layouts.app')

@section('title', 'signal')

@section('frontend-content')
    <style>
        /* General container styling */
        .modal-body {
            padding-top: 0;
        }

        .fxlea-fxl-pop-up {
            font-family: Arial, sans-serif;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            max-width: 500px;
            margin: 20px auto;
        }

        /* Header styling */
        .text-black {
            color: #000;
        }

        .text-center {
            text-align: center;
        }

        .border-b-gray1-3px {
            border-bottom: 3px solid #f0f0f0;
        }

        .font-24 {
            font-size: 24px;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-center.border-b-gray1-3px {
            padding-bottom: 10px;
        }

        /* Table container margin */
        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-20 {
            margin-top: 20px;
        }

        /* Table styling */
        .tablepress {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
        }

        .tablepress thead th {
            background-color: #f5f5f5;
            padding: 12px 15px;
            text-align: left;
            font-weight: bold;
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        .tablepress tbody tr {
            border-bottom: 1px solid #eee;
        }

        .tablepress tbody tr:last-child {
            border-bottom: none;
        }

        .tablepress tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            color: #555;
        }

        .tablepress .column-1 {
            text-align: center;
            width: 40px;
            /* Adjust as needed for medal icons */
        }

        .tablepress .column-2 {
            text-align: left;
            width: 120px;
            /* Adjust as needed for broker logos */
        }

        .tablepress .column-3 {
            text-align: left;
            width: 120px;
            /* Adjust as needed for deposit info */
        }

        .tablepress .column-4 {
            text-align: center;
        }

        /* Broker logo styling */
        .tablepress .column-2 img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Deposit container styling */
        .deposit-container {
            text-align: left;
        }

        .deposit-label {
            font-size: 12px;
            color: #777;
            margin-bottom: 2px;
        }

        .deposit-amount {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        /* Sign up button styling */
        .mob-cta-btn {
            width: 120px;
            /* Fixed width for consistency */
            height: auto;
            display: block;
            margin: 0 auto;
            /* Center the button */
            border: none;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .mob-cta-btn:hover {
            transform: scale(1.05);
        }

        /* Row striping and hover effects */
        .row-striping tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .row-hover tbody tr:hover {
            background-color: #f0f8ff;
            /* Light blue on hover */
        }

        /* Specific medal icon colors (if applicable, though they are images here) */
        .column-1 span {
            font-size: 1.2em;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .fxlea-fxl-pop-up {
                margin: 10px;
                /* Smaller margin on smaller screens */
            }

            .tablepress thead th,
            .tablepress tbody td {
                padding: 8px 10px;
                /* Reduce padding for smaller screens */
                font-size: 14px;
                /* Smaller font size for table content */
            }

            .tablepress .column-1 {
                width: 30px;
                /* Adjust medal column width */
            }

            .tablepress .column-2 {
                width: 90px;
                /* Adjust broker logo column width */
            }

            .tablepress .column-2 img {
                max-width: 80px;
                /* Smaller logo size */
            }

            .tablepress .column-3 {
                width: 100px;
                /* Adjust deposit column width */
            }

            .deposit-label {
                font-size: 10px;
            }

            .deposit-amount {
                font-size: 14px;
            }

            .mob-cta-btn {
                width: 100px;
                /* Smaller button size */
            }

            .font-24 {
                font-size: 20px;
                /* Smaller heading font size */
            }
        }

        @media (max-width: 576px) {
            .fxlea-fxl-pop-up {
                border-radius: 0;
                /* Remove border-radius for full width on very small screens */
                margin: 0;
                /* No margin on very small screens */
                max-width: 100%;
                /* Take full width */
            }

            .tablepress thead {
                display: none;
                /* Hide table header on very small screens */
            }

            .tablepress tbody,
            .tablepress tr,
            .tablepress td {
                display: block;
                /* Make table elements block-level */
                width: 100%;
                /* Each cell takes full width */
            }

            .tablepress tr {
                margin-bottom: 15px;
                /* Add space between rows */
                border: 1px solid #ddd;
                /* Add a border to individual rows */
                border-radius: 5px;
            }

            .tablepress td {
                text-align: right !important;
                /* Align content to the right */
                padding-left: 50%;
                /* Make space for pseudo-elements */
                position: relative;
            }

            .tablepress td::before {
                content: attr(data-label);
                /* Use data-label for content */
                position: absolute;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
                color: #333;
            }

            /* Assign data-label attributes to table cells for mobile view */
            .tablepress .row-2 .column-1::before {
                content: "Rank:";
            }

            .tablepress .row-2 .column-2::before {
                content: "Broker:";
            }

            .tablepress .row-2 .column-3::before {
                content: "Deposit:";
            }

            .tablepress .row-2 .column-4::before {
                content: "Sign Up:";
            }

            .tablepress .row-3 .column-1::before {
                content: "Rank:";
            }

            .tablepress .row-3 .column-2::before {
                content: "Broker:";
            }

            .tablepress .row-3 .column-3::before {
                content: "Deposit:";
            }

            .tablepress .row-3 .column-4::before {
                content: "Sign Up:";
            }

            .tablepress .row-4 .column-1::before {
                content: "Rank:";
            }

            .tablepress .row-4 .column-2::before {
                content: "Broker:";
            }

            .tablepress .row-4 .column-3::before {
                content: "Deposit:";
            }

            .tablepress .row-4 .column-4::before {
                content: "Sign Up:";
            }

            .tablepress .row-5 .column-1::before {
                content: "Rank:";
            }

            .tablepress .row-5 .column-2::before {
                content: "Broker:";
            }

            .tablepress .row-5 .column-3::before {
                content: "Deposit:";
            }

            .tablepress .row-5 .column-4::before {
                content: "Sign Up:";
            }

            .tablepress .column-2 img,
            .tablepress .column-4 .mob-cta-btn {
                margin: 0;
                /* Remove auto margin to align better with right-aligned text */
                display: inline-block;
                /* Allow inline display with the label */
                vertical-align: middle;
            }
        }
    </style>


    <main>
        <div class="fluid-container">
            <div class="row p-5 mt-5">
                <div class="col-8">
                    <div class="table-responsive">
                        <div class="mb-3">
                            <label for="signalTypeFilter" class="form-label">Filter by Signal Type:</label>
                            <select id="signalTypeFilter" class="form-select" onchange="filterSignals()">
                                <option value="">All</option>
                                <option value="forex">Forex</option>
                                <option value="crypto">Crypto</option>
                            </select>
                        </div>
                        <table class="table m-0">
                            <!-- Table Header -->
                            <thead class="bg-light">
                                <tr>
                                    <th class="align-middle  ">Pair</th>
                                    <th class="align-middle  ">Order Type</th>
                                    <th class="align-middle ">Entry Price</th>
                                    <th class="align-middle ">Stop Loss</th>
                                    <th class="align-middle ">Take Profit</th>
                                    <th class="align-middle "></th>
                                </tr>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                                @include('frontend.partials.signal-rows')
                            </tbody>

                        </table>
                        <div class="mt-4 text-end">
                            {{ $signals->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card p-3">
                        <div class="fxlea-f2a100c7e747e0a072f3768bc61b2b61 fxlea-fxl-pop-up"
                            id="fxlea-f2a100c7e747e0a072f3768bc61b2b61">
                            <div class="fxlea-fxl-pop-up" id="fxlea-2890559669">
                                <div data-fxlea-trackid="365124" data-fxlea-trackbid="1" class="fxlea-target"
                                    id="fxlea-2955862937">
                                    <div class="text-black text-center border-b-gray1-3px" style="padding-bottom: 10px;">
                                        <div class="font-24 font-bold">🏆 Top 4 Brokers</div>
                                    </div>

                                    <div class="m-b-10 m-t-20">
                                        <table id="tablepress-135" class="tablepress tablepress-id-135">
                                            <thead>
                                                <tr class="row-1">
                                                    <td class="column-1"></td>
                                                    <th class="column-2">Broker</th>
                                                    <th class="column-3">Deposit</th>
                                                    <th class="column-4">Sign Up</th>
                                                </tr>
                                            </thead>
                                            <tbody class="row-striping row-hover">
                                                <tr class="row-2">
                                                    <td class="column-1" data-label="Rank:">🥇</td>
                                                    <td class="column-2" data-label="Broker:">
                                                        <img decoding="async"
                                                            src="https://forexsuggest.com/wp-content/uploads/2020/11/Avatrade.png"
                                                            width="100px" />
                                                    </td>
                                                    <td class="column-3" data-label="Deposit:">
                                                        <div class="deposit-container">
                                                            <div class="deposit-label">Minimum Deposit</div>
                                                            <div class="deposit-amount">$100</div>
                                                        </div>
                                                    </td>
                                                    <td class="column-4" data-label="Sign Up:">
                                                        <a href="https://www.fxleaders.com/avatrade" target="_blank"
                                                            rel="noopener"><img decoding="async"
                                                                src="https://forexsuggest.com/wp-content/uploads/2025/03/Call-to-action-button.jpg"
                                                                alt="Visit Broker" class="mob-cta-btn" /></a>
                                                    </td>
                                                </tr>
                                                <tr class="row-3">
                                                    <td class="column-1" data-label="Rank:">🥈</td>
                                                    <td class="column-2" data-label="Broker:">
                                                        <img decoding="async"
                                                            src="https://forexsuggest.com/wp-content/uploads/2025/05/PrimeXBT-Logo.png"
                                                            width="100px" />
                                                    </td>
                                                    <td class="column-3" data-label="Deposit:">
                                                        <div class="deposit-container">
                                                            <div class="deposit-label">Minimum Deposit</div>
                                                            <div class="deposit-amount">$10</div>
                                                        </div>
                                                    </td>
                                                    <td class="column-4" data-label="Sign Up:">
                                                        <a href="https://www.fxleaders.com/primexbt" target="_blank"
                                                            rel="noopener"><img decoding="async"
                                                                src="https://forexsuggest.com/wp-content/uploads/2025/03/Call-to-action-button.jpg"
                                                                alt="Visit Broker" class="mob-cta-btn" /></a>
                                                    </td>
                                                </tr>
                                                <tr class="row-4">
                                                    <td class="column-1" data-label="Rank:">3</td>
                                                    <td class="column-2" data-label="Broker:">
                                                        <img decoding="async"
                                                            src="https://forexsuggest.com/wp-content/uploads/2025/04/FXTM-logo.png"
                                                            width="100px" />
                                                    </td>
                                                    <td class="column-3" data-label="Deposit:">
                                                        <div class="deposit-container">
                                                            <div class="deposit-label">Minimum Deposit</div>
                                                            <div class="deposit-amount">$200</div>
                                                        </div>
                                                    </td>
                                                    <td class="column-4" data-label="Sign Up:">
                                                        <a href="https://www.fxleaders.com/fxtm" target="_blank"
                                                            rel="noopener"><img decoding="async"
                                                                src="https://forexsuggest.com/wp-content/uploads/2025/03/Call-to-action-button.jpg"
                                                                alt="Visit Broker" class="mob-cta-btn" /></a>
                                                    </td>
                                                </tr>
                                                <tr class="row-5">
                                                    <td class="column-1" data-label="Rank:">4</td>
                                                    <td class="column-2" data-label="Broker:">
                                                        <img decoding="async"
                                                            src="https://forexsuggest.com/wp-content/uploads/2020/11/Exness-logo.png"
                                                            width="100px" />
                                                    </td>
                                                    <td class="column-3" data-label="Deposit:">
                                                        <div class="deposit-container">
                                                            <div class="deposit-label">Minimum Deposit</div>
                                                            <div class="deposit-amount">$10</div>
                                                        </div>
                                                    </td>
                                                    <td class="column-4" data-label="Sign Up:">
                                                        <a href="https://www.fxleaders.com/exness" target="_blank"
                                                            rel="noopener"><img decoding="async"
                                                                src="https://forexsuggest.com/wp-content/uploads/2025/03/Call-to-action-button.jpg"
                                                                alt="Visit Broker" class="mob-cta-btn" /></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    </main>


    <!-- FOOTER SECTION -->
    <div class="container custom-sm-container" style=" margin-bottom: 50px;">
        <footer class=" bg-white text-dark pt-5 pb-4" style="margin-top: 100px; margin-bottom: 50px;">
            <div class="row">
                <!-- Company Info Column -->
                <!-- Column 1: Company Info -->
                <div class="col-lg-4 col-md-6 col-sm-12 order-lg-1 order-md-1 order-sm-1 mb-4 footer-content">
                    <div class="text-lg-start text-md-center text-center">
                        <!-- Logo -->
                        <img class="logo2 mb-3 img-fluid mx-lg-0 mx-md-auto mx-auto" src="./assets/images/sstradersimg.png"
                            alt="SS7 Traders Logo" style="max-width: 320px; position: relative; right: 12px;">

                        <!-- Phone Number -->
                        <div class="mt-4 mb-sm-3">
                            <a class="number fs-5 fs-md-4">+44 (7) 926 772 876</a>
                        </div>

                        <!-- Working Hours -->
                        <div class="lh-sm  mt-sm-3">
                            <p class="mb-1 small date-time">Monday - Friday: 09:00 AM - 06:00 PM</p>
                            <p class="mb-3 small">Sat: 07:00 AM - 08:00 PM</p>
                        </div>

                        <!-- Payment Icons -->
                        <div
                            class="payment-icons-container d-flex flex-wrap align-items-center gap-3 justify-content-lg-start justify-content-center mt-lg-5 mt-md-4 mt-3">
                            <img class=" payment-icon" src="./assets/images/visa.png" alt="Visa" style="height: 30px;">
                            <img class="payment-icon" src="./assets/images/discver.png" alt="Discover"
                                style="height: 30px;">
                            <img class="payment-icon" src="./assets/images/mastercard.png" alt="mastercard"
                                style="height: 17px;">
                            <img class="payment-icon" src="./assets/images/paypol.png" alt="PayPal" style="height: 25px;">
                            <img class="payment-icon" src="./assets/images/gpay.png" alt="Google Pay" style="height: 18px;">
                            <img class="payment-icon" src="./assets/images/applepay.png" alt="Apple Pay"
                                style="height: 21px;">
                        </div>
                    </div>
                </div>

                <!-- Links Columns -->
                <div class="col-lg-4 col-md-12 col-sm-12 order-lg-2 order-md-3 order-sm-3 mb-4">
                    <div class="row h-100">
                        <div class="col-6 footer-links">
                            <h5 class="footer-heading text-lg-start text-md-start text-center d-flex">Useful Links</h5>
                            <ul class="list-unstyled text-lg-start text-md-start text-center">
                                <li><a href="#" class="text-black d-flex text-decoration-none">Contact Us</a></li>
                                <li><a href="#" class="text-black d-flex text-decoration-none">Help & About Us</a></li>
                                <li><a href="#" class="text-black d-flex text-decoration-none">Shipping & Returns</a>
                                </li>
                                <li><a href="#" class="text-black d-flex text-decoration-none">Refund Policy</a></li>
                            </ul>
                        </div>

                        <div class="col-6 footer-links">
                            <h5 class="footer-heading text-lg-start text-md-start text-center d-flex">Customer Service
                            </h5>
                            <ul class="list-unstyled text-lg-start text-md-start text-center">
                                <li><a href="#" class="text-black d-flex text-decoration-none">Orders</a></li>
                                <li><a href="#" class="text-black d-flex text-decoration-none">Downloads</a></li>
                                <li><a href="#" class="text-black d-flex text-decoration-none">Addresses</a></li>
                                <li><a href="#" class="text-black d-flex text-decoration-none">Account details</a></li>
                                <li><a href="#" class="text-black d-flex text-decoration-none">Lost password</a></li>
                            </ul>
                        </div>

                        <div class="col-12 footer-links mt-lg-1 mt-md-1 mt-2">
                            <h5 class="footer-heading text-lg-start text-md-start text-center d-flex">Delivery</h5>
                            <ul class="list-unstyled text-lg-start text-md-start text-center">
                                <li><a href="#" class="text-black text-decoration-none d-flex">How it Works</a></li>
                                <li><a href="#" class="text-black text-decoration-none d-flex">Free Delivery</a></li>
                                <li><a href="#" class="text-black text-decoration-none d-flex">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Newsletter Column -->
                <div class="col-lg-4 col-md-6 col-sm-12 order-lg-3 order-md-2 order-sm-2">
                    <div class="footer-card h-100">
                        <div class="text-center">
                            <p class="mb-1">Stay up to date and subscribe</p>
                            <p>to our newsletter</p>
                        </div>
                        <div class="envelope-wrapper">
                            <span class="envelope">📩</span>
                        </div>
                        <style>
                            .envelope-wrapper {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100px;
                            }

                            .envelope {
                                font-size: 58px;
                                animation: bounceGlow 2s infinite ease-in-out;
                            }

                            /* Animation Keyframes */
                            @keyframes bounceGlow {

                                0%,
                                100% {
                                    transform: translateY(0);
                                    text-shadow: 0 0 5px var(--primary-color)
                                }

                                50% {
                                    transform: translateY(-10px);
                                    text-shadow: 0 0 5px var(--primary-color)
                                }
                            }
                        </style>
                        <form id="newsletterForm" novalidate>
                            <div class="mb-3">
                                <input class="w-100 border-0 border-bottom custom-input" type="email" id="newsletterEmail"
                                    name="email" placeholder="E-mail..." required />
                                <div class="invalid-feedback email-error">
                                    Please provide a valid email address
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mt-3">
                                <button type="submit" class="btn pt-3 pb-3">Sign Up</button>
                            </div>
                            <div class="alert alert-success mt-3 d-none" id="successMessage">
                                Thank you for subscribing!
                            </div>
                        </form>
                    </div>
                </div>
            </div>

@endsection
        @push('scripts')
            <script>
                function filterSignals() {
                    let type = document.getElementById('signalTypeFilter').value;

                    fetch(`{{ route('signals.filter') }}?market_type=${type}`)
                        .then(res => res.json())
                        .then(data => {
                            document.querySelector('tbody').innerHTML = data.html;
                            document.querySelector('.text-end').innerHTML = data.pagination;
                        })
                        .catch(err => console.error(err));
                }
            </script>
        @endpush