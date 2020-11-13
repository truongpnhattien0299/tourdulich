<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\ModelNotFoundException;

use App\Models\Tour;
use App\Models\tourprice;
use App\Models\tourdetail;
use App\Models\listcity;
use App\Models\Loaitour;
use App\Models\location;
use Whoops\Exception\Formatter;

class TourController extends Controller
{
    public function getTour()
    {
        $tour = Tour::all();
        if($tour->first()==null)
        {
            session()->put('notice','Haven\'t any row');
            return view('tour.list');
        }
        return view('tour.list', ['tour' => $tour]);
    }

    public function getAddTour()
    {
        $city = listcity::all();
        $loai = Loaitour::all();
        if($loai->first()==null)
        {
            session()->put('notice','Don\'t have any Category of tour');
            return view('tour.add');
        }
        return view('tour.add', ['loai'=>$loai, 'city'=>$city]);
    }

    public function postAddTour(Request $request)
    {
        try{
            $tour = new Tour;
            $tour->tour_ten = $request->nametour;
            $tour->tour_mota = $request->txtDescript;
            $tour->loai_id = $request->catetour;
            $tour->save();

            $tour = Tour::orderBy('tour_id', 'desc')->first();
            $arr = $request->slLocation;
            for($i=0; $i<count($arr); $i++)
            {
                $tourdetail = new tourdetail;
                $tourdetail->tour_id = $tour->tour_id;
                $tourdetail->dd_id = $arr[$i];
                $tourdetail->ct_thutu = $i;
                $tourdetail->save();
            }
        }catch(QueryException $e){
            return back()->withError('Can\'t create new Tour. Because form incomplete')->withInput();
        }
        return redirect('tour/listtour');
    }

    public function getEditTour($id)
    {
        $city = listcity::all();
        $loai = Loaitour::all();
        $tour = Tour::find($id);
        $tourdetail = tourdetail::where('tour_id', $id)->orderBy('ct_thutu', 'asc')->get();
        return view('tour.edit', ['tour'=>$tour, 'tourdetail'=>$tourdetail, 'loai'=>$loai, 'city'=>$city]);
    }

    public function postEditTour(Request $request, $id)
    {
        try{
            $tour = Tour::find($id);
            $tour->tour_ten = $request->nametour;
            $tour->tour_mota = $request->txtDescript;
            $tour->loai_id = $request->catetour;
            $tour->save();
            $arr = $request->slLocation;
            $tourdetail = tourdetail::where('tour_id', $id)->get();
            for($i=0; $i<count($arr); $i++)
            {
                $flag = 0;
                foreach($tourdetail as $detail)
                {
                    if($detail->dd_id == $arr[$i])
                    {
                        $flag = 1;
                        $detail->ct_thutu = $i;
                        $detail->save();
                    }
                }
                if($flag==0)
                {
                    $newtourdetail = new tourdetail;
                    $newtourdetail->tour_id = $id;
                    $newtourdetail->dd_id = $arr[$i];
                    $newtourdetail->ct_thutu = $i;
                    $newtourdetail->save();
                }
            }

        }catch(QueryException $e){
            return back()->withError('Can\'t Edit the Tour. Because form incomplete')->withInput();
        }
        return redirect('tour/listtour');
    }

    public function deleteTour($id)
    {
        $tour = Tour::find($id);
        $tour->delete();
        return redirect('tour/listtour');
    }

    public function ajaxTour($id)
    {
        $location = location::where('tp_id', $id)->get();
        foreach($location as $item)
        {
            echo "<option id='city_".$item->id."' value='". $item->id ."'>". $item->dd_ten ."</option>";
        }
    }
    public function popTour($id)
    {
        $tourprice = tourprice::where('tour_id', $id)->get();
        $text="";
        foreach($tourprice as $item)
        {
            $text.='<option>'.number_format($item->gia_sotien,).' VNĐ ,  '.$item->gia_tungay.':'.$item->gia_denngay.'</option>';
        }
        return $text;
    }
}
