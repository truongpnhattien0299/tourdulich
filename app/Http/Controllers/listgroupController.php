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
        $text="";
        foreach($listgroup as $item){
            $text.=$item->nguoidi_dsnhanvien." ";
        }
        dd($text);
        $arr = explode(" ",$text);
        dd($arr);
        for($i=0;$i<count($arr)-1;$i++){
            $arr2 = explode(",",$arr[$i]);
        }
        dd($arr2);
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
        try{
            $listgroup = new listgroup;
            $listgroup->doan_id = $request->group;
            $arr= $request->ListCustomer;
            $test="";
            for($i = 0; $i<count($arr) ;$i++){
                $test.=$arr[$i].",";
            }
            $listgroup->nguoidi_dsnhanvien = $test;
            $arr2= $request->Listemployee;
            $test2="";
            for($i = 0; $i<count($arr2) ;$i++){
                $test2.=$arr2[$i].",";
            }
            $listgroup->nguoidi_dskhach = $test2;
            $listgroup->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new listgroup. Because form incomplete')->withInput();
        }
        return redirect('Listgroup/listlgrp');
    }

    public function getEditlistgroup($id)
    {
        $listgroup = listgroup::find($id);
        return view('listgroup.edit',['listgroup' => $listgroup]);
    }

    public function postEditlistgroup(Request $request, $id)
    {
        try{
            $listgroup = listgroup::find($id);
            $listgroup->nv_ten = $request->name;
            $listgroup->nv_sdt = $request->phone;
            $listgroup->nv_ngaysinh = $request->dayOfBirth;
            $listgroup->nv_email = $request->email;
            $listgroup->nv_nhiemvu = $request->mission;
            $listgroup->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new listgroup. Because form incomplete');
        }
        return redirect('Listgroup/listlgrp');
    }

    public function deletelistgroup($id)
    {
        $listgroup = listgroup::find($id);
        $listgroup->delete();
        return redirect('Listgroup/listlgrp');
    }
}
