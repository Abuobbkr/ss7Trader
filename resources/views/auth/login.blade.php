<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Your Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> {{-- Link to your custom CSS --}}
</head>
<style>
    
/* Custom CSS for Attractive Login Page */
body {
    /* Gradient Background */
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    font-family: 'Open Sans', sans-serif; /* Default body font */
    display: flex; /* Ensures content is centered vertically */
    align-items: center; /* Centers content vertically */
    justify-content: center; /* Centers content horizontally */
    min-height: 100vh; /* Full viewport height */
    margin: 0;
    padding: 20px; /* Add some padding for smaller screens */
    box-sizing: border-box; /* Include padding in element's total width and height */
}

.card {
    background: rgba(255, 255, 255, 0.95); /* Slightly transparent white for a modern look */
    border-radius: 1.5rem !important; /* More rounded corners */
    backdrop-filter: blur(5px); /* Frosted glass effect */
    -webkit-backdrop-filter: blur(5px); /* For Safari */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Stronger shadow for depth */
}

.card-title {
    font-family: 'Poppins', sans-serif; /* Specific font for titles */
    font-size: 2.25rem; /* Larger title */
    color: #6a11cb; /* Primary color */
}

.login-logo {
    width: 90px; /* Larger logo */
    height: 90px;
    object-fit: cover;
    border: 3px solid #6a11cb; /* Border around logo */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Shadow for logo */
}

.btn-primary {
    background-color: #6a11cb; /* Primary button color */
    border-color: #6a11cb;
    transition: all 0.3s ease; /* Smooth transition for hover effects */
    font-weight: 600; /* Bolder text on button */
}

.btn-primary:hover {
    background-color: #2575fc; /* Darker shade on hover */
    border-color: #2575fc;
    transform: translateY(-2px); /* Slight lift effect */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25); /* More prominent shadow on hover */
}

.form-control-lg {
    padding: 0.75rem 1rem; /* Larger padding for input fields */
    height: auto; /* Ensure height adjusts */
    border-color: #ced4da; /* Default border color */
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-control-lg:focus {
    border-color: #6a11cb; /* Primary color on focus */
    box-shadow: 0 0 0 0.25rem rgba(106, 17, 203, 0.25); /* Glow effect on focus */
}

.input-group-text {
    background-color: #f8f9fa; /* Light background for icons */
    border: 1px solid #ced4da; /* Match input border */
    border-right: none;
    color: #6c757d; /* Icon color */
    padding-left: 1rem;
    padding-right: 0.75rem;
    border-top-left-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}

/* Specific styling for the password toggle button to match input group */
#togglePassword {
    border: 1px solid #ced4da; /* Match input border */
    border-left: none;
    border-top-right-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
    background-color: #f8f9fa;
    color: #6c757d;
    transition: background-color 0.2s ease;
}

#togglePassword:hover {
    background-color: #e2e6ea;
}

.input-group .form-control.rounded-end {
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
    border-top-right-radius: 0.5rem !important;
    border-bottom-right-radius: 0.5rem !important;
}

.input-group .form-control {
    border-left: none;
}

/* Social buttons */
.social-btn {
    width: 55px; /* Slightly larger social buttons */
    height: 55px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem; /* Larger icons */
    color: #6c757d;
    border-color: #dee2e6;
    transition: all 0.3s ease;
}

.social-btn:hover {
    background-color: #e9ecef;
    border-color: #adb5bd;
    color: #495057;
    transform: translateY(-2px);
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15); /* Enhanced shadow on hover */
}

/* Custom primary text color */
.text-primary {
    color: #6a11cb !important;
}

.text-primary:hover {
    color: #2575fc !important;
}

/* Error message styling */
.is-invalid {
    border-color: #dc3545 !important;
}
.invalid-feedback {
    color: #dc3545;
    font-size: 0.875em;
    margin-top: 0.25rem;
}

/* Ensure the container adapts to smaller screens */
@media (max-width: 576px) {
    .card {
        padding: 1.5rem !important; /* Reduce padding on small screens */
    }
    .card-title {
        font-size: 1.75rem; /* Adjust title size */
    }
    .login-logo {
        width: 70px; /* Smaller logo on small screens */
        height: 70px;
    }
    body {
        padding: 15px; /* More overall padding on small devices */
    }
}

</style>

<body class="d-flex align-items-center justify-content-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <div class="card shadow-lg border-0 rounded-4 p-4 p-sm-5">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{ asset('images/your-logo.png') }}" alt="Company Logo" class="img-fluid rounded-circle mb-3 login-logo">
                            <h2 class="card-title fw-bold text-primary mb-2">Welcome Back!</h2>
                            <p class="text-muted">Please log in to your account.</p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success mb-4 text-center">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label visually-hidden">{{ __('Email') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input id="email" class="form-control form-control-lg rounded-end @error('email') is-invalid @enderror"
                                           type="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required autofocus
                                           autocomplete="username"
                                           placeholder="Enter your email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label visually-hidden">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input id="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                           type="password"
                                           name="password"
                                           required
                                           autocomplete="current-password"
                                           placeholder="Enter your password">
                                    <button class="btn btn-outline-secondary rounded-end" type="button" id="togglePassword">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                    <label for="remember_me" class="form-check-label text-muted">{{ __('Remember me') }}</label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none text-primary fw-semibold" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                                    <i class="fas fa-sign-in-alt me-2"></i> {{ __('Log in') }}
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none text-primary fw-semibold">Sign Up</a></p>
                            <div class="mt-3">
                                <p class="text-muted mb-2">Or log in with:</p>
                                <a href="#" class="btn btn-outline-secondary rounded-circle mx-2 btn-lg social-btn">
                                    <i class="fab fa-google"></i>
                                </a>
                                <a href="#" class="btn btn-outline-secondary rounded-circle mx-2 btn-lg social-btn">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-secondary rounded-circle mx-2 btn-lg social-btn">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // JavaScript for password visibility toggle
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            const passwordInput = document.getElementById('password'); // Changed id to 'password' to match input
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            // Toggle the eye icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>