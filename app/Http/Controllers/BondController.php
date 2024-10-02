<?php

namespace App\Http\Controllers;

use App\Classes\Notification;
use App\DataTables\BondDataTable;
use App\Models\Agent;
use App\Models\Authority;
use App\Models\Bond;
use App\Models\Customer;
use App\Models\City;
use App\Models\Province;
use App\Models\SubContractor;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneralMail;

class BondController extends Controller
{
    public string $userModule = 'bonds';
    use FileUploadTrait;

    public function index(BondDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with('user', $user)->render('bonds.index',compact('user'));
    }

    public function create()
    {

        $provinces = Province::select('id','name')->where('status',true)->orderBY('name')->get();
        $cities  = City::select('id','name')->where('status',true)->orderBY('name')->get();

        $route = 'bond.create';


        $user = Auth::user();
        $role = $user->role;
        if(isRoleCustomer($role)){
            $customer = Customer::where('user_id',$user->id)->first();
        }



        // for edit
        $request = Request();
        $obj = '';
        if($request['id']) {
            $id = mws_encrypt('D', $request['id']);
            $obj = bond::where([
                'id' => $id,
            ])->first();
            $customer = $obj->customer;
            $user = $obj->customer->user;
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
                    'customer_id' => $request['customer_id'],
                    'status'      => false,
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
                'project_name'   => 'required',
                'province_id'    => 'required|gt:0',
                'city_id'        => 'required',
                'project_zip'    => 'required',
                'project_address'=> 'required',
                'project_delivery_method'     => 'required',
                'est_pro_start'         => 'required',
                'est_pro_compl'         => 'required',
                'warranty_term'         => 'required',
                'liquidated_damages'    => 'required',
                'retainage_amount'      => 'required',
                'current_backlog'       => 'required',
//                'gpm'            => 'required',
                'engineer_name'  => 'required',
                'owner_name'     => 'required',
                'owner_zip'      => 'required',
                'owner_address'  => 'required',
//                'owner_bid_date' => 'required',
//                'job_description'=> 'required',
//                'job_location'   => 'required',
                'owner_state'    => 'required|gt:0',
                'owner_city'     => 'required|gt:0',
            ], [
                'province_id'    => 'The project state field is required.',
                'city_id'        => 'The project city field is required.',
                'est_pro_start'  => 'The estimate project start date city field is required.',
                'est_pro_compl'  => 'The estimate project completion date field is required.',
                'owner_state'    => 'The owner state field is required.',
                'owner_city'     => 'The owner city field is required.',
            ]);
            $project_data=[

                'name'     => $request['project_name'],
                'state_id'     => $request['province_id'],
                'city_id'     => $request['city_id'],
                'zip'     => $request['project_zip'],
                'address'     => $request['project_address'],
                'delivery_method'     => $request['project_delivery_method'],
                'start_date'     => $request['est_pro_start'],
                'completion_date'     => $request['est_pro_compl'],
                'warranty_terms'     => $request['warranty_term'],
                'damages'     => $request['liquidated_damages'],
                'retain_amount'     => $request['retainage_amount'],
                'current_backlog'     => $request['current_backlog'],
                'engineer_name'     => $request['engineer_name'],
                'owner_name'     => $request['owner_name'],
                'owner_zip'      => $request['owner_zip'],
                'owner_address'  => $request['owner_address'],
                'owner_bid_date' => $request['owner_bid_date'],
                'job_description'=> $request['job_description'],
                'job_location'   => $request['job_location'],
                'owner_state'    => $request['owner_state'],
                'owner_city'     => $request['owner_city'],
            ];
            $general_data=[
                'customer_id' => $request['customer_id'],
                'status'      => false,
            ];
            if(!$bondObj){
                $bondObj = Bond::create($general_data);
            }

            dd($project_data);
            $bondObj->update($project_data);
            return response()->json([
                'success' => true,
                'message' => 'Bond Details Updated Successfully!',
            ]);
        }elseif($request['type'] == 3){
            $bid_data=[
                'owner_bid_date'       => $request['owner_bid_date'],
                'bid_start_date'       => $request['bid_start_date'],
                'bid_completion_date'  => $request['bid_completion_date'],
                'bid_amount'           => $request['bid_amount'],
                'bid_project_cost'     => $request['bid_project_cost'],
                'bid_amount_percentage'=> $request['bid_amount_percentage'],
                'gpm'     => $request['gpm'],
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
            $pb_data = [
                'pb_contract_date'    => $request->input('pb_contract_date'),
                'pb_contract_amount'  => $request->input('pb_contract_amount'),
                'pb_estimated_profit' => $request->input('pb_estimated_profit'),
                'pb_start_date'       => $request->input('pb_start_date'),
                'pb_completion_date'  => $request->input('pb_completion_date'),
                'pb_warranty_period'  => $request->input('pb_warranty_period'),
                'pb_damages'          => $request->input('pb_damages'),
                'is_subcontracted'    => $request->input('is_subcontracted'),
            ];

            $bondObj->update($pb_data);

            $contractorIds = [];
            if (isset($request['data']) && is_array($request['data'])) {
                foreach ($request['data'] as $contractor) {
                    $data = [
                        'bond_id'    => $bondObj->id,
                        'name'       => $contractor['name'],
                        'type'       => $contractor['type'],
                        'bid_amount' => $contractor['amount'],
                        'is_bonded'  => isset($contractor['bonded']) ? $contractor['bonded'] : false,
                    ];
                    $contractorObj = SubContractor::create($data);
                    $contractorIds[] = $contractorObj->id;
                }
            }

// Delete any subcontractors not in the current request's list
            SubContractor::where('bond_id', $bondObj->id)
                ->whereNotIn('id', $contractorIds)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bond Details Updated Successfully!',
            ]);

        }elseif($request['type'] == 5){
            $request->validate([
                'attachment'=>'required',
            ]);
            if($request->has('attachment') && gettype($request->attachment)=="object")
            {
                $fileUploadResponse = $this->uploadFile($request->file('attachment'), 'images/bonds/');
                if (isset($fileUploadResponse['success']) && $fileUploadResponse['success'] == TRUE )
                {
                    $data['attachment'] = $fileUploadResponse['filename'];
                    $data['status'] = true;
                    $bondObj->update($data);
                }
            }
            $authority   =   Authority::where('customer_id', $bondObj->customer_id)->first();
            $customer   =   Customer::where('id', $bondObj->customer_id)->first();
            if( $request['bid_value'] > $authority->single_job_limit  ){
             $mail_data =
                    [
                    'subject'       => $customer->user->name." Bid Amount is Exceeded from Single Project Limit",
                    'name'          => $customer->user->name,
                    'email'         => $customer->user->email,
                    'phone'         => $customer->phone,
                    'bid_amount'    => $request['bid_value'],
                    'project_limit' => $authority->single_job_limit,
                    ];
            Mail::to('jasim.khan2007@gmail.com')->send(new GeneralMail($mail_data,'bondLimitExceededToAdmin'));
            $mail_data['subject'] =  "Your Bid Amount is Exceeded from Single Project Limit";
            Mail::to($customer->user->email)->send(new GeneralMail($mail_data,'bondLimitExceededToCustomer'));
            }


            // Notifications to Admin
            $message = config('messages.messages.bond_request');
            $user    = Auth::user();
            $sent_by_user_id  = $user->id;
            $find_array = ['{name}'];
            $rep_array  = [$user->name];
            $message    = str_replace($find_array, $rep_array, $message);
            $notifiableUser = toAdmin();
            $reference_id   = $bondObj->id;
            $modal_name     = Bond::class;
            $message_type = '';
            $page_route_name = '/bonds';
            $action_route = '';
            $is_modal = '0';
            $notification = new Notification;
            $notification->sendNotification($notifiableUser, $sent_by_user_id, $message, $reference_id, $modal_name, $message_type, $page_route_name, $action_route, $is_modal);


            dd('wefef');
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
         Bond::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => "Bonds Deleted Successfully!",
            'close_modal' => true,
            'table' => 'bonds'
        ]);
    }

    public function append_subcontractor_form(Request $request){
        $itemNo     = $request['itemCount'];
        $contractor = false;
        return view('components.subcontractor',compact('itemNo','contractor'));
    }

    public function viewBidBondPdf($id){

        $id      =   mws_encrypt('D',$id);
        $bond_data   =   Bond::where('id',$id)->first();

        $pdf = Pdf::loadView('bonds.bid_bond_pdf', compact('bond_data'));
        return $pdf->stream();
    }

    public function viewAttorneyPdf($id)
    {
        $id          =   mws_encrypt('D',$id);
        $bond_data   =   Bond::where('id',$id)->first();
        $pdf         = Pdf::loadView('bonds.power_of_attorney_pdf',compact('bond_data'));
        return $pdf->stream();
    }

    public function viewPerformancePaymentPdf($id)
    {
        $id         =   mws_encrypt('D',$id);
        $bond_data  =   Bond::where('id',$id)->first();
        $pdf        = Pdf::loadView('bonds.payment_and_performance',compact('bond_data'));
        return $pdf->stream();
    }

    public function IssueDocuments($id){
       $d_id    =    mws_encrypt('D',$id);
       $bond    = Bond::where('id',$d_id)->first();
       $bond->update(['issue_doc'=>true]);

       // Notifications to Customer
        $message = config('messages.messages.issue_documents');
        $user    = Auth::user();
        $sent_by_user_id  = $user->id;
        $find_array = ['{name}'];
        $rep_array  = [$user->name];
        $message    = str_replace($find_array, $rep_array, $message);
        $notifiableUser = $bond->customer->user;
        $reference_id   = $d_id;
        $modal_name     = Bond::class;
        $message_type = '';
        $page_route_name = '/bonds';
        $action_route = '';
        $is_modal = '0';
        $notification = new Notification;
        $notification->sendNotification($notifiableUser, $sent_by_user_id, $message, $reference_id, $modal_name, $message_type, $page_route_name, $action_route, $is_modal);

        return response()->json([
            'success' =>true,
            'message' =>'Documents Issued Successfully!',
            'table'   =>'bonds'
        ]);
    }
    public function convertToPerformance($id){
        $d_id    =    mws_encrypt('D',$id);
        $bond    =    Bond::where('id',$d_id)->first();
        return view('bonds.convert_to_performance',compact('d_id','bond'));
    }
    public function storeConvertToPerformance(Request $request)
    {
        $bond    =    Bond::where('id',$request['id'])->first();

        $request->validate([
            'contract_detail'   => 'required',
            'contract_date'     => 'required',
            'contract_amount'   => 'required',
            'description'       => 'required',
            'bond_detail'       => 'required',
            'date'              => 'required',
            'amount'            => 'required',
            'contract_document' => $bond && $bond->perf_contract_document ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048' : 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('contract_document')) {
            $fileUploadResponse = $this->uploadFile($request->file('contract_document'), 'images/bonds/');
            if (isset($fileUploadResponse['success']) && $fileUploadResponse['success'] == true) {
                $data['perf_contract_document'] = $fileUploadResponse['filename'];
                Bond::where('id', $request['id'])->update($data);
            }
        }

        $data = [
            'perf_contract_detail'   => $request['contract_detail'],
            'perf_contract_date'     => $request['contract_date'],
            'perf_contract_amount'   => $request['contract_amount'],
            'perf_description'       => $request['description'],
            'perf_bond_detail'       => $request['bond_detail'],
            'perf_date'              => $request['date'],
            'perf_amount'            => $request['amount'],
        ];

        Bond::where('id', $request['id'])->update($data);

        $authority   =   Authority::where('customer_id', $bond->customer_id)->first();
        $customer   =   Customer::where('id', $bond->customer_id)->first();

        $mail_data =
            [
                'subject'       => $customer->user->name." Bid Amount is Exceeded from Single Project Limit",
                'name'          => $customer->user->name,
                'email'         => $customer->user->email,
                'phone'         => $customer->phone,
                'bid_amount'    => $request['bid_value'],
                'project_limit' => $authority->single_job_limit,
            ];
        $mail_data['subject'] =  "Approval Required for Document Conversion";
        Mail::to('recipient2@example.com')->send(new GeneralMail($mail_data,'convert_into_performance'));
        return response()->json([
            'success' => true,
            'message' => 'Converted In To Performance Successfully!',
            'close_modal' => true,
            'table' => 'bonds'
        ]);
    }

}
