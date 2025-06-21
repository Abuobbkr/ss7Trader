<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Animated Login Page - Bootstrap 5</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('frontend/css/login.css') }}" rel="stylesheet">

</head>

<body>
  <div class="login-container">
    <div class="login-box">
      <div class="login-title">Welcome Back</div>
      <form method="POST" action="{{ route('subscriber.login.post') }}">
        @csrf <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
        </div>
        <div class="mb-2">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        </div>

        <!-- Forgot Password Link -->
        <div class="mb-4 text-end">
          <a href="#" class="text-decoration-none frget-pass small">Forgot Password?</a>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-login">Login</button>
        </div>
      </form>
    </div>
  </div>

  <script src="{{ asset('frontend/bootstrap/bootstrap.js') }}" defer></script>

</body>

</html>