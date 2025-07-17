@extends('frontend.layouts.app')

@section('title', 'signal')

@section('frontend-content')
    <main>
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="table-responsive">
                        <div class="mb-3">
                            <label for="signalTypeFilter" class="form-label">Filter by Signal Type:</label>
                            <select id="signalTypeFilter" class="form-select" onchange="filterSignals()">
                                <option value="">All</option>
                                <option value="forex">Forex</option>
                                <option value="crypto">Crypto</option>
                                <option value="stock">Stock</option>
                            </select>
                        </div>
                        <table class="table m-0">
                            <!-- Table Header -->
                            <thead class="bg-light">
                                <tr>
                                    <th class="align-middle py-4">Time Closed</th>
                                    <th class="align-middle  py-4">Pair</th>
                                    <th class="align-middle d-none d-md-table-cell py-4">Action TP</th>
                                    <th class="align-middle py-4">SL</th>
                                    <th class="align-middle py-4">Result</th>
                                    <th class="align-middle py-4">Entry Price</th>
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