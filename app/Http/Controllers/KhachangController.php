<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khachang;
use Illuminate\Database\QueryException;
class KhachangController extends Controller
{
    public function getKH()
    {
        $khachang = Khachang::all();
        return view('khachang.list', ['khachang'=>$khachang]);
    }
    
    public function getAddKH()
    {
        $khachang = Khachang::all();
        return view('khachang.add');
    }

    public function postAddKH(Request $request)
    {
        try{
        $khachang = new Khachang;
        $khachang->kh_ten = $request->name;
        $khachang->kh_sdt = $request->phone;
        $khachang->kh_ngaysinh = $request->dayOfBirth;
        $khachang->kh_email = $request->email;
        $khachang->kh_cmnd = $request->identity;
        $khachang->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new customer. Because form incomplete')->withInput();
        }
        return view('khachang.list');
    }
}
