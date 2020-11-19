<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showdata(Request $request)
    {
        if($request->slsearch == "stour")
        {
            $tour = Tour::where('tour_ten', 'LIKE', '%'.$request->valuesearch.'%')->get();
            return view("tour.list", ['tour' => $tour]);
        }
        if($request->slsearch == "sgroup")
        {
            $tour = Tour::where('tour_ten', 'LIKE', '%'.$request->valuesearch.'%')->get();
            return view("tour.list", ['tour' => $tour]);
        }
        if($request->slsearch == "scus")
        {
            $tour = Tour::where('tour_ten', 'LIKE', '%'.$request->valuesearch.'%')->get();
            return view("tour.list", ['tour' => $tour]);
        }
    }
}
