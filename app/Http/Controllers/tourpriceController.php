<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tour;
use App\Models\tourprice;
use Illuminate\Database\QueryException;

class tourpriceController extends Controller
{
    public function gettourprice()
    {
        $tourprice = tourprice::all();
        if($tourprice->first()==null)
        {
            session()->put('notice','Haven\'t any row');
            return view('tourprice.list');
        }
        return view('tourprice.list', ['tourprice'=>$tourprice]);
    }

    public function getAddtourprice()
    {
        $tour=tour::all();
        return view('tourprice.add',['tour'=>$tour]);
    }

    public function postAddtourprice(Request $request)
    {
        try{
            $tourprice = new tourprice;
            $tourprice->gia_sotien = $request->price;
            $tourprice->tour_id = $request->tour;
            $tourprice->gia_tungay = $request->start;
            $tourprice->gia_denngay = $request->end;
            $tourprice->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new tour price. Because form incomplete')->withInput();
        }
        return redirect('tourprice/listprc');
    }

    public function getEdittourprice($id)
    {
        $tourprice = tourprice::find($id);
        $tour = tour::all();
        return view('tourprice.edit',['tourprice' => $tourprice,'tour'=>$tour]);
    }

    public function postEdittourprice(Request $request, $id)
    {
        try{
            $tourprice = tourprice::find($id);
            $tourprice->gia_sotien = $request->price;
            $tourprice->tour_id = $request->tour;
            $tourprice->gia_tungay = $request->start;
            $tourprice->gia_denngay = $request->end;
            $tourprice->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new tourprice. Because form incomplete');
        }
        return redirect('tourprice/listprc');
    }

    public function deletetourprice($id)
    {
        $tourprice = tourprice::find($id);
        $tourprice->delete();
        return redirect('tourprice/listprc');
    }
}
