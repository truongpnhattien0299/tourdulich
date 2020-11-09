<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('group.add');
    }

    public function postAddgroup(Request $request)
    {
        try{
            $group = new group;
            $group->tour_id = $request->tour_id;
            $group->doan_name = $request->name;
            $group->doan_ngaydi = $request->ngaydi;
            $group->doan_ngayve = $request->ngayve;
            $group->doan_chitietchuongtrinh = $request->chitiet;
            $group->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new group. Because form incomplete')->withInput();
        }
        return redirect('group/listgrp');
    }

    public function getEditgroup($id)
    {
        $group = group::find($id);
        return view('group.edit',['group' => $group]);
    }

    public function postEditgroup(Request $request, $id)
    {
        try{
            $group = group::find($id);
            $group->tour_id = $request->tour_id;
            $group->doan_name = $request->name;
            $group->doan_ngaydi = $request->ngaydi;
            $group->doan_ngayve = $request->ngayve;
            $group->doan_chitietchuongtrinh = $request->chitiet;
            $group->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new group. Because form incomplete');
        }
        return redirect('group/listgrp');
    }

    public function deletegroup($id)
    {
        $group = group::find($id);
        $group->delete();
        return redirect('group/listgrp');
    }
}
