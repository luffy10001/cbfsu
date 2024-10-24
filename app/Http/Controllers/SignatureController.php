<?php

namespace App\Http\Controllers;

use App\DataTables\SignatureDataTable;
use App\Models\Signature;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    use FileUploadTrait;
    public function index(SignatureDataTable $dataTable){
        return $dataTable->render('signature.index');
    }

    public function create(){
        return view('signature.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'  =>  'required',
            'attachment_type'  =>  'required|gt:0',
            'attachment'  =>  'required'

        ],
        [
            'attachment_type'   =>  'The attachment type field is required.',
        ]);
        $att_time='';
        if($request->hasFile('attachment')){
            $fileUploadResponse = $this->uploadFile($request->file('attachment'), 'images/signature/');
            if (isset($fileUploadResponse['success']) && $fileUploadResponse['success'] == TRUE )
            {
                $att_time = $fileUploadResponse['filename'];
            }
        }
        $data   =   [
            'name'  =>  $request['name'],
            'attachment_type'  =>  $request['attachment_type'],
            'attachment'  =>  $att_time,
        ];
        Signature::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Seal & Signature Created Successfully!',
            'close_modal' => true,
            'table' => 'signatures'
        ]);
    }
    public function edit($id){
        $d_id   =   mws_encrypt('D',$id);
        $signature  =   Signature::where('id',$d_id)->first();
        return view('signature.edit',compact('signature'));
    }

    public function update(Request $request){
        $request->validate([
            'name'  =>  'required',
            'attachment_type'  =>  'required|gt:0',
            'attachment'  =>  'required'

        ],
            [
                'attachment_type'   =>  'The attachment type field is required.',
            ]);

        if($request->hasFile('attachment')){
            $fileUploadResponse = $this->uploadFile($request->file('attachment'), 'images/signature/');
            if (isset($fileUploadResponse['success']) && $fileUploadResponse['success'] == TRUE )
            {
                $att_time = $fileUploadResponse['filename'];
            }
        }
        $data   =   [
            'name'  =>  $request['name'],
            'attachment_type'  =>  $request['attachment_type'],
            'attachment'  =>  $att_time,
        ];
        Signature::where('id',$request['id'])->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Seal & Signature updated Successfully!',
            'close_modal' => true,
            'table' => 'signatures'
        ]);
    }

    public function detail($id)
    {
        $d_id   =   mws_encrypt('D',$id);
        $signature  =   Signature::where('id',$d_id)->first();
        return view('signature.detail',compact('signature'));
    }

    public function destroy($id){
        $d_id   =   mws_encrypt('D',$id);
        $signature = Signature::find($d_id);
        if ($signature) {
            $signature->delete();
        }
        return response()->json([
            'success' => true,
            'message' => "Signature Deleted Successfully!",
            'close_modal' => true,
            'table' => 'signatures'
        ]);
    }

}
