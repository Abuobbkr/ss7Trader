    <!-- Footer Bottom/Copyright -->
            <div class="container">
                <hr>
                <div class="footer-bottom">
                    <p class="mb-0 text-lg-start text-md-start text-center">
                        © 2022 Betheme by <a class="text-decoration-none Muffin-group">Muffin group</a> |
                        All Rights Reserved | Powered by <a class="text-decoration-none Muffin-group">WordPress</a>
                    </p>
                </div>
            </div>

        </footer>
    </div>
    <!-- JS Libraries -->
    <script src="{{ asset('frontend/bootstrap/bootstrap.js') }}" defer></script>
    <script src="{{ asset('frontend/js/asidebar.js') }}" defer></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('frontend/js/validate.js') }}" defer></script>

    
    <script>
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 0) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

    </script>
</body>

</html>