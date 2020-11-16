<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
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
            $arr = []; $tmp=0;
            
            if($chiphi==null)
            {
                $chiphi = new Chiphi;
                $chiphi->doan_id = $id;
                $chiphi->chiphi_total = $request->price;
                $tmp=1;
            }
            else
            {
                $arr = json_decode($chiphi->chiphi_chitiet);
                $dem = count($arr) - 1;
                $tmp = $arr[$dem]->id + 1;
                $chiphi->chiphi_total += $request->price;
            }
            
            $obj = (object) [];
            $obj->id = $tmp;
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

    public function postEditCp(Request $request, $id)
    {
        $chiphi = Chiphi::where('doan_id', $id)->first();
        $arr = json_decode($chiphi->chiphi_chitiet);
        $arr[$request->id]->code = $request->code;
        $arr[$request->id]->typecost = $request->typecost;
        $arr[$request->id]->price = $request->price;
        $arr[$request->id]->date = $request->date;
        $arr[$request->id]->content = $request->content;
        $txt = "";

        for($i = 0; $i<count($arr); $i++)
        {
            $txt .= '<tr id="idcost_'.$i.'" onclick="getdata('.$i.','.$arr[$i]->code.',\''.$arr[$i]->typecost.'\',\''.$arr[$i]->content.'\',\''.$arr[$i]->price.'\',\''.$arr[$i]->date.'\')"> 
            <td>'. ($i + 1) .'</td>
            <td>'. $arr[$i]->code .'</td>
            <td>'. $arr[$i]->typecost .'</td>
            <td>'. $arr[$i]->content .'</td>
            <td>'. $arr[$i]->price .'</td>
        </tr>';
        }
        
        $json = json_encode($arr);
        $chiphi->chiphi_chitiet = $json;
        $chiphi->save();
        return $txt;
    }
}
