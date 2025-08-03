<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login to Your Account</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    crossorigin="anonymous" />

  {{-- Your custom CSS --}}
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">

  <style>
    body {
      background: linear-gradient(135deg, #0d0d22 0%, #1a1a40 100%);
      font-family: 'Open Sans', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      margin: 0;
      color: #e0e0e0;
    }

    .card {
      background: #1a1a2e !important;
      border-radius: 1.5rem !important;
      box-shadow: 0 0 20px rgba(255, 105, 180, 0.15) !important;
      border: 1px solid #ff69b4 !important;
      padding: 2.5rem !important;
      color: #e0e0e0;
      transition: box-shadow 0.3s ease;
    }

    .card:hover {
      box-shadow: 0 0 30px rgba(255, 105, 180, 0.3) !important;
    }

    .card-title {
      font-family: 'Poppins', sans-serif;
      font-size: 2rem;
      color: #ff1493 !important;
      font-weight: 700;
      text-align: center;
      margin-bottom: 1.5rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      text-shadow: 0 0 2px #ff1493;
    }

    .text-muted {
      color: #b0b6cc !important;
      text-align: center;
      margin-bottom: 1.5rem;
      font-weight: 600;
    }

    .form-control-lg {
      background-color: #2c2c50 !important;
      color: #fff !important;
      border: 1.5px solid #ff69b4 !important;
      box-shadow: inset 0 0 6px rgba(255, 105, 180, 0.1);
      padding: 0.75rem 1rem;
      font-weight: 600;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control-lg:focus {
      background-color: #3b3b6f !important;
      border-color: #ff1493 !important;
      box-shadow: 0 0 12px rgba(255, 105, 180, 0.3) !important;
      color: #fff !important;
    }

    .input-group-text {
      background-color: #ff69b4 !important;
      color: #1a1a2e !important;
      border: none !important;
      border-top-left-radius: 0.5rem !important;
      border-bottom-left-radius: 0.5rem !important;
      font-size: 1.2rem;
      padding: 0.75rem 1rem;
    }

    #togglePassword {
      background-color: #ff69b4 !important;
      border: none !important;
      color: #1a1a2e !important;
      border-top-right-radius: 0.5rem !important;
      border-bottom-right-radius: 0.5rem !important;
      transition: background-color 0.3s ease;
    }

    #togglePassword:hover {
      background-color: #ff1493 !important;
    }

    .btn-primary {
      background: linear-gradient(90deg, #ff69b4 0%, #ff1493 100%) !important;
      border: none !important;
      font-weight: 700 !important;
      padding: 0.75rem 1rem !important;
      border-radius: 50px !important;
      color: white !important;
      box-shadow: 0 5px 14px rgba(255, 105, 180, 0.3) !important;
      transition: background 0.3s ease, box-shadow 0.3s ease !important;
    }

    .btn-primary:hover {
      background: linear-gradient(90deg, #ff1493 0%, #ff69b4 100%) !important;
      box-shadow: 0 7px 20px rgba(255, 105, 180, 0.5) !important;
      transform: translateY(-2px);
    }

    .text-primary {
      color: #ff1493 !important;
      font-weight: 700 !important;
    }

    .text-primary:hover {
      color: #ff69b4 !important;
      text-decoration: underline;
    }

    .form-check-label {
      color: #ccc;
      font-weight: 600;
    }

    .alert-success {
      background-color: rgba(39, 174, 96, 0.1) !important;
      color: #27ae60 !important;
      border: 1px solid #27ae60 !important;
      border-radius: 12px;
      font-weight: 700;
      text-align: center;
      box-shadow: 0 0 15px #27ae60;
      margin-bottom: 1.5rem;
    }

    @media (max-width: 576px) {
      .card {
        padding: 1.5rem !important;
      }

      .card-title {
        font-size: 1.75rem;
      }
    }
  </style>


</head>

<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="card shadow-lg border-0 rounded-4 p-4 p-sm-5">
          <div class="card-body">
            <div class="text-center mb-4">
              <h2 class="card-title">SS7Trader Academy</h2>
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
                  <input id="email"
                    class="form-control form-control-lg rounded-end @error('email') is-invalid @enderror" type="email"
                    name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    placeholder="Enter your email" />
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
                    type="password" name="password" required autocomplete="current-password"
                    placeholder="Enter your password" />
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
                  <input id="remember_me" type="checkbox" class="form-check-input" name="remember" />
                  <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
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
              <p class="text-muted">Don't have an account? <a href="{{ route('register') }}"
                  class="text-decoration-none text-primary fw-semibold">Sign Up</a></p>
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

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>

  <script>
    // Password visibility toggle
    document.getElementById('togglePassword').addEventListener('click', function () {
      const passwordInput = document.getElementById('password');
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.querySelector('i').classList.toggle('fa-eye');
      this.querySelector('i').classList.toggle('fa-eye-slash');
    });
  </script>

</body>

</html>