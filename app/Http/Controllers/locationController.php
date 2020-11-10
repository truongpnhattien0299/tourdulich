<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\location;
use App\Models\listcity;
use Illuminate\Database\QueryException;

class locationController extends Controller
{
    public function getlocation()
    {
        $location = location::all();
        if($location->first()==null)
        {
            session()->put('notice','Haven\'t any row');
            return view('location.list');
        }
        return view('location.list', ['location'=>$location]);
    }

    public function getAddlocation()
    {
        $listcity = listcity::all();
        return view('location.add',['listcity'=>$listcity]);
    }

    public function postAddlocation(Request $request)
    {
        try{
            $location = new location;
            $location->tp_id = $request->city;
            $location->dd_ten = $request->name;
            $location->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new location. Because form incomplete')->withInput();
        }
        return redirect('Location/listlct');
    }

    public function getEditlocation($id)
    {
        $location = location::find($id);
        $listcity = listcity::all();
        return view('location.edit',['location' => $location,'listcity'=>$listcity]);
    }

    public function postEditlocation(Request $request, $id)
    {
        try{
            $location = location::find($id);
            $location->dd_ten = $request->name;
            $location->tp_id = $request->city;
            $location->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new location. Because form incomplete');
        }
        return redirect('Location/listlct');
    }

    public function deletelocation($id)
    {
        $location = location::find($id);
        $location->delete();
        return redirect('Location/listlct');
    }
}
