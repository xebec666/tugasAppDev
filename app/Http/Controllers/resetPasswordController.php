<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    // Menampilkan halaman forgot password
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Mengecek apakah email ada di database
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Jika email ada, langsung ke halaman reset
        return redirect()->route('password.reset')->with('email', $request->email);
    }

    // Menampilkan halaman reset password
    public function showResetForm()
    {
        if (!session('email')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password', [
            'email' => session('email')
        ]);
    }

    // Proses update password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::where('email', $request->email)->first();

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Password berhasil direset!');
    }
}
