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
        $tour = tour::all();
        if($tourprice->first()==null)
        {
            session()->put('notice','Haven\'t any row');
            return view('tourprice.list');
        }
        return view('tourprice.list', ['tourprice'=>$tourprice,'tour'=>$tour]);
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
    public function searchTourPrice($id)
    {
        $tourprice = tourprice::where('tour_id', $id)->distinct()->get();
        $text="";
        if(count($tourprice)==0){
            $text="<tr><td colspan='5' align=center>Empty</td></tr>";
        }else{
            foreach($tourprice as $item)
            {
                $text.='<tr>'.
                    '<td>'.$item->gia_id.'</td>'.
                    '<td>'.$item->gia_sotien.'</td>'.
                    '<td>'.$item->gia_tungay.'</td>'.
                    '<td>'.$item->gia_denngay.'</td>'.
                    '<td>'.
                        '<div class="btn-group">'.
                        '<button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" style="padding: 10%">Select</button>'.
                        '<div class="dropdown-menu" style="min-width: 10px">'.
                            '<a href="editprc&id='.$item->gia_id.'" id="'.$item->gia_id.'" class="dropdown-item">Edit</a>'.
                            '<a onclick="del('.$item->gia_id.')" id="del"  class="dropdown-item" style="cursor: pointer">Delete</a>'.
                        '</div>'.
                        '</div>'.
                    '</td>'.
                ' </tr>';
            }
        }
        return $text;
    }
    public function priceTourPrice($id)
    {
        $tour = tour::find($id);
        return view('tourprice.addprice',['tour' => $tour]);
    }
}
