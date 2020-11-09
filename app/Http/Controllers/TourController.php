<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\ModelNotFoundException;

use App\Models\Tour;
use App\Models\Loaitour;

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
        return view('tour.list', ['tour' => $tour]);
    }

    public function getAddTour()
    {
        $loai = Loaitour::all();
        if($loai->first()==null)
        {
            session()->put('notice','Don\'t have any Category of tour');
            return view('tour.add');
        }
        return view('tour.add', ['loai'=>$loai]);
    }

    public function postAddTour(Request $request)
    {
        try{
            $tour = new Tour;
            $tour->tour_ten = $request->nametour;
            $tour->tour_mota = $request->txtDescript;
            $tour->loai_id = $request->catetour;
            $tour->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new category. Because form incomplete')->withInput();
        }
        return redirect('tour/listtour');
    }

    public function getEditTour($id)
    {
        $loai = Loaitour::all();
        $tour = Tour::find($id);
        if($loai->first()==null)
        {
            session()->put('notice','Don\'t have any Category of tour');
            return view('tour.edit');
        }
        return view('tour.edit', ['tour'=>$tour, 'loai'=>$loai]);
    }
}
