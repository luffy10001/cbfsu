<?php

namespace App\Http\Controllers;

use App\DataTables\IndicatorDataTable;
use App\Models\Indicator;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndicatorController extends Controller
{
    public string $userModule ='Indicator';

    function index(Request $request,IndicatorDataTable $dataTable)
    {
        return $dataTable->render('indicators.index');
    }

    public function create()
    {
        $service = Service::select('id','name','status')->where('status',true)->get();
        return view('indicators.create',compact('service'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:600',
            'service'=>'required|gt:0',
        ], [
            'service.gt' => 'The Service field is required.',
        ]);
        $data = [
            'name'  => $request['name'],
            'service_id'  => $request['service'],
        ];
        Indicator::create($data);

        Session::flash('message', 'Indicator has been created');
        return redirect()->back();
    }

    public function edit(Indicator $indicator)
    {
        $service = Service::select('id','name','status')->where('status',true)->get();
        return view('indicators.edit',compact('indicator','service'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|max:600',
            'service'=>'required|gt:0',
        ], [
            'service.gt' => 'The Service field is required.',
        ]);
        $data = [
            'name'  => $request['name'],
            'service_id'  => $request['service'],
        ];
        Indicator::where('id',$request->id)->update($data);
        return redirect()->back();
    }

    public function delete($id)
    {
        $id = mws_encrypt('D',$id);
        Indicator::where('id',$id)->delete();
        return response()->json([ 'success' =>  TRUE, 'message' => 'Indicator Deleted Successfully', 'close_modal' => TRUE, 'table' => 'indicators'], 200);
    }

    public function status(Request $request,$id, $status)
    {
        $indicator = Indicator::find($id);
        if($indicator){
            $indicator->update([
                'status' =>$status,
            ]);
        }
        if($status == 0){
            return response()->json([
                'success' => TRUE,
                'message' => 'Indicator De-Activated Successfully',
                'close_modal' =>  TRUE,
                'table' => 'indicators'],  200);
        }
        elseif($status == 1){
            return response()->json([
                'success' => TRUE,
                'message' => 'Indicator Active Successfully',
                'close_modal' =>  TRUE,
                'table' => 'indicators'],  200);
        }else{
            return response()->json([
                'success' => TRUE,
                'message' => 'Something Went Wrong',
                'close_modal' =>  TRUE,
                'table' => 'indicators'],  200);
        }

    }
}
