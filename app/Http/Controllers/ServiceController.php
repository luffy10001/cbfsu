<?php

namespace App\Http\Controllers;

use App\DataTables\ServiceDataTable;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public string $userModule ='Service';

    function index(Request $request,ServiceDataTable $dataTable)
    {
        return $dataTable->render('services.index');
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:600',
        ]);
        $data = [
            'name'  => $request['name'],
        ];
        Service::create($data);
        Session::flash('message', 'Service has been created');
        return redirect()->back();
    }

    public function edit(Service $service)
    {
        return view('services.edit',compact('service'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|max:600',
        ]);
        $data = [
            'name'  => $request['name'],
        ];
        Service::where('id',$request->id)->update($data);
        return redirect()->back();
    }

    public function delete($id)
    {
        $id = mws_encrypt('D',$id);
        Service::where('id',$id)->delete();
        return response()->json([ 'success' =>  TRUE, 'message' => 'Service Deleted Successfully', 'close_modal' => TRUE, 'table' => 'services'], 200);
    }

    public function status(Request $request,$id, $status)
    {
        $service = Service::find($id);
        if($service){
            $service->update([
                'status' => $status,
            ]);
        }
        if($status == 0){
            return response()->json([
                'success' => TRUE,
                'message' => 'Service De-Activated Successfully',
                'close_modal' =>  TRUE,
                'table' => 'services'],  200);
        }
        elseif($status == 1){
            return response()->json([
                'success' => TRUE,
                'message' => 'Service Active Successfully',
                'close_modal' =>  TRUE,
                'table' => 'services'],  200);
        }else{
            return response()->json([
                'success' => TRUE,
                'message' => 'Something Went Wrong',
                'close_modal' =>  TRUE,
                'table' => 'services'],  200);
        }

    }
}
