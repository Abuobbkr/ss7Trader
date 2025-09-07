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

  <style>
    /* ===== Background ===== */
    body {
      min-height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      background: radial-gradient(1100px 600px at 55% 25%, #273f46 0%, rgba(39, 63, 70, 0.0) 60%),
        linear-gradient(180deg, #0e2a31 0%, #102a33 45%, #0c2530 100%);
      color: #dbe7ec;
      font-family: 'Open Sans', system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
      padding: 20px;
    }

    /* ===== Glass Card ===== */
    .glass-panel {
      position: relative;
      background: rgba(255, 255, 255, 0.06) !important;
      border: 1px solid rgba(255, 255, 255, 0.12) !important;
      border-radius: 20px !important;
      box-shadow:
        0 14px 50px rgba(0, 0, 0, 0.45),
        0 0 0 1px rgba(255, 255, 255, 0.02) inset;
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      max-width: 460px;
      margin: 0 auto;
      padding: 2rem 2.5rem;
    }

    .glass-panel::after {
      content: "";
      position: absolute;
      inset: -14px;
      border-radius: 28px;
      pointer-events: none;
      box-shadow: 0 0 60px rgba(0, 0, 0, 0.35),
        0 0 60px rgba(19, 208, 255, 0.05);
    }

    /* ===== Title ===== */
    .card-title {
      font-family: 'Poppins', sans-serif;
      font-weight: 700;
      font-size: 28px;
      color: #ff1166 !important;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    /* ===== Labels ===== */
    .form-label {
      color: #b9c9cf !important;
      font-weight: 600;
      margin-bottom: .35rem;
    }

    /* ===== Inputs ===== */
    .form-control {
      background: #dfe8f4 !important;
      color: #1f2a33 !important;
      border: none !important;
      border-radius: 8px !important;
      height: 44px;
      padding: .6rem .9rem;
    }

    .form-control:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(255, 17, 102, 0.25) !important;
    }

    .form-control::placeholder {
      color: #6b7a86;
    }

    .input-group-text,
    #togglePassword {
      background: transparent !important;
      border: none !important;
      color: #a8b8bf !important;
    }

    /* ===== Forgot Password ===== */
    .forgot-wrapper {
      display: flex;
      justify-content: flex-end;
      margin-top: .35rem;
      margin-bottom: 1.25rem;
    }

    .forgot-wrapper a {
      color: #ff1166 !important;
      font-weight: 600;
      text-decoration: none;
      font-size: 0.9rem;
    }

    .forgot-wrapper a:hover {
      text-decoration: underline;
    }

    /* ===== Button ===== */
    .btn-primary {
      background: linear-gradient(90deg, #ff2f6d 0%, #ff2f9a 100%) !important;
      border: none !important;
      color: #fff !important;
      font-weight: 700 !important;
      border-radius: 8px !important;
      height: 44px;
      box-shadow: 0 10px 22px rgba(255, 47, 122, 0.35) !important;
      transition: transform .12s ease, box-shadow .12s ease;
    }

    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 12px 26px rgba(255, 47, 122, 0.45) !important;
    }

    /* ===== Hide extras ===== */
    .form-check,
    .text-center.mt-4 {
      display: none !important;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="glass-panel">
          <h2 class="card-title">SS7Trader Academy</h2>

          @if (session('status'))
            <div class="alert alert-success mb-4 text-center">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">{{ __('Email address') }}</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autofocus placeholder="Enter your email" />
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">{{ __('Password') }}</label>
              <div class="input-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" required placeholder="Enter your password" />
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="fas fa-eye-slash"></i>
                </button>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              @if (Route::has('password.request'))
                <div class="forgot-wrapper">
                  <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                </div>
              @endif
            </div>

            <!-- Submit -->
            <div class="d-grid gap-2 mb-3">
              <button type="submit" class="btn btn-primary">
                {{ __('Login') }}
              </button>
            </div>
          </form>

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