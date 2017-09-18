<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Shoplist;
use App\Product;
use Hash;
use Auth;

class UserController extends Controller
{
    /*
     * Public user profile
     */
    public function getUserProfile( Request $request ){

        $pid = $request->input('pid');

        $data = null;
        $user = null;
        $shoplists = null;
        $shoplistTotal = null;
        $productTotal = null;
        $shoplistTotalProduct = null;

        if ( !$pid ){
            return view('404');
        }else{
            $recipient = User::find($pid);
            if ( Auth::check() ) {

                $user = User::find(Auth::id());

                if ($recipient) {
                    if ($user->hasBlocked($recipient) || $user->isBlockedBy($recipient)) {
                        return view('404');
                    }
                }
            }

            if ( !$recipient ){
                return view('404');
            }
            try {
                $shoplist = Shoplist::where('user_id', $pid);
                $product = Product::where('user_id', $pid);

                $shoplistTotal = $shoplist->count();
                $productTotal = $product->count();


                if ( Auth::check() ) {
                    if ( $user->isFriendWith($recipient) ) {
                        $theshoplists = $shoplist->where('privacy', '<>', 2);
                    } else {
                        $theshoplists = $shoplist->where('privacy', 0);
                    }
                }else{
                    $theshoplists = $shoplist->where('privacy', 0);
                }

                $shoplists = $theshoplists->orderBy('created_at', 'DESC')->paginate(5);


                $user = User::find(\Request::query('pid'));
                $getAllFriends = $user->getFriends();

                $getFriendsTotal = $user->getFriendsCount();


            } catch (\Exception $e) { }

            $data = array(
                'user' => $user,
                'p_shoplists' => $shoplists,
                'p_shoplistTotal' => $shoplistTotal,
                'p_productTotal' => $productTotal,
                'p_friends' => $getAllFriends,
                'p_friendsTotal' => $getFriendsTotal,
            );

            return view('user.profile')->with($data);
        }
    }

    public function getProfileShoplistProducts( Request $request ) {

        $data = null;
        $user = null;
        $shoplist = null;
        $shoplistTotal = null;
        $productTotal = null;


        try {
            $user = User::find($request->input('pid'));

            $shoplists = Shoplist::where('user_id', $request->input('pid'));

            $shoplistTotal = $shoplists->count();

            $shoplist = $shoplists->where('id', $request->input('swid'))->first();

            $product = Product::where('user_id', $request->input('pid'))
                ->where('shoplist_id', $request->input('swid'));

            $productTotal = $product->count();

            $products = $product->paginate(5);

            $getAllFriends = $user->getFriends();

            $getFriendsCount = $user->getFriendsCount();

        }catch(\Exception $e) { }

        $data = array(
            'user' => $user,
            'shoplist' => $shoplist,
            'products' => $products,
            'p_shoplistTotal' => $shoplistTotal,
            'p_productTotal' => $productTotal,
            'p_friends' => $getAllFriends,
            'p_friendsTotal' => $getFriendsCount,
        );
        return view('user.shoplist')->with($data);
    }

    public function userDetails( $user_id ){

        $user = User::find($user_id);

        return response()->json(['user' => $user], 200);
    }
}
