<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $socialiteUser = Socialite::driver('google')->user();
            $email = $socialiteUser->email;
            $avatar = $socialiteUser->getAvatar();

            $user = User::firstOrCreate(['email' => $email], [
                'name' => $socialiteUser->name,
                'profile_photo_path' => $avatar
            ]);

            if($user->wasRecentlyCreated) {
                event(new UserRegistered($user));
            }

            Auth::login($user);

            return redirect()->intended('dashboard');
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

}
