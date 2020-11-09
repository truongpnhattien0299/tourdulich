<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
use Illuminate\Database\QueryException;

class employeeController extends Controller
{
    public function getEmployee()
    {
        $employee = employee::all();
        if($employee->first()==null)
        {
            session()->put('notice','Haven\'t any row');
            return view('employee.list');
        }
        return view('employee.list', ['employee'=>$employee]);
    }

    public function getAddEmployee()
    {
        return view('employee.add');
    }

    public function postAddEmployee(Request $request)
    {
        try{
            $employee = new employee;
            $employee->nv_ten = $request->name;
            $employee->nv_sdt = $request->phone;
            $employee->nv_ngaysinh = $request->dayOfBirth;
            $employee->nv_email = $request->email;
            $employee->nv_nhiemvu = $request->mission;
            $employee->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new Employee. Because form incomplete')->withInput();
        }
        return redirect('Employee/listemp');
    }

    public function getEditEmployee($id)
    {
        $employee = employee::find($id);
        return view('employee.edit',['employee' => $employee]);
    }

    public function postEditEmployee(Request $request, $id)
    {
        try{
            $employee = employee::find($id);
            $employee->nv_ten = $request->name;
            $employee->nv_sdt = $request->phone;
            $employee->nv_ngaysinh = $request->dayOfBirth;
            $employee->nv_email = $request->email;
            $employee->nv_nhiemvu = $request->mission;
            $employee->save();
        }catch(QueryException $e){
            return back()->withError('Can\'t create new Employee. Because form incomplete');
        }
        return redirect('Employee/listemp');
    }

    public function deleteEmployee($id)
    {
        $employee = employee::find($id);
        $employee->delete();
        return redirect('Employee/listemp');
    }
}
