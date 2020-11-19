<?php

namespace App\Http\Controllers;

use App\Models\group;
use App\Models\Khachang;
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
            $group = group::where('doan_name', 'LIKE', '%'.$request->valuesearch.'%')->get();
            return view("group.list", ['group' => $group]);
        }
        if($request->slsearch == "scus")
        {
            $khachang = Khachang::where('kh_ten', 'LIKE', '%'.$request->valuesearch.'%')->get();
            return view("khachang.list", ['khachang' => $khachang]);
        }
    }
}
