<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class StaticPagesController extends Controller
{
    /*
     * Welcome Page route
     */
    public function welcome(){
        if(Auth::check()) {
            return redirect('/home');
        }
        return view('welcome');
    }
    /*
     * Policies Page route
     */
    public function policies(){
        return view('policies');
    }
}
