<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Shoplist;

class SingleShoplistController extends Controller
{

    public function getSingleShoplist( $shoplistId ){

        $shoplist = Shoplist::where('id', $shoplistId)
                            ->select('title')
                            ->first();

        return response()->json(['shoplist' => $shoplist], 200);
    }

    
}
