<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loaitour;
class LoaitourController extends Controller
{
    public function getLoai()
    {
        $loai = Loaitour::all();
        if($loai->first()==null)
        {
            session()->put('notice','Haven\'t any row');
            return view('loaitour.list');
        }
        return view('loaitour.list', ['loai' => $loai]);
    }

    public function getAddLoai()
    {
        return view('loaitour.add');
    }

    public function postAddLoai(Request $request)
    {
        try{
            $loai = new Loaitour;
            $loai->loai_ten = $request->namecate;
            $loai->loai_mota = $request->txtDescript;
            $loai->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new customer. Because form incomplete')->withInput();
        }
        return redirect('category/listcate');
    }
}
