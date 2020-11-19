<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tour;
use App\Models\tourprice;
use App\Models\group;
use Illuminate\Database\QueryException;

class groupController extends Controller
{
    public function getgroup()
    {
        $group = group::all();
        if($group->first()==null)
        {
            session()->put('notice','Haven\'t any row');
            return view('group.list');
        }
        return view('group.list', ['group'=>$group]);
    }

    public function getAddgroup()
    {
        $tour = Tour::all();
        return view('group.add',['tour'=>$tour]);
    }

    public function postAddgroup(Request $request)
    {
        try{
            $group = new group;
            $group->tour_id = $request->tour;
            $group->doan_name = $request->name;
            $group->doan_ngaydi = $request->start;
            $group->doan_ngayve = $request->end;
            $group->gia_id = $request->tourprice;
            $group->doan_chitietchuongtrinh = $request->details;
            $group->gia_id = $request->tourprice;
            $group->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new group. Because form incomplete')->withInput();
        }
        return redirect('Group/listgrp');
    }

    public function getEditgroup($id)
    {
        $group = group::find($id);
        $tour = tour::all();
        return view('group.edit',['Group' => $group,'tour'=>$tour]);
    }

    public function postEditgroup(Request $request, $id)
    {
        try{
            $group = group::find($id);
            $group->tour_id = $request->tour;
            $group->doan_name = $request->name;
            $group->doan_ngaydi = $request->start;
            $group->doan_ngayve = $request->end;
            $group->doan_chitietchuongtrinh = $request->details;
            $group->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new group. Because form incomplete');
        }
        return redirect('Group/listgrp');
    }

    public function deletegroup($id)
    {
        try{
        $group = group::find($id);
        $group->delete();
        }catch(QueryException $e){
            return back()->withError('Can\'t Delete new group. Because form incomplete');
        }
        return redirect('Group/listgrp');
    }
    public function priceGroup($id, $start)
    {
        $gia = tourprice::where('tour_id', $id)->get();
        foreach($gia as $item)
        {
            if($start>=$item->gia_tungay && $start<=$item->gia_denngay)
            {
                echo "<option value='". $item->gia_id ."'>". $item->gia_sotien ."</option>";
            }
        }
    }
}
