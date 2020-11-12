<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loaichiphi;
use Illuminate\Database\QueryException;
class LoaichiphiController extends Controller
{
    public function getTc()
    {
        $loaichiphi = Loaichiphi::all();
        if($loaichiphi->first()==null)
        {
            session()->put('notice','Haven\'t any row');
            return view('loaichiphi.list');
        }
        return view('loaichiphi.list', ['loaichiphi'=>$loaichiphi]);
    }
    
    public function getAddTc()
    {
        return view('loaichiphi.add');
    }

    public function postAddTc(Request $request)
    {
        try{
            $loaichiphi = new Loaichiphi;
            $loaichiphi->cp_ten = $request->name;
            $loaichiphi->cp_mota = $request->description;
            $loaichiphi->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new Type cost. Because form incomplete')->withInput();
        }
        return redirect('typecost/listtc');
    }

    public function getEditTc($id)
    {
        $loaichiphi = Loaichiphi::find($id);
        return view('loaichiphi.edit',['loaichiphi' => $loaichiphi]);
    }
    
    public function postEditTc(Request $request, $id) 
    {
        try{
            $loaichiphi = Loaichiphi::find($id);
            $loaichiphi->cp_ten = $request->name;
            $loaichiphi->cp_mota = $request->description;
            $loaichiphi->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new Type cost. Because form incomplete')->withInput();
        }
        return redirect('typecost/listtc');
    }

    public function deleteTc($id)
    {
        $loaichiphi = Loaichiphi::find($id);
        $loaichiphi->delete();
        return redirect('typecost/listtc');
    }
}
