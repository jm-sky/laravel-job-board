<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;

class SocialiteAuthController extends Controller
{
    /**
     * @param string $driver
     */
    public function redirect($driver = 'github')
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * @param string $driver
     */
    public function callback($driver = 'github')
    {
        $githubUser = Socialite::driver($driver)->user();

        $user = User::where('provider', $driver)->where('provider_id', $githubUser->id)->first();
        $user = $user ?? User::where('email', $githubUser->email)->first();

        $user = $user ?? User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'password' => Hash::make(Str::random(32)),
            'provider' => $driver,
            'provider_id' => $githubUser->id,
            'provider_token' => $githubUser->token,
            'provider_refresh_token' => $githubUser->refreshToken,
        ]);

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

}
