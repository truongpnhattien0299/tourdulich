<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    public function getTour()
    {
        $tour = Tour::all();
        if($tour->first()==null)
        {
            session()->put('notice','Haven\'t any row');
            return view('tour.list');
        }
        dd($tour);
        // return view('tour.list', ['tour' => $tour]);
    }
}
