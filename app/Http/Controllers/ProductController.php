<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use App\Product;
use App\Shoplist;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(){

    }
    public function index( $shoplist_id ) {
        getProducts( $shoplist_id );
    }

    public function postProduct( Request $request ){
        $product = new Product();
        $product->user_id = $request->input('user_id');
        $product->shoplist_id = $request->input('shoplist_id');
        $product->product_name = $request->input('product_name');
        $product->product_url = $request->input('product_url');
        $product->size = $request->input('size');
        $product->color = $request->input('color');
        $product->quantity = $request->input('quantity');
        $product->save();

        $result = [ 'product' => $product ];

        return response()->json($result, 201);
    }

    public function getProducts( $userid, $shoplist ){

        $products = Product::where('user_id', $userid)
                            ->where('shoplist_id', $shoplist)
                            ->orderBy('created_at', 'desc')
                            ->paginate(5);

        if ( !$products ) {
            return response()->json(['message' => 'Products not found'], 404);
        }

        return response()->json($products, 200);
    }

    public function countProducts( $user_id, $shoplist_id ){
        $count = Product::where('user_id', $user_id)
                        ->where('shoplist_id', $shoplist_id)
                        ->count();

        if($count <= 0) {
            $count = 0;
        }

        return response()->json(['count' => $count], 201);
    }

    public function getTotalProducts( $user_id ){
        $totalProducts = Product::where('user_id', $user_id)
                                ->count();

        if ($totalProducts <= 0){
            $totalProducts = 0;
        }

        return response()->json(['totalProducts' => $totalProducts], 201);
    }

    public function updateProduct( Request $request, $id ){

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Invalid product'], 405);
        }

        $product->product_name = $request->input('productName');
        $product->product_url = $request->input('productUrl');
        $product->size = $request->input('productSize');
        $product->color = $request->input('productColor');
        $product->quantity = $request->input('productQuantity');

        $product->save();

        return response()->json(['messsage' => 'Product updated'], 202);

    }

    public function deleteProduct( $product ){

        $product = Product::find( $product );

        $product->delete();

    }

    /*
     * Get Current Shoplist Products of a profile WEB
     */
    public function getProductsOfCurrentShoplist( Request $request ) {

        $user = $request->input('pid');
        $shoplist_id = $request->input('swid');

        $products = Product::where('user_id', $user)
                            ->where('shoplist_id', $shoplist_id)
                            ->get();

        return view('user.shoplist')->with('products', $products);
    }

}
