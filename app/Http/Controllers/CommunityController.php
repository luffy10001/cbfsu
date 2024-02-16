<?php

namespace App\Http\Controllers;

use App\DataTables\CommunityDataTable;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommunityController extends Controller
{
    public string $userModule ='Community';
    //
    function index(Request $request,CommunityDataTable $dataTable)
    {
        return $dataTable->render('communities.index');
    }

    public function create()
    {
        return view('communities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:600',
        ]);
        $data = [
            'name'  => $request['name'],
        ];
        Community::create($data);
        Session::flash('message', 'Community has been created');
        return redirect()->back();
    }

    public function edit(Community $community)
    {
        return view('communities.edit',compact('community'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|max:600',
        ]);
        $data = [
            'name'  => $request['name'],
        ];
        Community::where('id',$request->id)->update($data);
        return redirect()->back();
    }

    public function delete($id)
    {
        $id = mws_encrypt('D',$id);
        Community::where('id',$id)->delete();
        return response()->json([ 'success' =>  TRUE, 'message' => 'Community Deleted Successfully', 'close_modal' => TRUE, 'table' => 'communities'], 200);
    }

    public function status(Request $request,$id, $status)
    {
        $community = Community::find($id);
        if($community){
            $community->update([
                'status' =>$status,
            ]);
        }
        if($status == 0){
            return response()->json([
                'success' => TRUE,
                'message' => 'Community De-Activated Successfully',
                'close_modal' =>  TRUE,
                'table' => 'communities'],  200);
        }
        elseif($status == 1){
            return response()->json([
                'success' => TRUE,
                'message' => 'Community Active Successfully',
                'close_modal' =>  TRUE,
                'table' => 'communities'],  200);
        }else{
            return response()->json([
                'success' => TRUE,
                'message' => 'Something Went Wrong',
                'close_modal' =>  TRUE,
                'table' => 'communities'],  200);
        }
    }
}

