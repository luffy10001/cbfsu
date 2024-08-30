<?php

namespace App\Http\Controllers;

use App\DataTables\BondDataTable;
use App\Models\Agent;
use App\Models\Bond;
use App\Models\Customer;
use App\Models\City;
use App\Models\Province;
use App\Models\SubContractor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class BondController extends Controller
{
    public string $userModule = 'bonds';

    public function index(BondDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with('user', $user)->render('bonds.index');
    }

    public function create()
    {

        $provinces = Province::select('id','name')->where('status',true)->orderBY('name')->get();
        $cities  = City::select('id','name')->where('status',true)->orderBY('name')->get();

        $route = 'bond.create';
        $user = Auth::user();
        $role = $user->role;

        $customer = Customer::where('user_id',$user->id)->first();

        // for edit
        $request = Request();
        $obj = '';
        if($request['id']) {
            $id = mws_encrypt('D', $request['id']);
            $obj = bond::where([
                'id' => $id,
            ])->first();
        }
        return view('bonds.create',compact('obj','route','role','user','customer',
            'provinces','cities'));
    }

    public function store(Request $request)
    {

        $bondObj = Bond::where('id', $request['bond_id'])->first();
        if($request['type']==1){  //=============  Customer General Information  ==========
            $request->validate([
                'customer_id'  => 'required|gt:0',
            ]);
            if($bondObj){
                return response()->json([
                    'success' => true,
                    'message' => 'Bond Details Updated Successfully!',
                ]);
            }else{
                $request->validate([
                    'customer_id'  => 'required|gt:0',
                ], [
                    'customer_id.gt'     => 'The Customer field is required.',
                ]);
                $general_data=[
                    'customer_id'=> $request['customer_id'],
                ];
                $obj = Bond::create($general_data);
                $route = route('bond.edit',['id' => mws_encrypt('E',$obj->id)]);
                return response()->json([
                    'success' => true,
                    'message' => 'Bond Details Updated Successfully!',
                    'redirect' => $route
                ]);
            }
        }elseif($request['type'] == 2){
            $request->validate([
                'owner_name'     => 'required',
                'owner_zip'      => 'required',
                'owner_address'  => 'required',
                'owner_bid_date' => 'required',
                'job_description'=> 'required',
                'job_location'   => 'required',
                'owner_state'    => 'required|gt:0',
                'owner_city'     => 'required|gt:0',
            ], [
                'owner_state.gt' => 'The owner state field is required.',
                'owner_city.gt'  => 'The owner city field is required.',
            ]);
            $project_data=[
                'owner_name'     => $request['owner_name'],
                'owner_zip'      => $request['owner_zip'],
                'owner_address'  => $request['owner_address'],
                'owner_bid_date' => $request['owner_bid_date'],
                'job_description'=> $request['job_description'],
                'job_location'   => $request['job_location'],
                'owner_state'    => $request['owner_state'],
                'owner_city'     => $request['owner_city'],
            ];
            $bondObj->update($project_data);
            return response()->json([
                'success' => true,
                'message' => 'Bond Details Updated Successfully!',
            ]);
        }elseif($request['type'] == 3){
//            $request->validate([
//                'bid_start_date'       => 'required',
//                'bid_completion_date'  => 'required',
//                'bid_amount'           => 'required',
//                'bid_project_cost'     => 'required',
//                'bid_amount_percentage'=> 'required',
//                'bid_warranty_period'  => 'required|gt:0',
//                'bid_damages'          => 'required|gt:0',
//            ]);
            $bid_data=[
                'bid_start_date'       => $request['bid_start_date'],
                'bid_completion_date'  => $request['bid_completion_date'],
                'bid_amount'           => $request['bid_amount'],
                'bid_project_cost'     => $request['bid_project_cost'],
                'bid_amount_percentage'=> $request['bid_amount_percentage'],
                'bid_warranty_period'  => $request['bid_warranty_period'],
                'bid_damages'          => $request['bid_damages'],
            ];
            $bondObj->update($bid_data);
            return response()->json([
                'success' => true,
                'message' => 'Bond Details Updated Successfully!',
            ]);
        }elseif($request['type'] == 4){
            $errors = [];
            if ($request['data']) {
                foreach ($request['data'] as $key => $row) {
                    if (empty($row['name'])) {
                        $errors['data_'.$key .'_name'] = ['Name is required'];
                    }
                    if (empty($row['type'])) {
                        $errors['data_'.$key.'_type'] = ['Type is required'];
                    }
                    if (empty($row['amount'])) {
                        $errors['data_'.$key.'_amount'] = ['Bid amount is required'];
                    }
                    if (empty($row['bonded'])) {
                        $errors['data_'.$key.'_bonded'] = ['is_bonded is required'];
                    }
                }
            }

//            if (count($errors) > 0) {
//                return response()->json([
//                   // 'message' => 'Validation error!',
////                     'errors' => $errors // errors appended from js
//                ], 422);
//            }
//            echo "<pre>";
//            print_r($request['data']);
//            exit;
            $pb_data=[
                'pb_contract_date'    => $request['pb_contract_date'],
                'pb_contract_amount'  => $request['pb_contract_amount'],
                'pb_estimated_profit' => $request['pb_estimated_profit'],
                'pb_start_date'       => $request['pb_start_date'],
                'pb_completion_date'  => $request['pb_completion_date'],
                'pb_warranty_period'  => $request['pb_warranty_period'],
                'pb_damages'          => $request['pb_damages'],
                'is_subcontracted'    => $request['is_subcontracted'],
            ];
            $bondObj->update($pb_data);

            $contractorIds=[];
            foreach($request['data'] as $contractor){
                $data=[
                    'bond_id'    => $bondObj->id,
                    'name'       => $contractor['name'],
                    'type'       => $contractor['type'],
                    'bid_amount' => $contractor['amount'],
                    'is_bonded'  => $contractor['bonded'] ?? false,
                ];
                $contractorObj = SubContractor::create($data);
                array_push($contractorIds,$contractorObj->id);
            }
            SubContractor::where('bond_id', $contractorObj->id)->whereNotIn('id', $contractorIds)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Bond Details Updated Successfully!',
            ]);
        }elseif($request['type'] == 5){
            $attachment ='get from form';
            $bondObj->update(['attachment'=>$attachment]);
            $route = route('bond.index');
            return response()->json([
                'success' => true,
                'message' => 'Bond Details Updated Successfully!',
                'redirect' => $route
            ]);
        }
    }

    public function view(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function status(Request $request,$id, $status){
        $customer = User::find($id);
        $obj = $status == 'active' ? true : false;
        if($customer){
            $customer->update([
                'status' => $obj,
            ]);
        }
        if($status === false){
            return response()->json([
                'success' => TRUE,
                'message' => 'Customer De-Activated Successfully',
                'close_modal' =>  TRUE,
                'table' => 'customers'],  200);
        }
        elseif($status === true){
            return response()->json([
                'success' => TRUE,
                'message' => 'Customer Active Successfully',
                'close_modal' =>  TRUE,
                'table' => 'customers'],  200);
        }else{
            return response()->json([
                'success' => TRUE,
                'message' => 'Something Went Wrong',
                'close_modal' =>  TRUE,
                'table' => 'customers'],  200);
        }
    }
    public function delete(Request $request, $id)
    {
        $customer = Customer::find($id);
        User::where('id',$customer->user_id)->delete();
        if ($customer) {
            $customer->delete();
        }
        return response()->json([
            'success' => true,
            'message' => "Customer Deleted Successfully!",
            'close_modal' => true,
            'table' => 'customers'
        ]);
    }

    public function append_subcontractor_form(Request $request){
        $itemNo = $request['itemCount'];
        return view('components.subcontractor',compact('itemNo'));
    }

}
