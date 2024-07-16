<?php

namespace App\Http\Controllers;

use App\DataTables\ProvinceDataTable;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Province;
use Illuminate\Support\Facades\Session;

class ProvinceController extends Controller
{
    public string $userModule ='Province';
    //
    function index(Request $request,ProvinceDataTable $dataTable)
    {
        return $dataTable->render('province.index');
    }

    public function create()
    {
        return view('province.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:600',
        ]);
        $data = [
            'name'  => $request['name'],
            'status'  => true,
        ];
        Province::create($data);
        Session::flash('message', 'State has been created');
        return redirect()->back();
    }

    public function edit(Province $province)
    {
        return view('province.edit',compact('province'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'name'=>'required|max:600'
        ]);
        $data =[
            'name'  => $request['name'],
        ];
        Province::where('id',$request->id)->update($data);
        return redirect()->back();
    }

    public function delete($id)
    {
        $id = mws_encrypt('D',$id);
        Province::where('id',$id)->delete();
        return response()->json([ 'success' =>  TRUE, 'message' => 'State Deleted Successfully', 'close_modal' => TRUE, 'table' => 'State'], 200);
    }

    public function status(Request $request,$id, $status)
    {
        $Province = Province::find($id);
        if($Province){
             $Province->update([
                'status' =>$status,
            ]);
        }

        if($status == 0){
            return response()->json([
                'success' => TRUE,
                'message' => 'State De-Activated Successfully',
                'close_modal' =>  TRUE,
                'table' => 'province'],  200);
        }
        elseif($status == 1){
            return response()->json([
                'success' => TRUE,
                'message' => 'State Active Successfully',
                'close_modal' =>  TRUE,
                'table' => 'State'],  200);
        }else{
            return response()->json([
                'success' => TRUE,
                'message' => 'Something Went Wrong',
                'close_modal' =>  TRUE,
                'table' => 'province'],  200);
        }

    }
}
