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
        return view('welcome');
    }
    /*
     * Policies Page route
     */
    public function policies(){
        return view('policies');
    }
}
