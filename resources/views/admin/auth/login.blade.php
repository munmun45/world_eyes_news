<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - World Eyes News</title>

    <link rel="icon" href="{{ asset('images/TN-36.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0b1120 0%, #0f172a 50%, #1e1b4b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .login-header {
            background: #0f172a;
            color: #ffffff;
            padding: 30px 24px;
            text-align: center;
            border-bottom: 3px solid #dc2626;
        }

        .demo-badge-btn {
            background: #f1f5f9;
            border: 1px dashed #cbd5e1;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .demo-badge-btn:hover {
            background: #e2e8f0;
            border-color: #94a3b8;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <h3 class="fw-bold mb-1">
                <span>WORLD</span> <span class="text-danger">EYES</span> <span>NEWS</span>
            </h3>
            <p class="small text-secondary mb-0">Editorial Staff & CMS Administration</p>
        </div>

        <div class="p-4 p-sm-5">
            @if(session('error'))
                <div class="alert alert-danger py-2 small mb-3">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success py-2 small mb-3">
                    <i class="fa-solid fa-circle-check me-1"></i> {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger py-2 small mb-3">
                    @foreach($errors->all() as $err)
                        <div>{{ $err }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold text-dark">Staff Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="fa-regular fa-envelope"></i></span>
                        <input type="email" name="email" id="emailInput" class="form-control" placeholder="admin@worldeyesnews.com" value="{{ old('email', 'admin@worldeyesnews.com') }}" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label small fw-bold text-dark mb-0">Password</label>
                    </div>
                    <div class="input-group mt-1">
                        <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-key"></i></span>
                        <input type="password" name="password" id="passwordInput" class="form-control" placeholder="••••••••" value="admin123" required>
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="rememberMe" checked>
                    <label class="form-check-label small text-muted" for="rememberMe">Remember my login session</label>
                </div>

                <button type="submit" class="btn btn-danger w-100 py-2 fw-bold text-uppercase" style="letter-spacing: 0.05em;">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Access Dashboard
                </button>
            </form>

            <div class="mt-4 pt-3 border-top">
                <div class="small text-muted fw-semibold mb-2 text-center">Quick Demo Login Credentials:</div>
                <div class="d-flex flex-column gap-2">
                    <div class="demo-badge-btn" onclick="fillCreds('admin@worldeyesnews.com', 'admin123')">
                        <div class="fw-bold text-dark">Chief Editor (Admin)</div>
                        <div class="text-muted"><code>admin@worldeyesnews.com</code> / <code>admin123</code></div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="small text-muted text-decoration-none">
                    <i class="fa-solid fa-arrow-left me-1"></i> Return to Public News Portal
                </a>
            </div>
        </div>
    </div>

    <script>
        function fillCreds(email, pass) {
            document.getElementById('emailInput').value = email;
            document.getElementById('passwordInput').value = pass;
        }
    </script>
</body>
</html>
