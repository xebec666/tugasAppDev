@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-100 to-white flex items-center justify-center p-5">
    <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md">

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-green-600">
                <i class="fas fa-lock"></i> Reset Password
            </h2>
            <p class="text-gray-500 text-sm mt-2">
                Masukkan password baru untuk akun Anda
            </p>
        </div>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>

                <input
                    type="email"
                    class="w-full border-2 border-gray-200 rounded-lg px-4 py-2 bg-gray-100"
                    value="{{ $email }}"
                    disabled
                >
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password Baru
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full border-2 border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:border-green-500 @error('password') border-red-500 @enderror"
                    required
                >

                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full border-2 border-gray-200 rounded-lg px-4 py-2"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg transition">
                <i class="fas fa-save"></i> Reset Password
            </button>

        </form>

        <div class="text-center mt-5">
            <a href="{{ route('login') }}" class="text-green-600 text-sm hover:underline">
                Kembali ke Login
            </a>
        </div>

    </div>
</div>
@endsection
