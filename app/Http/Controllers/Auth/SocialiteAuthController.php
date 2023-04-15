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
        $providerUser = Socialite::driver($driver)->user();

        /** @var User */
        $user = User::where('provider', $driver)->where('provider_id', $providerUser->id)->first();

        /** @var User */
        $user = $user ?? User::where('email', $providerUser->email)->first();

        if ($user) {
            $user->provider = $driver;
            $user->provider_id = $providerUser->id;
            $user->provider_token = $providerUser->token;
            $user->provider_refresh_token = $providerUser->refreshToken;
            $user->save();
        }

        /** @var User */
        $user = $user ?? User::create([
            'name' => $providerUser->name ?? $providerUser->nickname,
            'email' => $providerUser->email,
            'password' => Hash::make(Str::random(32)),
            'provider' => $driver,
            'provider_id' => $providerUser->id,
            'provider_token' => $providerUser->token,
            'provider_refresh_token' => $providerUser->refreshToken,
        ]);

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

}
