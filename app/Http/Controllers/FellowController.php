<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Shoplist;
use App\Product;
use Auth;

class FellowController extends Controller
{

    /*
     * Display all friends
     */
    public function index()
    {

        $pendingCount = null;
        $friendsCount = null;
        $friends = null;
        $shoplistsCount = null;
        $productsCount = null;

        if (Auth::check()) {

            $user = User::find(Auth::user()->id);
            $friends = $user->getFriends(12);
            $friendsCount = $user->getFriendsCount();
            $pendingCount = $user->getFriendRequests()->count();

            $data = array(
                'friends' => $friends,
                'friendsCount' => $friendsCount,
                'pendingTotal' => $pendingCount,
            );

            return view('profile.friends')->with($data);
        } else {
            return redirect('login');
        }
    }

    /*
     * Display profile's friends
     */
    public function userFriends(Request $request)
    {

        $friends = null;
        $totalFriends = null;
        $totalShoplists = null;
        $totalShoplists = null;

        $profile_id = $request->input('pid');

        $user = User::find($profile_id);
        $friends = $user->getFriends(12);
        $totalFriends = $user->getFriendsCount();

        $totalShoplists = Shoplist::where('user_id', $profile_id)->count();
        $totalProducts = Product::where('user_id', $profile_id)->count();

        $data = array(
            'friends' => $friends,
            'totalShoplists' => $totalShoplists,
            'totalProducts' => $totalProducts,
            'totalFriends' => $totalFriends
        );
        return view('user.friends')->with($data);
    }

    /*
     * Check Friendship Status API
     */
    public function checkFriendshipStatus($receiver)
    {

        // 0 - Not friends
        // 1 - Pending friends request to
        // 2 - Pending friends request from
        // 3 - Friends
        // 4 - Blocked

        $status = 0;

        $sender = User::find(Auth::user()->id);
        $recipient = User::find($receiver);

        // check if friend request sent
        if (!$sender->isFriendWith($recipient)) {
            $status = 0;
            if ($sender->hasSentFriendRequestTo($recipient)) {
                $status = 1;
            } else if ($sender->hasFriendRequestFrom($recipient)) {
                $status = 2;
            }
        } else {
            $status = 3;
            if ( $sender->hasBlocked($recipient) ){
                $status = 4;
            }
        }

        return response()->json(['status' => $status], 200);
    }

    /*
     * Send Friend Request API
     */
    public function sendRequest($receiver)
    {
        $sender = User::find(Auth::user()->id);
        $recipient = User::find($receiver);

        $sender->befriend($recipient);

        return response()->json(['resp', 1], 200);
    }

    /*
     * Get Pending Friend Requests
     */
    public function getPendingRequests()
    {


        if ( Auth::check() ) {
            $user = User::find(Auth::user()->id);

            $pendingRequests = $user->getFriendRequests($perPage = 20);

            return view('profile.pending')->with('requests', $pendingRequests);
        }else{
            return redirect('login');
        }
    }

    /*
     * Approve Friend Request API
     */
    public function approveFriendRequest($sender_id)
    {

            $user = User::find(Auth::user()->id);
            $sender = User::find($sender_id);

            $user->acceptFriendRequest($sender);

            return response()->json(['status' => 1], 200);

    }

    /*
     * Deny Friend Request API
     */
    public function denyFriendRequest($sender_id)
    {
            $user = User::find(Auth::id());
            $sender = User::find($sender_id);

            $user->denyFriendRequest($sender);

            return response()->json(['status' => 1], 200);

    }

    /*
     * Cancel Friend Request API
     */
    public function cancelFriendRequest($recipient_id)
    {

            $user = User::find(Auth::user()->id);
            $recipient = User::find($recipient_id);

            $user->unfriend($recipient);

            return response()->json(['status' => 1], 200);

    }

    /*
     * Unfriend User API
     */
    public function unfriendUser($recipient_id)
    {
        $user = User::find(Auth::user()->id);
        $recipient = User::find($recipient_id);

        $user->unfriend($recipient);

        return response()->json(['status' => 1], 200);

    }

    /*
     * Block User
     */
    public function blockUser($recipient_id)
    {
        $user = User::find(Auth::id());
        $recipient = User::find($recipient_id);

        $user->blockFriend($recipient);

        return response()->json(['status' => 1], 200);
    }

    /*
     * Unblock User API
     */
    public function unblockUser($recipient_id)
    {
        $user = User::find(Auth::id());
        $recipient = User::find($recipient_id);

        $user->unblockFriend($recipient);

        return response()->json(['status' => 1], 200);
    }
}
