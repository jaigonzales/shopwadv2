<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 *********************************
 * Current User Access Shoplists Data
 * Routes
 * @version 1.0
 ********************************
 */
// Get user's shoplists
Route::get('/v1/{user_id}/shoplists', [
    'uses' => 'ShoplistController@getShoplists'
]);

// Create a shoplist
Route::post('/v1/shoplist', [
    'uses' => 'ShoplistController@postShoplist'
]);

// Update a shoplist
Route::put('/v1/shoplist/{id}', [
    'uses' => 'ShoplistController@updateShoplist'
]);

// Delete a shoplist
Route::delete('/v1/shoplist/{id}', [
    'uses' =>'ShoplistController@deleteShopList'
]);

// Get single shoplist
Route::get('/v1/shoplist/{shoplistId}', [
    'uses' => 'SingleShoplistController@getSingleShoplist',
    // 'middleware' => 'singleShoplist'
]);

// Get total products of each shoplists
Route::get('/v1/{user_id}/{shoplist_id}/products/count', [
    'uses' => 'ProductController@countProducts',
]);

// Get total products of a user
Route::get('/v1/{user_id}/products/count', [
    'uses' => 'ProductController@getTotalProducts',
]);


/**
 *********************************
 * Current User Access Products Data
 * Routes
 * @version 1.0
 ********************************
 */

// Get user each shoplist's products
Route::get('/v1/{user_id}/shoplist/{id}/products', [
    'uses' => 'ProductController@getProducts'
]);

// Create a product
Route::post('/v1/product', [
    'uses' => 'ProductController@postProduct'
]);

// Update a product
Route::put('/v1/product/{id}', [
    'uses' => 'ProductController@updateProduct'
]);

// Delete a product
Route::delete('/v1/product/{id}', [
    'uses' => 'ProductController@deleteProduct'
]);

// Count shoplist products
Route::get('/v1/{user_id}/{shoplist_id}/products/count', [
    'uses' => 'ProductController@countProducts',
]);

/**
 *********************************
 * Friendships
 * Routes
 * @version 1.0
 ********************************
 */
// Check user friendship status
Route::get('/v1/friendship/check/{receiver}', [
    'uses' => 'FellowController@checkFriendshipStatus'
]);

// Send friend request
Route::get('/v1/friendship/add/{receiver}', [
   'uses' => 'FellowController@sendRequest'
]);
// Cancel Friend Request
Route::get('/v1/friendship/cancel-friend-request/{recipient_id}', [
   'uses' => 'FellowController@cancelFriendRequest'
]);
// Get friend request total
Route::get('/v1/friendship/friend-requests', [
   'uses' => 'FellowController@getFriendRequestsTotal'
]);

// Accept friend request
Route::get('/v1/friendship/approve/{sender_id}', [
   'uses' => 'FellowController@approveFriendRequest'
]);

// Deny friend request
Route::get('/v1/friendship/deny/{sender_id}', [
   'uses' => 'FellowController@denyFriendRequest'
]);

// Unfriend user
Route::get('/v1/friendship/unfriend/{recipient_id}', [
    'uses' => 'FellowController@unfriendUser'
]);

// Block user
Route::get('/v1/friendship/block/{recipient_id}', [
    'uses' => 'FellowController@blockUser'
]);

// Unblock user
Route::get('/v1/friendship/unblock/{recipient_id}', [
   'uses' => 'FellowController@unblockUser'
]);

/**
 *********************************
 * Account Settings Update
 * Routes
 * @version 1.0
 ********************************
 */
// Update user details
Route::get('/v1/user/{user_id}', [
    'uses' => 'UserController@userDetails'
]);

Route::put('/v1/edit/user/fname', [
    'uses' => 'SettingsController@updateFname'
]);

Route::put('/v1/edit/user/lname', [
    'uses' => 'SettingsController@updateLname'
]);

Route::put('/v1/edit/user/bday', [
    'uses' => 'SettingsController@updateBday'
]);

Route::put('/v1/edit/user/email', [
    'uses' => 'SettingsController@updateEmail'
]);

Route::put('/v1/edit/user/pword', [
    'uses' => 'SettingsController@updatePassword'
]);

Route::post('/v1/user/confirmdelete', [
    'uses' => 'SettingsController@confirmDeletion'
]);
