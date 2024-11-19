<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerDataTable;
use App\Mail\CustomerMail;
use App\Mail\PasswordForgot;
use App\Models\Agent;
use App\Models\Authority;
use App\Models\City;
use App\Models\Insurer;
use App\Models\Province;
use App\Models\Questions;
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
            'corporation_type'      => 'required|gt:0',
            'name'                  => 'required',
            'primary_contact'       => 'required',
            'phone'                 => 'required',
            'email'                 => 'required|unique:' . TableName(User::class) . ',email|email',
            'average_size'          => 'required',
            'largest_size'          => 'required',
            'backlog'               => 'required',
            'province_id'           => 'required|gt:0',
            'city_id'               => 'required|gt:0',
            'zip'                   => 'required',
            'address'               => 'required',
            'password'              => 'required|min:8|confirmed|max:20',
            'insurer'               => 'required|gt:0',
            'start_date'            => 'required',
            'exp_date'              => 'required',
            'territory'             => 'required|gt:0',
            'single_limt'            => 'required|',
            'aggr_limt'              => 'required',
            'design_build'          => 'required',
            'job_dur'               => 'required',
            'warranty_dur'          => 'required',
            'hazmat'                => 'required',
            'minim_bid'             => 'required',
            'questions.0'           => 'required',
            'questions.*'           => 'required',



        ], [
            'corporation_type' => 'The corporation type field is required.',
            'name'           => 'The Positions field is required.',
            'positions.gt'   => 'The Positions field is required.',
            'province_id.gt' => 'The State field is required.',
            'city_id.gt'     => 'The Headquarter field is required.',
            'agent_id.gt'    => 'The Agent field is required.',
            'insurer'        => 'The surety name field is required.',
            'start_date'     => 'The effective date field is required.',
            'exp_date'       => 'The expiration date field is required.',
            'single_limt'     => 'The single project limit field is required.',
            'aggr_limt'       => 'The aggregate limit field is required.',
            'job_dur'        => 'The job duration field is required.',
            'warranty_dur'   => 'The warranty period field is required.',
            'minim_bid'      => 'The bid spread field is required.',
            'territory'      => 'The territory field is required.',


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
            'user_id'             => $user->id,
            'signed_in'           => Carbon::now(),
            'corporation_type'    => $request['corporation_type'],
            'primary_contact'     => $request['primary_contact'],
            'phone'               => $request['phone'],
            'average_size'        => $request['average_size'],
            'largest_size'        => $request['largest_size'],
            'backlog'             => $request['backlog'],
            'state_id'            => $request['province_id'],
            'city_id'             => $request['city_id'],
            'zip'                 => $request['zip'],
            'address'             => $request['address'],
        ];
        $customer = Customer::create($customerData);
        $authority_data = [
            'customer_id'      =>   $customer->id,
            'insurer_id'       =>    $request['insurer'],
            'start_date'       =>    $request['start_date'],
            'expiry_date'      =>    $request['exp_date'],
            'territory'        =>    $request['territory'],
            'single_job_limit' =>    $request['single_limt'],
            'aggregate_limit'  =>    $request['aggr_limt'],
            'design_build'     =>    $request['design_build'],
            'job_duration'     =>    $request['job_dur'],
            'job_duration_unit'      =>    1,
            'warranty_duration'      =>    $request['warranty_dur'],
            'warranty_duration_unit' =>    1,
            'hazmat'           =>    $request['hazmat'],
            'minimum_bid'      =>    $request['minim_bid'],
        ];
        Authority::create($authority_data);

        foreach ($request['questions'] as $question) {
            $question_data  =   [
                'customer_id'       => $customer->id,
                'question'         => $question,
            ];
            Questions::create($question_data);
        }

//        $baseUrl = config('app.url');
//        Mail::to($request['email'])->send(new CustomerMail(
//            [
//                'name'     => $request['name'],
//                'email'    => $request['email'],
//                'password' => $request['password'],
//                'website_link'    => $baseUrl,
//            ]
//        ));

        return response()->json([
            'success' => true,
            'message' => 'Customer Created Successfully!',
//            'close_modal' => true,
            'redirect'  => route('customer.index'),
            'table' => 'customers'
        ]);
    }

    public function edit(Customer $customer,$id)
    {
        $d_id   =   mws_encrypt('D',$id);

        $customer = Customer::from(TableName(Customer::class).' as customers')
            ->leftJoin(TableName(User::class).' as user','customers.user_id','=','user.id')
            ->select('customers.*')
            ->where('customers.id',$d_id)->first();
        $authority  =   Authority::where('customer_id',$customer->id)->first();
        $provinces = Province::select('id','name')->where('status',true)->orderBY('name')->get();
        $cities = City::select('id', 'name')
            ->where('status', true)
            ->where('province_id', $customer->state_id)
            ->orderBy('name')
            ->get();
        $insurers = Insurer::get();
        $questions   =   Questions::where('customer_id',$customer->id)->get();
        $route = 'customer.index';
        return view('customers.edit', compact('customer','customer','provinces','insurers','route','cities','authority','questions'));
    }
    public function update(Request $request)
    {


        $request->validate([
            'corporation_type'      => 'required|gt:0',
            'name'                  => 'required',
            'primary_contact'       => 'required',
            'phone'                 => 'required',
            'email'                 => [
                'required',
                'email',
                Rule::unique(TableName(User::class), 'email')->ignore($request['user_id']),
            ],
            'average_size'          => 'required',
            'largest_size'          => 'required',
            'backlog'               => 'required',
            'province_id'           => 'required|gt:0',
            'city_id'               => 'required|gt:0',
            'zip'                   => 'required',
            'address'               => 'required',
//            'password'              => 'required|min:8|confirmed|max:20',
            'insurer'               => 'required|gt:0',
            'start_date'            => 'required',
            'exp_date'              => 'required',
            'territory'             => 'required|gt:0',
            'single_limt'           => 'required|',
            'aggr_limt'             => 'required',
            'design_build'          => 'required',
            'job_dur'               => 'required',
            'warranty_dur'          => 'required',
            'hazmat'                => 'required',
            'minim_bid'             => 'required',
//            'questions.0'              => 'required',
            'questions.*'              => 'required',


        ], [
            'corporation_type' => 'The corporation type field is required.',
            'name'           => 'The Positions field is required.',
            'positions.gt'   => 'The Positions field is required.',
            'province_id.gt' => 'The State field is required.',
            'city_id.gt'     => 'The Headquarter field is required.',
            'agent_id.gt'    => 'The Agent field is required.',
            'insurer'        => 'The surety name field is required.',
            'start_date'     => 'The effective date field is required.',
            'exp_date'       => 'The expiration date field is required.',
            'single_limt'     => 'The single project limit field is required.',
            'aggr_limt'       => 'The aggregate limit field is required.',
            'job_dur'        => 'The job duration field is required.',
            'warranty_dur'   => 'The warranty period field is required.',
            'minim_bid'      => 'The bid spread field is required.',
            'territory'      => 'The territory field is required.',


        ]);

        $role = Role::select('slug','id')->where('slug','customer')->first();
        $data = [
            'name'     => $request['name'],
            'email'    => $request['email'],
            'role_id'  => $role->id,
            'password' => Hash::make($request['password']),

        ];
        $user = User::where('id',$request['user_id'])->update($data);

        $customerData = [
//            'user_id'             => $request['user_id'],
            'signed_in'           => Carbon::now(),
            'corporation_type'    => $request['corporation_type'],
            'primary_contact'     => $request['primary_contact'],
            'phone'               => $request['phone'],
            'average_size'        => $request['average_size'],
            'largest_size'        => $request['largest_size'],
            'backlog'             => $request['backlog'],
            'state_id'            => $request['province_id'],
            'city_id'             => $request['city_id'],
            'zip'                 => $request['zip'],
            'address'             => $request['address'],
        ];
        $customer = Customer::where('id',$request['cust_id'])->update($customerData);

        $authority_data = [
            'customer_id'      =>    $request['cust_id'],
            'insurer_id'       =>    $request['insurer'],
            'start_date'       =>    $request['start_date'],
            'expiry_date'      =>    $request['exp_date'],
            'territory'        =>    $request['territory'],
            'single_job_limit' =>    $request['single_limt'],
            'aggregate_limit'  =>    $request['aggr_limt'],
            'design_build'     =>    $request['design_build'],
            'job_duration'     =>    $request['job_dur'],
            'job_duration_unit'      =>    1,
            'warranty_duration'      =>    $request['warranty_dur'],
            'warranty_duration_unit' =>    1,
            'hazmat'           =>    $request['hazmat'],
            'minimum_bid'      =>    $request['minim_bid'],
        ];
        Authority::where('id',$request['authority_id'])->update($authority_data);

        // Get all existing questions for the customer
        $existing_questions = Questions::where('customer_id', $request['cust_id'])->get();

// Extract existing question IDs from the database
        $existing_question_ids = $existing_questions->pluck('id')->toArray();

// Initialize an array to hold the question IDs from the request
        $request_question_ids = [];

        foreach ($request['questions'] as $key => $question_text) {
            // Prepare the question data to be saved
            $question_data = [
                'customer_id' => $request['cust_id'],  // Customer ID
                'question'    => $question_text,  // Question text from the form
            ];

            // Check if question_id exists for the current question
            if (isset($request['question_id'][$key]) && !empty($request['question_id'][$key])) {
                // If a question_id exists, update the existing record
                $question_id = $request['question_id'][$key];
                Questions::updateOrCreate(
                    ['id' => $question_id],  // Use the question_id to find the record
                    $question_data  // Update the record with the new data
                );

                // Add this question_id to the request array for deletion check
                $request_question_ids[] = $question_id;
            } else {
                // If question_id does not exist, create a new record
                Questions::create($question_data);  // Create a new record with the question data
            }
        }

// Find the question IDs that need to be deleted (those in the database but not in the request)
        $questions_to_delete = array_diff($existing_question_ids, $request_question_ids);

// Delete the records that are no longer in the request data
        if (!empty($questions_to_delete)) {
            Questions::whereIn('id', $questions_to_delete)->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Customer Updated Successfully!',
//            'close_modal' => true,
            'redirect'  => route('customer.index'),
            'table' => 'customers'
        ]);

    }
    public function view($id)
    {
        $d_id   =   mws_encrypt('D',$id);
        $customer = Customer::where('id',$d_id)->first();
        return view('customers.show', compact('customer'));
//        return view('customers.show', compact('customer'));
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
//        echo "<pre>";
//        print_r($customer->authority->surerty->name);
//        exit;
        return view('customers.profile', compact('customer'));
//        return view('customers.profile1', compact('customer'));
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
