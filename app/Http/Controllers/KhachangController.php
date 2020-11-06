<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KhachangController extends Controller
{
    public function hello()
    {
        return view('index');
    }
}
