<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use App\User;

class oAuthFacebookController extends Controller
{
    protected $redirectTo = '/home';

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {

        try {
            $user = Socialite::driver('facebook')->fields([
                'first_name', 'last_name', 'email', 'picture{url}', 'gender'
            ])->user();

        } catch (Exception $e) {
            return redirect('auth/facebook');
        }

        $authUser = $this->createOrGetUser($user);
        UserVerification::generate($user);
        UserVerification::send($user, 'Shop Wad - Verify your email');
        Auth::login($authUser, true);

        return redirect($this->redirectTo);

    }

    public function createOrGetUser($facebookUser)
    {
        $authUser = User::where('provider_user_id', $facebookUser->id)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'firstname' => $facebookUser->user['first_name'],
            'lastname' => $facebookUser->user['last_name'],
            'email' => $facebookUser->email,
            'avatar' => $facebookUser->avatar_original,
            'gender' => $facebookUser->user['gender'],
            'provider_user_id' => $facebookUser->id,
            'provider' => 'facebook'
        ]);
    }
}