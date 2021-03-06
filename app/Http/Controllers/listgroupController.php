<?php

namespace App\Http\Controllers;
use App\Models\group;
use App\Models\Khachang;
use App\Models\employee;
use Illuminate\Http\Request;
use App\Models\listgroup;
use Illuminate\Database\QueryException;

class listgroupController extends Controller
{
    public function getlistgroup()
    {
        $listgroup = listgroup::all();
        if($listgroup->first()==null)
        {
            session()->put('notice','Haven\'t any row');
            return view('listgroup.list');
        }
        return view('listgroup.list', ['listgroup'=>$listgroup]);
    }

    public function getAddlistgroup()
    {
        $group = group::all();
        $customer = Khachang::all();
        $employee = employee::all();
        return view('listgroup.add',['group'=>$group,'customer'=>$customer,'employee'=>$employee]);
    }

    public function postAddlistgroup(Request $request)
    {
        $listgroup = listgroup::where("doan_id",$request->group)->get()->count();
        if($listgroup > 0){
            return back()->withError('Can\'t create new listgroup. Because group has been create')->withInput();
        }else{
            try{
                if($request->ListCustomer == null){
                    return back()->withError('Can\'t create new listgroup.List customer is null')->withInput();
                }
                if($request->Listemployee == null){
                    return back()->withError('Can\'t create new listgroup. List employee is null')->withInput();
                }
                $listgroup = new listgroup;
                $listgroup->doan_id = $request->group;
                $arr= $request->ListCustomer;
                $arr1=[];
                for($i = 0; $i<count($arr) ;$i++){
                    $obj = (object) [];
                    $group = group::find($request->group);
                    $obj->id=$arr[$i];
                    $obj->ngaydi=$group->doan_ngaydi;
                    $obj->ngayve=$group->doan_ngayve;
                    array_push($arr1, $obj);
                }
                $json = json_encode($arr1);
                $listgroup->nguoidi_dskhach = $json;
                $arr2= $request->Listemployee;
                $arr3=[];
                for($i = 0; $i<count($arr2) ;$i++){
                    $obj = (object) [];
                    $group = group::find($request->group);
                    $obj->id=$arr2[$i];
                    $obj->ngaydi=$group->doan_ngaydi;
                    $obj->ngayve=$group->doan_ngayve;
                    array_push($arr3, $obj);
                }
                $json1 = json_encode($arr3);
                $listgroup->nguoidi_dsnhanvien = $json1;
                $listgroup->save();
            }catch(QueryException $e){
                return back()->withError('Can\'t create new listgroup. Because form incomplete')->withInput();
            }
        }
        return redirect('Listgroup/listlgrp');
    }

    public function getEditlistgroup($id)
    {
        $listgroup = listgroup::find($id);
        //
        $arr= json_decode($listgroup->nguoidi_dsnhanvien);
        $arr1=[];
        for($i = 0; $i<count($arr) ;$i++){
           $arr1[$i]=$arr[$i]->id;
        }
        $employee1=[];
        for($i = 0;$i < count($arr1);$i++){
            $employee = employee::find($arr1[$i]);
            $employee1['id'][$i]=$employee->nv_id;
            $employee1['val'][$i]=$employee->nv_ten."--".$employee->nv_nhiemvu;
        }
        //
        $arr2= json_decode($listgroup->nguoidi_dskhach);
        $arr3=[];
        for($i = 0; $i<count($arr2) ;$i++){
           $arr3[$i]=$arr2[$i]->id;
        }
        $customer1=[];
        for($i = 0;$i < count($arr3);$i++){
            $customer = Khachang::find($arr3[$i]);
            $customer1['id'][$i]=$customer->kh_id;
            $customer1['val'][$i]=$customer->kh_ten;
        }
        $listcustomer = Khachang::all();
        $listemployee = employee::all();
        return view('listgroup.edit',['listgroup' => $listgroup,'listcustomer'=>$listcustomer,'listemployee'=>$listemployee,'customer'=>$customer1,'employee'=>$employee1]);
    }

    public function postEditlistgroup(Request $request, $id)
    {
            try{
                if($request->ListCustomer == null){
                    return back()->withError('Can\'t create new listgroup.List customer is null')->withInput();
                }
                if($request->Listemployee == null){
                    return back()->withError('Can\'t create new listgroup. List employee is null')->withInput();
                }
                $listgroup = listgroup::find($id);
                $arr= $request->ListCustomer;
                $arr1=[];
                for($i = 0; $i<count($arr) ;$i++){
                    $obj = (object) [];
                    $group = group::find($request->group);
                    $obj->id=$arr[$i];
                    $obj->ngaydi=$group->doan_ngaydi;
                    $obj->ngayve=$group->doan_ngayve;
                    array_push($arr1, $obj);
                }
                $json = json_encode($arr1);
                $listgroup->nguoidi_dskhach = $json;
                $arr2= $request->Listemployee;
                $arr3=[];
                for($i = 0; $i<count($arr2) ;$i++){
                    $obj = (object) [];
                    $group = group::find($request->group);
                    $obj->id=$arr2[$i];
                    $obj->ngaydi=$group->doan_ngaydi;
                    $obj->ngayve=$group->doan_ngayve;
                    array_push($arr3, $obj);
                }
                $json1 = json_encode($arr3);
                $listgroup->nguoidi_dsnhanvien = $json1;
                $listgroup->save();
            }catch(QueryException $e){
                return back()->withError('Can\'t create new listgroup. Because form incomplete')->withInput();
            }
        return redirect('Listgroup/listlgrp');
    }

    public function deletelistgroup($id)
    {
        $listgroup = listgroup::find($id);
        $listgroup->delete();
        return redirect('Listgroup/listlgrp');
    }
    public function ajaxListemp($id)
    {
        $arr=[];
        $json = json_decode($id);
        for($i=0; $i < count($json) ;$i++){
                $arr[$i]=$json[$i]->id;
        }
        $text="";
        for($i = 0;$i < count($arr);$i++){
            $employee = employee::find($arr[$i]);
            $text.="<option>".$employee->nv_ten."--".$employee->nv_nhiemvu."</option>";
        }
        return $text;
    }
    public function ajaxListcus($id)
    {
        $arr=[];
        $json = json_decode($id);
        for($i=0; $i < count($json) ;$i++){
                $arr[$i]=$json[$i]->id;
        }
        $text="";
        for($i = 0;$i < count($arr);$i++){
            $khachhang = Khachang::find($arr[$i]);
            $text.="<option>".$khachhang->kh_ten."</option>";
        }
        return $text;
    }
    // public function ajaxList($id)
    // {
    //     $text="";
    //     $arr=[];
    //     $customer = Khachang::all();
    //     $listgroup= listgroup::where('doan_id',$id)->get();
    //     foreach($listgroup as $item){
    //         $json = json_decode($item->nguoidi_dskhach);
    //         for($i=0;$i<count($json);$i++){
    //             $arr[$item->nguoidi_id][$i]=$json[$i]->id;
    //         }
    //     }
    //     $text="";
    //     foreach($listgroup as $item){
    //         for($i=0;$i<count($arr[$item->nguoidi_id]);$i++){
    //             foreach($customer as $item1){
    //                 if($item1->kh_id == $arr[$item->nguoidi_id][$i])
    //                     $text.=$arr[$item->nguoidi_id][$i];
    //             }
    //         }
    //     }
    //     dd($text);
    //     return $text;
    // }
}
