<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

        $user = User::updateOrCreate([
            'provider' => $driver,
            'provider_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'provider_token' => $githubUser->token,
            'provider_refresh_token' => $githubUser->refreshToken,
        ]);

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

}
