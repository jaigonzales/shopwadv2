<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => ['isVerified']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

/*
 * Static Pages Routes
 */
Route::get('/', 'StaticPagesController@welcome')->name('welcome');
Route::get('/policies', 'StaticPagesController@policies')->name('policies');

/*
 * Registration User Verification
 */
Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');

/*
 * Laravel Socialite OAuth Redirect/Callbacks
 */
// social redirect and callback routes
Route::get('auth/facebook', 'Auth\oAuthFacebookController@redirect');
Route::get('auth/facebook/callback', 'Auth\oAuthFacebookController@callback');