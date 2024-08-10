<?php

namespace App\Http\Controllers;

use App\DataTables\InsurerDataTable;
use App\Models\Agent;
use App\Models\City;
use App\Models\Customer;
use App\Models\Insurer;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class InsurerController extends Controller
{
    public string $userModule = 'insurers';

    public function index(InsurerDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with('user', $user)->render('insurers.index');
    }

    public function create()
    {
        $underwriters = User::from(TableName(User::class).' as user')
            ->leftJoin(TableName(Role::class).' as role','user.role_id','=','role.id')
            ->select('user.id as id','user.name as name')
            ->where([ 'role.slug' => 'underwriter' ])->get();
        $provinces = Province::select('id','name')->where('status',true)->orderBY('name')->get();
        return view('insurers.create',compact('underwriters','provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'am_best_rating' => 'required|gt:0',
            'treasury'       => 'required',
            'address'        => 'required',
            'province_id'    => 'required|gt:0',
            'city_id'        => 'required|gt:0',
            'zip'            => 'required',
            'website'        => 'required',
            'cbu_name'       => 'required',
            'cbu_phone'       => 'required',
            'cbu_email'       => 'required|email|email',
            'clbu_name'       => 'required',
            'clbu_phone'        => 'required',
            'clbu_email'      => 'required|email|email',
            'attorney'        => 'required',
//            'email'          => 'required|unique:' . TableName(Insurer::class) . ',email|email',
        ], [
            'province_id.gt' => 'The State field is required.',
            'website' => 'The surety website field is required..',
            'city_id.gt'     => 'The City field is required.',
            'am_best_rating.gt'    => 'The Am Best Rating field is required.',
            'cbu_name'  =>  'The contract bond underwriter field is required.',
            'cbu_phone'  =>  'The phone field is required.',
            'cbu_email.required'  =>  'The email field is required.',
            'cbu_email.email'  =>  'The email field must be a valid email address..',
            'clbu_name'  =>  'The commercial bond underwriter field is required.',
            'clbu_phone'  =>  'The phone field is required.',
            'clbu_email.required'  =>  'The email field is required.',
            'clbu_email.email'  =>  'The email field must be a valid email address..',
            'attorney'  =>  'The Attorneys-in-Fact field is required.',
        ]);
        $data = [
            'name'      => $request['name'],
            'am_best_rating'     => $request['am_best_rating'],
            'treasury_list'     => $request['treasury'],
            'address'  => $request['address'],
            'state_id'        => $request['province_id'],
            'city_id'         => $request['city_id'],
            'zip'             => $request['zip'],
            'website'         => $request['website'],
            'cbu_name'         => $request['cbu_name'],
            'cbu_phone'         => $request['cbu_phone'],
            'cbu_email'         => $request['cbu_email'],
            'clbu_name'         => $request['clbu_name'],
            'clbu_phone'         => $request['clbu_phone'],
            'clbu_email'         => $request['clbu_email'],
            'attorney'         => $request['attorney'],
        ];
        Insurer::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Insurer Created Successfully!',
            'redirect'  =>  route('insurer.index'),
            'table' => 'insurers'
        ]);
    }

    public function edit(Insurer $insurer)
    {
//        $underwriters = User::from(TableName(User::class).' as user')
//        ->leftJoin(TableName(Role::class).' as role','user.role_id','=','role.id')
//        ->select('user.id as id','user.name as name')
//        ->where([ 'role.slug' => 'underwriter' ])->get();
        $provinces = Province::select('id','name')->where('status',true)->orderBY('name')->get();
        $cities = City::select('id','name')->where('status',true)->where('province_id',$insurer['state_id'])->orderBY('name')->get();
        return view('insurers.edit',compact('insurer','provinces','cities'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'am_best_rating' => 'required|gt:0',
            'treasury'       => 'required',
            'address'        => 'required',
            'province_id'    => 'required|gt:0',
            'city_id'        => 'required|gt:0',
            'zip'            => 'required',
            'website'        => 'required',
            'cbu_name'       => 'required',
            'cbu_phone'       => 'required',
            'cbu_email'       => 'required|email|email',
            'clbu_name'       => 'required',
            'clbu_phone'        => 'required',
            'clbu_email'      => 'required|email|email',
            'attorney'        => 'required',
//            'email'          => 'required|unique:' . TableName(Insurer::class) . ',email|email',
        ], [
            'province_id.gt' => 'The State field is required.',
            'website' => 'The surety website field is required..',
            'city_id.gt'     => 'The City field is required.',
            'am_best_rating.gt'    => 'The Am Best Rating field is required.',
            'cbu_name'  =>  'The contract bond underwriter field is required.',
            'cbu_phone'  =>  'The phone field is required.',
            'cbu_email.required'  =>  'The email field is required.',
            'cbu_email.email'  =>  'The email field must be a valid email address..',
            'clbu_name'  =>  'The commercial bond underwriter field is required.',
            'clbu_phone'  =>  'The phone field is required.',
            'clbu_email.required'  =>  'The email field is required.',
            'clbu_email.email'  =>  'The email field must be a valid email address..',
            'attorney'  =>  'The Attorneys-in-Fact field is required.',
        ]);
        $data = [
            'name'      => $request['name'],
            'am_best_rating'     => $request['am_best_rating'],
            'treasury_list'     => $request['treasury'],
            'address'  => $request['address'],
            'state_id'        => $request['province_id'],
            'city_id'         => $request['city_id'],
            'zip'             => $request['zip'],
            'website'         => $request['website'],
            'cbu_name'         => $request['cbu_name'],
            'cbu_phone'         => $request['cbu_phone'],
            'cbu_email'         => $request['cbu_email'],
            'clbu_name'         => $request['clbu_name'],
            'clbu_phone'         => $request['clbu_phone'],
            'clbu_email'         => $request['clbu_email'],
            'attorney'         => $request['attorney'],
        ];

        Insurer::where('id',$request['id'])->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Insurer Updated Successfully!',
            'redirect'  =>  route('insurer.index'),
            'table' => 'insurers'
        ]);
    }
    public function view(Insurer $insurer)
    {
        return view('insurers.show', compact('insurer'));
    }

//    public function status(Request $request,$id, $status){
//        $customer = User::find($id);
//        $obj = $status == 'active' ? true : false;
//        if($customer){
//            $customer->update([
//                'status' => $obj,
//            ]);
//        }
//        if($status === false){
//            return response()->json([
//                'success' => TRUE,
//                'message' => 'Customer De-Activated Successfully',
//                'close_modal' =>  TRUE,
//                'table' => 'customers'],  200);
//        }
//        elseif($status === true){
//            return response()->json([
//                'success' => TRUE,
//                'message' => 'Customer Active Successfully',
//                'close_modal' =>  TRUE,
//                'table' => 'customers'],  200);
//        }else{
//            return response()->json([
//                'success' => TRUE,
//                'message' => 'Something Went Wrong',
//                'close_modal' =>  TRUE,
//                'table' => 'customers'],  200);
//        }
//    }
    public function delete(Request $request, $id)
    {
        Insurer::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => "Insurer Deleted Successfully!",
            'close_modal' => true,
            'table' => 'insurers'
        ]);
    }

}
