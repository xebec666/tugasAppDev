@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-100 to-white flex items-center justify-center p-5">
    <div class="bg-white rounded-xl shadow-xl p-8 w-full max-w-md">

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-green-600">
                <i class="fas fa-leaf"></i> Healthy Store
            </h2>
            <p class="text-gray-500 text-sm mt-2">
                Masukkan email Anda untuk reset password
            </p>
        </div>

        @if(session('status'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg text-center mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.check') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="w-full border-2 border-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:border-green-500 @error('email') border-red-500 @enderror"
                    placeholder="nama@email.com"
                    required
                >

                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg transition">
                <i class="fas fa-check"></i> Verifikasi Email
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
