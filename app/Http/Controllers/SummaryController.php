<?php

namespace App\Http\Controllers;

use App\Models\Chiphi;
use App\Models\group;
use App\Models\Tour;
use App\Models\tourprice;
use App\Models\listgroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SummaryController extends Controller
{
    public function tour()
    {
        $group = group::all();
        $tour = Tour::all();
        $gia = tourprice::all();
        $detail = Chiphi::all();
        $ngdi = listgroup::all();
        return view("summany.revenuetour", ['group' => $group,
                                            'tour' => $tour,
                                            'gia' => $gia,
                                            'detail' => $detail,
                                            'ngdi' => $ngdi]);
    }

    public function detailtour($id)
    {
        $group = group::where('tour_id', $id)->get();
        $gia = tourprice::where('tour_id', $id)->get();
        $ngdi = listgroup::all();
        return view("summany.revenuedetailtour",['group'=> $group,
                                                 'gia' => $gia,
                                                'ngdi' => $ngdi]);
    }
}
