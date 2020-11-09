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
        return view('location.add');
    }

    public function postAddlocation(Request $request)
    {
        try{
            $location = new location;
            $location->nv_ten = $request->name;
            $location->nv_sdt = $request->phone;
            $location->nv_ngaysinh = $request->dayOfBirth;
            $location->nv_email = $request->email;
            $location->nv_nhiemvu = $request->mission;
            $location->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new location. Because form incomplete')->withInput();
        }
        return redirect('location/listemp');
    }

    public function getEditlocation($id)
    {
        $location = location::find($id);
        return view('location.edit',['location' => $location]);
    }

    public function postEditlocation(Request $request, $id)
    {
        try{
            $location = location::find($id);
            $location->nv_ten = $request->name;
            $location->nv_sdt = $request->phone;
            $location->nv_ngaysinh = $request->dayOfBirth;
            $location->nv_email = $request->email;
            $location->nv_nhiemvu = $request->mission;
            $location->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new location. Because form incomplete');
        }
        return redirect('location/listemp');
    }

    public function deletelocation($id)
    {
        $location = location::find($id);
        $location->delete();
        return redirect('location/listemp');
    }
}
