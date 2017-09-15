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

Route::group(['middleware' => ['isVerified', 'auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

/*
 * Static Pages Routes
 */
Route::get('/', 'StaticPagesController@welcome')->name('welcome');
Route::get('/policies', 'StaticPagesController@policies')->name('policies');

/*
 * User Profile Routes
 */
Route::get('/fellows', 'FellowController@index')->name('fellows')->middleware('auth');
Route::get('/fellow-requests', 'FellowController@getPendingRequests')->name('fellow-requests')->middleware('auth');
Route::get('/account-settings', 'SettingsController@index')->name('account-settings')->middleware('auth');
Route::get('/blocklist', 'SettingsController@getBlocklist')->name('blocklist')->middleware('auth');

/*
 * Logged in user Shoplists, products
 */
Route::get('/u_shoplist', 'ShoplistController@index', 'swid')->name('u_shoplist');

/*
 * Public User Profile Route
 */
Route::get('/profile', 'UserController@getUserProfile', 'pid')->name('profile');
Route::get('/p_friends', 'FellowController@userFriends', 'pid')->name('p_friends');
Route::get('/p_shoplist', 'UserController@getProfileShoplistProducts', ['pid', 'swid'])->name('p_shoplist');

/*
 * Public User Shoplist products
 */
Route::get('/shoplist', 'ProductController@getProductsOfCurrentShoplist', array('pid', 'swid'))->name('user-shoplist');

/*
 * Update Avatar Route
 */
Route::get('/avatar', 'SettingsController@avatar')->name('avatar');
Route::any('/update-avatar', 'SettingsController@updateAvatar')->name('update-avatar');

/*
 * Search Users Route
 */
Route::get('/search', 'SearchController@index')->name('search')->middleware('auth');

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