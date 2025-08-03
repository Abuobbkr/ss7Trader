@extends('frontend.layouts.app')

@section('title', 'signal')

@section('frontend-content')



    <main>
        <div class="fluid-container">
            <div class="row p-5 mt-5">
                <div class="col-12 col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center mb-3">
                                <label for="signalTypeFilter" class="form-label mb-0 me-2 text-muted fw-bold">Filter by
                                    Signal Type:</label>
                                <select id="signalTypeFilter" class="form-select w-auto" onchange="filterSignals()">
                                    <option value="">All</option>
                                    <option value="forex">Forex</option>
                                    <option value="crypto">Crypto</option>
                                    <option value="stock">Stock</option>
                                </select>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Pair</th>
                                            <th scope="col">Order Type</th>
                                            <th scope="col">Entry Price</th>
                                            <th scope="col">Stop Loss</th>
                                            <th scope="col">Take Profit</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('frontend.partials.signal-rows', ['subscriber_type' => 'premium'])
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4 d-flex justify-content-end">
                                {{ $signals->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mx-auto p-0">
                    <div class="card shadow-sm">
                        <div class="card-header text-center border-0 bg-white">
                            <h5 class="fw-bold my-2">🏆 Top 4 Brokers</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover align-middle mb-0">
                                    <thead>
                                        <tr class="d-none d-md-table-row">
                                            <th scope="col" class="pb-2"></th>
                                            <th scope="col" class="pb-2">Broker</th>
                                            <th scope="col" class="pb-2 text-center">Deposit</th>
                                            <th scope="col" class="pb-2">Sign Up</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-bottom">
                                            <td class="d-none d-md-table-cell text-center" data-label="Rank:">🥇</td>
                                            <td class="d-flex align-items-center justify-content-start"
                                                data-label="Broker:">
                                                <img src="https://forexsuggest.com/wp-content/uploads/2020/11/Avatrade.png"
                                                    alt="Avatrade logo" class="img-fluid me-2" style="max-width: 80px;" />
                                                <span class="d-md-none fw-bold">Avatrade</span>
                                            </td>
                                            <td class="text-center" data-label="Deposit:">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="text-muted small">Minimum Deposit</div>
                                                    <div class="fw-bold">$100</div>
                                                </div>
                                            </td>
                                            <td class="text-center" data-label="Sign Up:">
                                                <a href="https://www.fxleaders.com/avatrade" target="_blank" rel="noopener">
                                                    <img src="https://forexsuggest.com/wp-content/uploads/2025/03/Call-to-action-button.jpg"
                                                        alt="Visit Broker" class="mob-cta-btn img-fluid"
                                                        style="max-width: 100px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="d-none d-md-table-cell text-center" data-label="Rank:">🥈</td>
                                            <td class="d-flex align-items-center justify-content-start"
                                                data-label="Broker:">
                                                <img src="https://forexsuggest.com/wp-content/uploads/2025/05/PrimeXBT-Logo.png"
                                                    alt="PrimeXBT logo" class="img-fluid me-2" style="max-width: 80px;" />
                                                <span class="d-md-none fw-bold">PrimeXBT</span>
                                            </td>
                                            <td class="text-center" data-label="Deposit:">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="text-muted small">Minimum Deposit</div>
                                                    <div class="fw-bold">$10</div>
                                                </div>
                                            </td>
                                            <td class="text-center" data-label="Sign Up:">
                                                <a href="https://www.fxleaders.com/primexbt" target="_blank" rel="noopener">
                                                    <img src="https://forexsuggest.com/wp-content/uploads/2025/03/Call-to-action-button.jpg"
                                                        alt="Visit Broker" class="mob-cta-btn img-fluid"
                                                        style="max-width: 100px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="d-none d-md-table-cell text-center" data-label="Rank:">3</td>
                                            <td class="d-flex align-items-center justify-content-start"
                                                data-label="Broker:">
                                                <img src="https://forexsuggest.com/wp-content/uploads/2025/04/FXTM-logo.png"
                                                    alt="FXTM logo" class="img-fluid me-2" style="max-width: 80px;" />
                                                <span class="d-md-none fw-bold">FXTM</span>
                                            </td>
                                            <td class="text-center" data-label="Deposit:">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="text-muted small">Minimum Deposit</div>
                                                    <div class="fw-bold">$200</div>
                                                </div>
                                            </td>
                                            <td class="text-center" data-label="Sign Up:">
                                                <a href="https://www.fxleaders.com/fxtm" target="_blank" rel="noopener">
                                                    <img src="https://forexsuggest.com/wp-content/uploads/2025/03/Call-to-action-button.jpg"
                                                        alt="Visit Broker" class="mob-cta-btn img-fluid"
                                                        style="max-width: 100px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="border-bottom">
                                            <td class="d-none d-md-table-cell text-center" data-label="Rank:">4</td>
                                            <td class="d-flex align-items-center justify-content-start"
                                                data-label="Broker:">
                                                <img src="https://forexsuggest.com/wp-content/uploads/2020/11/Exness-logo.png"
                                                    alt="Exness logo" class="img-fluid me-2" style="max-width: 80px;" />
                                                <span class="d-md-none fw-bold">Exness</span>
                                            </td>
                                            <td class="text-center" data-label="Deposit:">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="text-muted small">Minimum Deposit</div>
                                                    <div class="fw-bold">$10</div>
                                                </div>
                                            </td>
                                            <td class="text-center" data-label="Sign Up:">
                                                <a href="https://www.fxleaders.com/exness" target="_blank" rel="noopener">
                                                    <img src="https://forexsuggest.com/wp-content/uploads/2025/03/Call-to-action-button.jpg"
                                                        alt="Visit Broker" class="mob-cta-btn img-fluid"
                                                        style="max-width: 100px;" />
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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