<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    // 404: Not Found
    public function errorNotFound() {
        return view('404');
    }
}
