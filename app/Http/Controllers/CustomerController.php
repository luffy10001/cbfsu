<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerDataTable;
use App\Mail\CustomerMail;
use App\Mail\PasswordForgot;
use App\Models\Agent;
use App\Models\City;
use App\Models\Insurer;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public string $userModule = 'customers';

    public function index(CustomerDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with('user', $user)->render('customers.index');
    }

    public function create()
    {
        $agents = Agent::from(TableName(Agent::class).' as agent')
            ->leftJoin(TableName(User::class).' as user','agent.user_id','=','user.id')
            ->select('agent.id as id','user.name as name')
        ->where([ 'user.status' => true ])->get();
        $provinces = Province::select('id','name')->where('status',true)->orderBY('name')->get();
        $insurers = Insurer::get();
        $route = 'customer.index';
        return view('customers.create',compact('agents','provinces','insurers','route'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required',
            'contact_name' => 'required',
            'phone'        => 'required',
            'zip'          => 'required',
            'email'        => 'required|unique:' . TableName(User::class) . ',email|email',
            'password'     => 'required|min:8|confirmed|max:20',
            'address'      => 'required',
            'positions'    => 'required|gt:0',
            'province_id'  => 'required|gt:0',
            'city_id'      => 'required|gt:0',
            'agent_id'     => 'required|gt:0',
        ], [
            'positions.gt'   => 'The Positions field is required.',
            'province_id.gt' => 'The State field is required.',
            'city_id.gt'     => 'The Headquarter field is required.',
            'agent_id.gt'    => 'The Agent field is required.',
        ]);
        $role = Role::select('slug','id')->where('slug','customer')->first();
        $data = [
            'name'     => $request['name'],
            'email'    => $request['email'],
            'role_id'  => $role->id,
            'password' => Hash::make($request['password']),

        ];
        $user = User::create($data);
        $customerData = [
            'user_id'   => $user->id,
            'signed_in' => Carbon::now(),
            'phone'     => $request['phone'],
            'agent_id'  => $request['agent_id'],
            'state_id'  => $request['province_id'],
            'city_id'   => $request['city_id'],
            'positions' => $request['positions'],
            'contact_name' => $request['contact_name'],
            'zip'          => $request['zip'],
            'address'      => $request['address'],
        ];
        $baseUrl = config('app.url');
        Customer::create($customerData);
        Mail::to($request['email'])->send(new CustomerMail(
            [
                'name'     => $request['name'],
                'email'    => $request['email'],
                'password' => $request['password'],
                'website_link'    => $baseUrl,
            ]
        ));

        return response()->json([
            'success' => true,
            'message' => 'Customer Created Successfully!',
            'close_modal' => true,
            'table' => 'customers'
        ]);
    }

    public function edit(Customer $customer)
    {
        $agents = Agent::from(TableName(Agent::class).' as agent')
            ->leftJoin(TableName(User::class).' as user','agent.user_id','=','user.id')
            ->select('agent.id as id','user.name as name')
            ->where([ 'user.status' => true ])->get();
        $provinces = Province::select('id','name')->where('status',true)->orderBY('name')->get();
        $cities = City::select('id','name')->where('status',true)->orderBY('name')->get();
        return view('customers.edit', compact('customer','agents','provinces','cities'));
    }
    public function update(Request $request)
    {
        $customer = Customer::select('id','user_id')->where('id',$request->id)->first();
        $request->validate([
            'name'         => 'required',
            'contact_name' => 'required',
            'phone'        => 'required',
            'zip'          => 'required',
            'email'        => ['required','email',Rule::unique(TableName(User::class))->ignore($customer->user_id)],
            'password'     => 'nullable|min:8|confirmed|max:20',
            'address'      => 'required',
            'positions'    => 'required|gt:0',
            'province_id'  => 'required|gt:0',
            'city_id'      => 'required|gt:0',
            'agent_id'     => 'required|gt:0',
        ], [
            'positions.gt'   => 'The Positions field is required.',
            'province_id.gt' => 'The State field is required.',
            'city_id.gt'     => 'The Headquarter field is required.',
            'agent_id.gt'    => 'The Agent field is required.',
        ]);

        $data = [
            'name'     => $request['name'],
            'email'    => $request['email'],
        ];
        if (!empty($request['password'])) {
            $data['password'] = Hash::make($request['password']);
        }
        User::where('id', $customer->user_id)->update($data);
        $customerData = [
            'user_id'   => $customer->user_id,
            //'signed_in' => Carbon::now(),
            'phone'     => $request['phone'],
            'agent_id'  => $request['agent_id'],
            'state_id'  => $request['province_id'],
            'city_id'   => $request['city_id'],
            'positions' => $request['positions'],
            'contact_name' => $request['contact_name'],
            'zip'          => $request['zip'],
            'address'      => $request['address'],
        ];
        $customer->update($customerData);

        return response()->json([
            'success' => true,
            'message' => 'Customer Updated Successfully!',
            'close_modal' => true,
            'table' => 'customers'
        ]);
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

    public function profile()
    {
        $userId = Auth::user()->id;
        $customer = Customer::where('user_id',$userId)->first();
        return view('customers.profile', compact('customer'));
    }


    public function surety_details(Request $request){
        $surety_id = $request['surety_id'];
        if($surety_id>0){
            $insurer = Insurer::where('id', $surety_id)->first();
            return view('components.surety-form', compact('insurer'));
        }

    }
    public function landPageDetail()
    {
        return view('cust_land_page');
    }

}
