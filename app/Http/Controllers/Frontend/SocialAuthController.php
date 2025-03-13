<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt(uniqid()),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'photo' => $socialUser->getAvatar(),
                ]);
            }

            Auth::login($user, true);

            return redirect('/');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Unable to login using ' . ucfirst($provider) . '.']);
        }
    }
}
