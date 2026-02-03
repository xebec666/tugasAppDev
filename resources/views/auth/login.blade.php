@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<style>
    :root {
        --primary-green: #27ae60;
        --primary-green-dark: #1e8449;
        --light-green: #d5f4e6;
    }

    body {
        background: linear-gradient(135deg, var(--light-green) 0%, #ffffff 100%);
        min-height: 100vh;
    }

    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 56px - 200px);
        padding: 20px 0;
    }

    .login-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 100%;
        max-width: 400px;
    }

    .login-card h2 {
        color: var(--primary-green);
        font-weight: 700;
        margin-bottom: 10px;
        text-align: center;
    }

    .login-card p {
        color: #666;
        text-align: center;
        margin-bottom: 30px;
        font-size: 14px;
    }

    .form-control {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 0.2rem rgba(39, 174, 96, 0.25);
    }

    .btn-login {
        background-color: var(--primary-green);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        font-size: 16px;
        width: 100%;
        transition: background-color 0.3s ease;
        margin-top: 20px;
    }

    .btn-login:hover {
        background-color: var(--primary-green-dark);
        color: white;
    }

    .divider {
        text-align: center;
        margin: 25px 0;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background-color: #e0e0e0;
    }

    .divider span {
        background: white;
        color: #999;
        padding: 0 10px;
        position: relative;
        font-size: 14px;
    }

    .btn-google {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        background-color: white;
        color: #333;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-google:hover {
        border-color: var(--primary-green);
        background-color: #f9f9f9;
        color: #333;
    }

    .form-check {
        margin-top: 15px;
    }

    .form-check-input:checked {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
    }

    .form-check-input:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 0.25rem rgba(39, 174, 96, 0.25);
    }

    .forgot-password {
        text-align: right;
        margin-top: 10px;
    }

    .forgot-password a {
        color: var(--primary-green);
        text-decoration: none;
        font-size: 14px;
    }

    .forgot-password a:hover {
        text-decoration: underline;
    }

    .signup-link {
        text-align: center;
        margin-top: 20px;
        color: #666;
        font-size: 14px;
    }

    .signup-link a {
        color: var(--primary-green);
        text-decoration: none;
        font-weight: 600;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="login-container">
    <div class="login-card">
        <h2><i class="fas fa-leaf"></i> Healthy Store</h2>
        <p>Masuk ke akun Anda</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Masukkan password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                    Ingat saya
                </label>
            </div>

            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Lupa password?</a>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <a href="{{route('google.login')}}" class="btn-google">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Login dengan Google
        </a>

        <p class="signup-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </div>
</div>
@endsection
