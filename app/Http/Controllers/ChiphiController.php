<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loaichiphi;
use App\Models\Chiphi;

class ChiphiController extends Controller
{
    public function getAddCp($id)
    {
        $loaichiphi = Loaichiphi::all();
        $chiphi = Chiphi::where('doan_id', $id)->first();
        if($chiphi==null)
        {
            return view("chiphi.add", ['loaichiphi'=>$loaichiphi, 'id'=>$id, 'chiphi'=>$chiphi]);
        }
        else
        {
            $detail = json_decode($chiphi->chiphi_chitiet);
            return view("chiphi.add", ['loaichiphi'=>$loaichiphi, 'detail'=>$detail, 'chiphi'=>$chiphi,'id'=>$id]);
        }
    }

    public function postAddCp(Request $request, $id)
    {
        try{
            $chiphi = Chiphi::where('doan_id', $id)->first();
            $arr = [];
            
            if($chiphi==null)
            {
                $chiphi = new Chiphi;
                $chiphi->doan_id = $id;
                $chiphi->chiphi_total = $request->price;
            }
            else
            {
                $arr = json_decode($chiphi->chiphi_chitiet);
                $chiphi->chiphi_total += $request->price;
            }
            
            $obj = (object) [];
            $obj->price = $request->price;
            $obj->typecost = $request->typecost;
            $obj->code = $request->code;
            $obj->content = $request->content;
            $obj->date = $request->date;
            array_push($arr, $obj);
            $json = json_encode($arr);
            $chiphi->chiphi_chitiet = $json;
            $chiphi->save();
        }catch(QueryException $e)
        {
            return back()->withError('Can\'t create new Cost detail. Because form incomplete');
        }
        return redirect("cost/addcp&id=$id");
    }
}
