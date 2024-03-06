<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Auth
{
    // Mengarahkan pengguna ke Google
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    // Menangani callback dari Google
    public function handleProviderGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $findIdUser = User::where('email', $user->email)->first();

        if ($findIdUser) {
            Auth::login($findIdUser);
            return redirect('/');
        } else {
            abort(403);
        }
    }
}
