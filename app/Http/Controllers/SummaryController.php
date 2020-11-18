<?php

namespace App\Http\Controllers;

use App\Models\Chiphi;
use App\Models\group;
use App\Models\Tour;
use App\Models\tourprice;
use App\Models\listgroup;
use App\Models\employee;
use App\Models\Khachang;

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
    public function Counttour(){
        $employee = employee::all();
        $listgroup = listgroup::all();
        $arr=[];
        foreach($listgroup as $item){
            $json = json_decode($item->nguoidi_dsnhanvien);
            for($i=0;$i< count($json);$i++){
                array_push($arr, $json[$i]->id);
            }
        }
        $list = [];
        foreach($employee as $item){
            $count=0;
            for($i=0;$i< count($arr);$i++){
                if($item->nv_id == $arr[$i]){
                    $count++;
                }
            }
            $obj = (object) [];
            $obj->id=$item->nv_id;
            $obj->count=$count;
            $obj->name = $item->nv_ten;
            array_push($list, $obj);
        }
        return view("summany.tour",['employee'=>$list]);
    }
   public function search(Request $request){
        $employee = employee::all();
        $listgroup = listgroup::all();
        $arr=[];
        $date=[];
        foreach($listgroup as $item){
            $json = json_decode($item->nguoidi_dsnhanvien);
            for($i=0;$i< count($json);$i++){
                $obj = (object) [];
                $obj->id=$json[$i]->id;
                $obj->ngaydi=$json[$i]->ngaydi;
                $obj->ngayve=$json[$i]->ngayve;
                array_push($arr, $json[$i]->id);
                array_push($date, $obj);
            }
        }
        $list = [];
        for($i=0;$i< count($date);$i++){
            if( $request->start <= $date[$i]->ngaydi &&  $request->end >= $date[$i]->ngayve ){
                array_push($list, $date[$i]);
            }
        }
        if(count($list)==0){
            return "<tr><td colspan='3'>Empty</td></tr>";
        }
        $search=[];
        foreach($employee as $item){
            $count=0;
            for($i=0;$i< count($list);$i++){
                if($item->nv_id == $arr[$i]){
                    $count++;
                }
            }
            $obj = (object) [];
            $obj->id=$item->nv_id;
            $obj->count=$count;
            $obj->name = $item->nv_ten;
            array_push($search, $obj);
        }
        $text="";
        for($i=0;$i< count($search);$i++){
            $text.="<tr>
                <td>".$search[$i]->id."</td>
                <td>".$search[$i]->name."</td>
                <td>".$search[$i]->count."</td>
            </tr>";
        }
        return $text;
   }
}
