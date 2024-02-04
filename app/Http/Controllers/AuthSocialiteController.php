<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthSocialiteController extends Controller
{
    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook()
    {
        $user_facebook = Socialite::driver('facebook')->stateless()->user();

        dd($user_facebook);

        $user = User::findOrCreate([
            'facebook_id' => $user_facebook->getId(),
        ], [
            'name' => $user_facebook->getName(),
            'email' => $user_facebook->getEmail(),
        ]);

        Auth::login($user);

        return redirect()->to('/');
    }

    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $user_google = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate([
            'google_id' => $user_google->id,
        ], [
            'name' => $user_google->name,
            'email' => $user_google->email,
        ]);

        Auth::login($user);

        return redirect()->to('/');
    }
}
