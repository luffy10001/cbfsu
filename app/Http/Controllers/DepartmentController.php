<?php

namespace App\Http\Controllers;

use App\DataTables\DepartmentsDataTable;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public string $userModule ='Department';

    function index(Request $request,DepartmentsDataTable $dataTable)
    {
        return $dataTable->render('departments.index');
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:80',
        ]);
        $data =[
            'name' => $request['name'],
        ];
        Department::create($data);
        Session::flash('message', 'Department has been created');
        return redirect()->back();
    }
    public function edit(Department $department)
    {
        return view('departments.edit',['department'=>$department]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'name'=>'required|max:20'
        ]);
        Department::where('id',$request->id)->first();
        $data =[
            'name'=>$request['name'],
        ];
        Department::where('id',$request->id)->update($data);
        return redirect()->back();
    }
    public function delete($id)
    {
        Department::where('id',$id)->delete();
        return response()->json([ 'success' =>  TRUE, 'message' => 'Department Deleted Successfully', 'close_modal' => TRUE, 'table' => 'roles'], 200);
    }
}
