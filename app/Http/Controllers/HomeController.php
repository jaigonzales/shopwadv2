<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'isVerified']);

        User::where('id', Auth::id())
            ->where('provider', 'facebook')
            ->where('verified', 0)
            ->update([
                'verified' => 1,
                'verification_token' => null
            ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( )
    {
        $user = User::find(Auth::id());

        $friends = $user->getFriends();
        return view('profile.home')->with('friends', $friends);
    }
}
