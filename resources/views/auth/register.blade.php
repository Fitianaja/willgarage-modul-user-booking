<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - WillGarage</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body {
            background-color: #0B192C;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-card {
            width: 100%;
            max-width: 420px;
            border: 2px solid #FF6500;
            border-radius: 16px;
            padding: 32px 28px;
            background-color: #0B192C;
        }
        .logo {
            text-align: center;
            font-size: 42px;
            font-weight: 900;
            color: #FF6500;
            letter-spacing: -3px;
            margin-bottom: 20px;
            text-shadow: 1.5px 1.5px 0 #fff;
        }
        .tab-switch {
            display: flex;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 22px;
        }
        .tab-switch a {
            flex: 1;
            text-align: center;
            padding: 9px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            color: #FF6500;
        }
        .tab-switch a.active {
            background-color: #FF6500;
            color: #fff;
        }
        .form-group { margin-bottom: 13px; }
        .form-label { display: block; color: #FF6500; font-size: 13px; font-weight: 700; margin-bottom: 5px; }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: none;
            font-size: 14px;
            outline: none;
        }
        .btn-submit {
            display: block;
            width: 60%;
            margin: 20px auto 0;
            background-color: #FF6500;
            color: #fff;
            border: none;
            padding: 11px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
        }
        .btn-submit:hover { background-color: #e05900; }
        .error-box { background: #FEE2E2; color: #991B1B; padding: 10px; border-radius: 8px; font-size: 13px; margin-bottom: 14px; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="logo">WG</div>

        <div class="tab-switch">
            <a href="{{ route('login') }}">Sign In</a>
            <a href="{{ route('register') }}" class="active">Sign Up</a>
        </div>

        @if ($errors->any())
            <div class="error-box">
                <ul style="margin-left: 16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Nomor HP</label>
                <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn-submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
