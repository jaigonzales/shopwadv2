<?php

namespace App\Http\Controllers;

use App\Shoplist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class ShoplistController extends Controller
{

    public function index( Request $request ){

        $shoplist = Shoplist::find($request->input('swid'));
        return view('profile.shoplist')->with('shoplist', $shoplist);
    }

    public function postShoplist(Request $request)
    {

        $shoplist = new Shoplist();
        $shoplist->user_id = $request->input('userid');
        $shoplist->title = $request->input('title');
        $shoplist->desc = $request->input('desc');
        $shoplist->privacy = $request->input('privacy');
        $shoplist->save();

        return response()->json(['message' => 'List created successfully'], 201);

    }

    public function getShoplists($user_id)
    {

        $shoplists = Shoplist::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        if (!$shoplists) {
            return response()->json(['message' => 'No shoplists found'], 404);
        }

        return response()->json($shoplists, 200);

    }

    public function updateShoplist(Request $request, $list_id)
    {

        $shoplist = Shoplist::find($list_id);

        if (!$shoplist) {
            return response()->json(['message' => 'Unable to update list'], 405);
        }

        $shoplist->title = $request->input('title');
        $shoplist->desc = $request->input('desc');
        $shoplist->privacy = $request->input('privacy');

        $shoplist->save();

        return response()->json($shoplist, 202);

    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function deleteShopList($id)
    {

        $shoplist = Shoplist::find($id);
        $shoplist->delete();
        return response()->json(['message' => 'List deleted successfully'], 203);
    }


}
