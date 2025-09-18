@extends('frontend.layouts.app')

@section('title', 'signal')

@section('frontend-content')

    <style>
        /* Variables for a cleaner look */
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --font-family: 'Inter', sans-serif;
        }

        body {
            font-family: var(--font-family);
        }

        .navbar-brand .badge {
            background-color: var(--primary-color) !important;
            padding: 8px 15px;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 1px;
            border-radius: 50px;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
        }

        .navbar {
            background-color: #fff !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
        }

        .nav-link {
            color: var(--secondary-color) !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover,
        .nav-link:focus {
            color: var(--primary-color) !important;
        }

        .nav-item .nav-link.active,
        .nav-item .nav-link.fw-bold {
            color: var(--primary-color) !important;
            position: relative;
        }

        .nav-item .nav-link.active::after,
        .nav-item .nav-link.fw-bold::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 50px;
        }

        .dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .btn.rounded-pill {
            font-weight: 600;
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color) !important;
            color: #fff !important;
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('frontend.signal.index') }}">
                <img src="https://ss7trader.com/wp-content/uploads/2025/05/SS7-TRADER-Academy-1-Edited.png#127"
                    style="width: 200px;" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @if(session('subscriber_user_name'))
                        <li class="nav-item d-flex align-items-center me-3">
                            <span style="color:#fe0061; background-color: #f3f4f6;">
                                <b> Welcome back, {{ session('subscriber_user_name') }}! Premium Dashboard is Live.</b>
                            </span>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(session('subscriber_user_name')) }}&background=fe0061&color=fff&bold=true"
                                    alt="User Profile" class="rounded-circle"
                                    style="width: 38px; height: 38px; border: 2px solid #fff;">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex bg-transparent border-0">
                                            <i class="ti ti-logout fs-18 me-2 op-7"></i>Log Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="ss7-wrap">

        <section class="ss7-hero container-fluid">
            <span class="badge badge-pill badge-primary"><span class="dot"></span> SS7Trader • Live Signals</span>
            <h1 class="display-4 text-center my-4">Forex, Stocks, Crypto & Gold Signals</h1>
            <p class="lead text-center mb-4">Free signals are visible below. Premium entries & full TP/SL for subscribers
                only. Updated throughout the day.</p>
            <div class="d-flex flex-wrap justify-content-center my-3">
                <span class="chip badge badge-pill badge-info m-2">Free Signals</span>
                <span class="chip badge badge-pill badge-secondary m-2">Premium Available</span>
                <span class="chip badge badge-pill badge-primary m-2">Updated Every 5 min</span>
            </div>
        </section>
    </div>
    <div class="labels">

        <section class="ss7-grid">

            <div class="card table-shell reveal">
                <div class="table-note">
                    <div class="updated">Last update: <b>just now</b></div>
                    <div class="legend">
                        <span class="chip">Buy</span>
                        <span class="chip">Sell</span>
                        <span class="chip pink">Premium 🔒</span>
                    </div>
                </div>

                <div class="card-body p-3">
                    <div class="d-flex align-items-center mb-3">
                        <label for="signalTypeFilter" class="form-label mb-0 me-2 text-muted fw-bold">Filter by
                            Signal Type:</label>
                        <select id="signalTypeFilter" class="form-select w-auto" onchange="filterSignals()">
                            <option value="">All</option>
                            <option value="forex">Forex</option>
                            <option value="crypto">Crypto</option>
                            <option value="stock">Stock</option>
                            <option value="commodities">Commodities</option>
                            <option value="indices">Indices</option>
                        </select>
                    </div>

                    <div class="table-responsive" style="max-width: 100%; overflow-x: auto;">
                        <table class="table table-hover table-striped align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Pair</th>
                                    <th scope="col">Order Type</th>
                                    <th scope="col">Entry Price</th>
                                    <th scope="col">Stop Loss</th>
                                    <th scope="col">Take Profit</th>
                                    <th scope="col">Result</th>

                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('frontend.partials.signal-rows', ['subscriber_type' => 'free'])
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        {{ $signals->links('pagination::bootstrap-5') }}
                    </div>
                </div>

                <a class="banner blue reveal" href="https://buy.stripe.com/eVq00jaVhfqkgfv41Z8IU00" target="_blank">
                    <div class="inner">
                        <div class="kicker"> </div>
                        <h4>Funded Account Help</h4>
                        <p>Step-by-step guidance to pass FTMO & MyForexFunds challenges. Proven strategies, risk control &
                            coaching to secure your funded account.</p>
                        <span class="cta">Get Help Now</span>
                    </div>
                </a>
            </div>

            <aside class="side-stack">
                <div class="card reveal">
                    <div class="side-title">
                        <svg class="trophy" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M19 3h-3V2H8v1H5v4c0 2.21 1.79 4 4 4 .91 0 1.74-.31 2.4-.82.66.51 1.49.82 2.4.82 2.21 0 4-1.79 4-4V3zM7 7V5h1v2c0 .55-.45 1-1 1zm10 0c0 .55-.45 1-1 1s-1-.45-1-1V5h2v2zM8 13h8v2H8v-2zm2 3h4v2h-4v-2z" />
                        </svg>
                        <h3>Top Broker Offers</h3>
                    </div>

                    <div class="broker">
                        <div class="b-left">
                            <div class="b-logo"><img src="https://logo.clearbit.com/bitget.com" alt=""></div>
                            <div>
                                <div class="b-name">Bitget</div>
                                <div class="b-sub">Min. Deposit <b>$100</b></div>
                            </div>
                        </div>
                        <a class="b-cta" href="<?php echo getenv('BITGET_REFERRAL_URL'); ?>" target="_blank">
                            Visit <svg class="arrow" viewBox="0 0 24 24">
                                <path d="M10 17l5-5-5-5v10z" />
                            </svg>
                        </a>
                    </div>

                    <div class="broker">
                        <div class="b-left">
                            <div class="b-logo"><img src="https://logo.clearbit.com/binance.com" alt=""></div>
                            <div>
                                <div class="b-name">Binance</div>
                                <div class="b-sub">Min. Deposit <b>$10</b></div>
                            </div>
                        </div>
                        <a class="b-cta" href="<?php echo getenv('BINANCE_REFERRAL_URL'); ?>" target="_blank">
                            Visit <svg class="arrow" viewBox="0 0 24 24">
                                <path d="M10 17l5-5-5-5v10z" />
                            </svg>
                        </a>
                    </div>

                    <div class="broker">
                        <div class="b-left">
                            <div class="b-logo"><img src="https://logo.clearbit.com/xm.com" alt=""></div>
                            <div>
                                <div class="b-name">XM</div>
                                <div class="b-sub">Min. Deposit <b>$200</b></div>
                            </div>
                        </div>
                        <a class="b-cta" href="<?php echo getenv('XM_REFERRAL_URL'); ?>" target="_blank">
                            Visit <svg class="arrow" viewBox="0 0 24 24">
                                <path d="M10 17l5-5-5-5v10z" />
                            </svg>
                        </a>
                    </div>

                    <div class="broker">
                        <div class="b-left">
                            <div class="b-logo"><img src="https://logo.clearbit.com/exness.com" alt=""></div>
                            <div>
                                <div class="b-name">Exness</div>
                                <div class="b-sub">Min. Deposit <b>$10</b></div>
                            </div>
                        </div>
                        <a class="b-cta" href="<?php echo getenv('EXNESS_REFERRAL_URL'); ?>" target="_blank">
                            Visit <svg class="arrow" viewBox="0 0 24 24">
                                <path d="M10 17l5-5-5-5v10z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <a class="banner pink reveal" href="https://buy.stripe.com/eVq00jaVhfqkgfv41Z8IU00" target="_blank">
                    <div class="inner">
                        <div class="kicker">Mentorship Sessions (Private Coaching)
                        </div>
                        <h4>Book 1-on-1 mentorship sessions with our trading experts.
                        </h4>
                        <p>Personalized strategy breakdowns, account growth plans, and direct Q&A.
                        </p>
                        <span class="cta">Book a Mentorship Session</span>
                    </div>
                </a>

                <a class="banner navy reveal" href="https://buy.stripe.com/eVq00jaVhfqkgfv41Z8IU00" target="_blank">
                    <div class="inner">
                        <div class="kicker">Automated Tools (MT4/MT5)
                        </div>
                        <h4>Download ready-to-use Expert Advisor's for MT4/MT5.
                        </h4>
                        <p>Auto-trading features with adjustable risk settings.</p>
                        <span class="cta">Get Your EA Tools</span>
                    </div>
                </a>
            </aside>
        </section>

        <section class="howto">
            <div class="how-grid">
                <div class="how reveal">
                    <div class="num">1</div>
                    <h5>Select Market</h5>
                    <p>Forex, Crypto, Stocks or Gold — use the filter in the table to pick your market.</p>
                </div>
                <div class="how reveal">
                    <div class="num">2</div>
                    <h5>Execute the Plan</h5>
                    <p>Follow Entry, SL & TP. Manage risk per your plan (0.5–1R typical).</p>
                </div>
                <div class="how reveal">
                    <div class="num">3</div>
                    <h5>Upgrade for Premium</h5>
                    <p>Unlock full levels, extra signals & priority alerts.</p>
                </div>
            </div>
        </section>

        <section class="bottom-cta">
            <div class="cta-box reveal">
                <h3>Questions or want Premium access?</h3>
                <div class="cta-actions">
                    <a class="cta-btn wa" href="https://wa.me/447926772876" target="_blank">
                        <img src="https://ss7trader.com/wp-content/uploads/2025/08/weffr.webp" alt=""> WhatsApp
                    </a>
                    <a class="cta-btn tg" href="https://t.me/SSsevenTrader" target="_blank">
                        <img src="https://ss7trader.com/wp-content/uploads/2025/08/dewdewd.webp" alt=""> Telegram
                    </a>
                </div>
            </div>
        </section>

    </div>

    <script>
        // simple reveal on scroll
        const io = new IntersectionObserver((en) => {
            en.forEach(e => { if (e.isIntersecting) { e.target.classList.add('show'); io.unobserve(e.target); } });
        }, { threshold: .18 });
        document.querySelectorAll('.reveal').forEach(el => io.observe(el));
    </script>

@endsection

@push('scripts')
    <script>
        function filterSignals() {
            console.log('Filtering signals...');
            const type = document.getElementById('signalTypeFilter').value;
            fetch(`{{ route('signals.filter') }}?market_type=${type}`)
                .then(res => res.json())
                .then(data => {
                    const tableShell = document.querySelector('.card.table-shell');
                    if (!tableShell) return;
                    const tbody = tableShell.querySelector('tbody');
                    if (tbody) tbody.innerHTML = data.html;
                    const pagWrap = tableShell.querySelector('.mt-4.d-flex.justify-content-end');
                    if (pagWrap) pagWrap.innerHTML = data.pagination;
                })
                .catch(err => console.error(err));
        }
    </script>
@endpush