<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionsDataTable;
use App\Models\Permission;
use App\Models\Role;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    function index(PermissionsDataTable $dataTable)
    {
        return $dataTable->render('permissions.index');
    }
    public function create()
    {
        $roles=Role::get();
        return view('permissions.create',['roles'=>$roles]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'route_name'=>'required|unique',
            'role_id'=>'required'
        ]);
        $input=$request->all();
        if(isset($request->is_active))
        {
            $input['is_active']=1;
        }else{
            $input['is_active']=0;
        }
        Permission::create($input);
        return redirect()->back();
    }
    public function edit(Permission $permission)
    {
        $roles=Role::get();
        return view('permissions.edit',['permission'=>$permission,'roles'=>$roles]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'route_name'=>'required|unique:permissions,route_name,'.$request->id,
            'role_id'=>'required'
        ]);
        $input=$request->only('route_name','role_id');
        if(isset($request->is_active))
        {
            $input['is_active']=1;
        }else{
            $input['is_active']=0;
        }
        Permission::where('id',$request->id)->update($input);        
        return redirect()->back();
    }
}
