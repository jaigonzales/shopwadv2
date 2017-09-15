<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Route;

use App\Product;
use App\Shoplist;
use App\User;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Current User Friends
         */
        View::composer('*', function($view){

            $u_friends = array();
            // is logged in
            if ( Auth::check() ) {
                $user = User::find(Auth::id());
                $u_friends = $user->getFriends(16);
            }
            $view->with('u_friends', $u_friends);
        });

        /*
         * Get User Shoplist Total
         */
        View::composer('*', function($view){
            $total = 0;

            if ( Auth::check() ) {
                $total = Shoplist::where('user_id', Auth::user()->id)->count();
            }
            $view->with('shoplistsTotal', $total);
        });

        /*
         * Get User Product Total
         */
        View::composer('*', function($view){
            $total = 0;

            if ( Auth::check() ) {
                $total = Product::where('user_id', Auth::user()->id)->count();
            }
            $view->with('productsTotal', $total);
        });

        /*
         * Get Friend Requests Total
         */

        View::composer('*', function($view){
            $total = 0;
            if ( Auth::check() ) {
                $user = User::find(Auth::user()->id);
                $total = count($user->getFriendRequests());
            }
            $view->with('totalFriendRequests', $total);
        });

        /*
         * Get Profile's info
         */
        View::composer('*', function($view){
            $g_user = User::find(\Request::input('pid'));

            $view->with('g_user', $g_user);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
