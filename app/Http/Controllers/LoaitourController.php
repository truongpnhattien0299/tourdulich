<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loaitour;
use Illuminate\Database\QueryException;
use Illuminate\Database\ModelNotFoundException;
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
            return back()->withError('Can\'t create new category. Because form incomplete')->withInput();
        }
        return redirect('category/listcate');
    }

    public function getEditLoai($id)
    {
        $loai = Loaitour::find($id);
        return view('loaitour.edit', ['loai'=>$loai]);
    }

    public function postEditLoai(Request $request, $id)
    {
        try{
            $loai = Loaitour::findOrFail($id);
            $loai->loai_ten = $request->namecate;
            $loai->loai_mota = $request->txtDescript;
            $loai->save();
        }catch(ModelNotFoundException $e){
            return back()->withError('Can\'t create new category. Because can\'t find id category')->withInput();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new category. Because form incomplete')->withInput();
        }
        return redirect('category/listcate');
    }

    public function deleteLoai($id)
    {
        try{
            $loai = Loaitour::findOrFail($id);
            $loai->delete();
        }catch(ModelNotFoundException $e){
            return back()->withError('Can\'t create new category. Because can\'t find id category')->withInput();
        }
        return redirect('category/listcate');
    }
}
