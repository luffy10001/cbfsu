<?php

namespace App\Http\Controllers;

use App\DataTables\CityDataTable;
use App\Models\Province;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    public string $userModule ='City';

    function index(Request $request,CityDataTable $dataTable)
    {
        return $dataTable->render('cities.index');
    }

    public function create()
    {
        $province = Province::select('id','name','status')->where('status',true)->get();
        return view('cities.create',compact('province'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:600',
            'province'=>'required|gt:0',
        ], [
            'province.gt' => 'The Province field is required.',
        ]);
        $data = [
            'name'        => $request['name'],
            'province_id'  => $request['province'],
        ];
        City::create($data);

        Session::flash('message', 'City has been created');
        return redirect()->back();
    }

    public function edit(City $city)
    {
        $province = Province::select('id','name','status')->where('status',true)->get();
        return view('cities.edit',compact('city','province'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|max:600',
            'province'=>'required|gt:0',
        ], [
            'province.gt' => 'The Province field is required.',
        ]);
        $data = [
            'name'  => $request['name'],
            'province_id'  => $request['province'],
        ];
        City::where('id',$request->id)->update($data);
        return redirect()->back();
    }

    public function delete($id)
    {
        $id = mws_encrypt('D',$id);
        City::where('id',$id)->delete();
        return response()->json([ 'success' =>  TRUE, 'message' => 'City Deleted Successfully', 'close_modal' => TRUE, 'table' => 'cities'], 200);
    }

    public function status(Request $request,$id, $status)
    {
        $city = City::find($id);
        if($city){
            $city->update([
                'status' =>$status,
            ]);
        }
        if($status == 0){
            return response()->json([
                'success' => TRUE,
                'message' => 'City De-Activated Successfully',
                'close_modal' =>  TRUE,
                'table' => 'cities'],  200);
        }
        elseif($status == 1){
            return response()->json([
                'success' => TRUE,
                'message' => 'City Active Successfully',
                'close_modal' =>  TRUE,
                'table' => 'cities'],  200);
        }else{
            return response()->json([
                'success' => TRUE,
                'message' => 'Something Went Wrong',
                'close_modal' =>  TRUE,
                'table' => 'cities'],  200);
        }

    }
}
