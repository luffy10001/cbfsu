<?php

namespace App\Http\Controllers;

use App\DataTables\RolesDataTable;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class RoleController extends Controller
{

    public string $userModule ='Role';
    //
    function index(Request $request,RolesDataTable $dataTable)
    {
        return $dataTable->render('roles.index');
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:200',
        ]);
        $slug_name = Str::slug($request['name']);
        $data = [
            'name'  => $request['name'],
            'slug'  => $slug_name,
        ];
        Role::create($data);
        Session::flash('message', 'Role has been created');
        return redirect()->back();
    }

    public function edit(Role $role)
    {
        return view('roles.edit',['role'=>$role]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'name'=>'required|max:200'
        ]);
        Role::where('id',$request->id)->first();
        $data =[
            'name'  => $request['name'],
        ];
        Role::where('id',$request->id)->update($data);
        return redirect()->back();
    }

    public function delete($id)
    {
        Role::where('id',$id)->delete();
        return response()->json([ 'success' =>  TRUE, 'message' => 'Role Deleted Successfully', 'close_modal' => TRUE, 'table' => 'roles'], 200);
    }
}
