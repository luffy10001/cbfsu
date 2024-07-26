<?php

namespace App\Http\Controllers;

use App\DataTables\AgentDataTable;
use App\Models\Agent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AgentController extends Controller
{
    public string $userModule = 'Agents';

    public function index(AgentDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with('user', $user)->render('agents.index');
    }

    public function create()
    {
        return view('agents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'phone'    => 'required',
            'email'    => 'required|unique:' . TableName(User::class) . ',email|email',
            'password' => 'required|min:8|confirmed|max:20',
        ]);
        $role = Role::select('slug','id')->where('slug','agent')->first();
        $data = [
            'name'     => $request['name'],
            'email'    => $request['email'],
            'role_id'  => $role->id, 
            'password' => Hash::make($request['password']),
        ];
        $user = User::create($data);
        $agentData = [
            'user_id'=>$user->id,
            'phone'  =>$request['phone'],
        ];
        Agent::create($agentData);
        return response()->json([
            'success' => true,
            'message' => 'Agent Created!',
            'close_modal' => true,
            'table' => 'agents'
        ]);
    }

    public function edit(Agent $agent)
    {
        return view('agents.edit', compact('agent'));
    }
    public function update(Request $request)
    {
        $agent = Agent::where('id',$request->id)->first();
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => ['required','email',Rule::unique(TableName(User::class))->ignore($agent->user_id)],
            'password' => 'nullable|min:8|confirmed|max:20',
        ]);
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
        ];
        if (!empty($request['password'])) {
            $data['password'] = Hash::make($request['password']);
        }
        $user = User::where('id', $agent->user_id)->first();
        if ($user) {
            $user->update($data);
        }
        $agentData = [
            'phone' => $request['phone'],
        ];
        $agent->update($agentData);

        return response()->json([
            'success'     => true,
            'message'     => 'Agent Updated Successfully!',
            'close_modal' => true,
            'table'       => 'agents'
        ]);
    }
    public function view(Agent $agent)
    {
        return view('agents.show', compact('agent'));
    }


    public function delete(Request $request, $id)
    {
        $agent = Agent::find($id);
        User::where('id',$agent->user_id)->delete();
        if ($agent) {
            $agent->delete();
        }
        return response()->json([
            'success' => true,
            'message' => "Agent Deleted Successfully!",
            'close_modal' => true,
            'table' => 'agents'
        ]);
    }
    public function status(Request $request,$id, $status){
        $agent = User::find($id);
        $obj = $status == 'active' ? true : false;
        if($agent){
            $agent->update([
                'status' => $obj,
            ]);
        }
        if($status == 0){
            return response()->json([
                'success' => TRUE,
                'message' => 'Agent De-Activated Successfully',
                'close_modal' =>  TRUE,
                'table' => 'agents'],  200);
        }
        elseif($status == 1){
            return response()->json([
                'success' => TRUE,
                'message' => 'Agent Active Successfully',
                'close_modal' =>  TRUE,
                'table' => 'agents'],  200);
        }else{
            return response()->json([
                'success' => TRUE,
                'message' => 'Something Went Wrong',
                'close_modal' =>  TRUE,
                'table' => 'agents'],  200);
        }
    }
}
