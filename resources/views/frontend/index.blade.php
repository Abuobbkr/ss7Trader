@extends('frontend.layouts.app')

@section('title', 'signal')

@section('frontend-content')

    <div class="ss7-wrap">

        <!-- HERO -->
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
       
       

        <!-- GRID -->
        <section class="ss7-grid">

            <!-- LEFT: YOUR TABLE AREA (UNTOUCHED) -->
            <div class="card table-shell reveal">
                <div class="table-note">
                    <div class="updated">Last update: <b>just now</b></div>
                    <div class="legend">
                        <span class="chip">Buy</span>
                        <span class="chip">Sell</span>
                        <span class="chip pink">Premium 🔒</span>
                    </div>
                </div>

                <!-- ✅ YOUR EXISTING TABLE (unchanged) -->
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
                                @include('frontend.partials.signal-rows', ['subscriber_type' => 'free'])
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        {{ $signals->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                <!-- /YOUR TABLE -->

                <!-- Optional ad banner under table -->
                <a class="banner blue reveal" href="https://buy.stripe.com/eVq00jaVhfqkgfv41Z8IU00" target="_blank">
                    <div class="inner">
                        <div class="kicker">Exclusive Offer</div>
                        <h4>Join Premium for $14.99/month</h4>
                        <p>Get unlimited access to Forex, Crypto, Stocks & Gold premium signals. Cancel anytime.</p>
                        <span class="cta">Buy Subscription</span>
                    </div>
                </a>
            </div>

            <!-- RIGHT: SIDEBAR (BROKER ADS + BANNERS) -->
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
                        <div class="kicker">Premium Access</div>
                        <h4>Only $14.99/month</h4>
                        <p>Unlock full TP/SL, extra signals & priority alerts with 95%+ accuracy. Instant access after
                            payment.</p>
                        <span class="cta">Upgrade Now</span>
                    </div>
                </a>

                <a class="banner navy reveal" href="https://buy.stripe.com/eVq00jaVhfqkgfv41Z8IU00" target="_blank">
                    <div class="inner">
                        <div class="kicker">Premium Dashboard</div>
                        <h4>Log in to your signals hub</h4>
                        <p>View full TP/SL levels, extra signals & priority alerts. $14.99/month.</p>
                        <span class="cta">Go to Dashboard</span>
                    </div>
                </a>
            </aside>
        </section>

        <!-- HOW TO USE -->
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

        <!-- BOTTOM CTA -->
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

            // ✅ FIXED: add backticks so Blade route becomes a string inside template literal
            fetch(`{{ route('signals.filter') }}?market_type=${type}`)
                .then(res => res.json())
                .then(data => {
                    // scope to this table area only
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