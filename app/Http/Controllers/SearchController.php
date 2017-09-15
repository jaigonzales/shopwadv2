<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use Auth;

class SearchController extends Controller
{
    /*
     * Search Users
     */
    public function index( Request $request ) {
        // Don't query self
        if (Auth::check()) {
            $except = Auth::id();

            $keyword = $request->input('q');

            $results = User::whereRaw("(CONCAT(firstname, ' ', lastname) LIKE '%" . $keyword . "%' OR email LIKE '%" . $keyword . "%')")
                ->where('id', '<>', $except)
                ->paginate(12);

            return view('search')->with('results', $results);
        }else{
            return redirect('login');
        }

    }
}
