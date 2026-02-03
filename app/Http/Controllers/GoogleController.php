<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'username' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt('google123'),
            ]);
        }

        Auth::login($user);

        return redirect('/user/dashboard')->with('success', 'Login dengan Google berhasil!');
    }
}
