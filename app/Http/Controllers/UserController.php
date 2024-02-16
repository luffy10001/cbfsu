<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use App\Rules\UserManagerRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public string $userModule = 'Users';

    public function index(UsersDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with('user', $user)->render('users.index');
    }

    public function create()
    {
        $roles = Role::select('id','name','department_id')->get();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:20|regex:/^[A-Za-z\s]+$/',
            'email' => 'required|unique:' . TableName(User::class) . ',email|email',
            'role' => 'required|gt:0',
            'password' => 'required|min:8|confirmed|max:20',
        ], [
            'role' => 'The role field is required',
        ]);
        $role = Role::select('id','department_id')->where('id',$request['role'])->first();
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'role_id' => $request['role'],
            'department_id' => $role->department_id,
            'password' => Hash::make($request['password']),
        ];
        User::create($data);
        return response()->json([
            'success' => true,
            'message' => 'User Created!',
            'close_modal' => true,
            'table' => 'users'
        ]);
    }

    public function edit(User $user)
    {
        $roles = Role::select('id','name','department_id')->get();
        return view('users.edit', compact('user','roles'));
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $request->validate([
            'name' => 'required|min:2|max:20|regex:/^[A-Za-z\s]+$/',
            'email' => ['required','email',Rule::unique(TableName(User::class))->ignore($user->id)],
            'role' => 'required|gt:0',
            'password' => 'nullable|min:8|confirmed|max:20',
        ], [
            'role' => 'The role field is required',
        ]);
        $role = Role::select('id','department_id')->where('id',$request['role'])->first();
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'role_id' => $request['role'],
            'department_id' => $role->department_id,
            'password' => Hash::make($request['password']),
        ];
        if (!empty($request['password'])) {
            $data['password'] = Hash::make($request['password']);
        }

        $user = User::where('id', $request['id'])->first();
        if ($user) {
            $user->update($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'User Updated Successfully!',
            'close_modal' => true,
            'table' => 'users'
        ]);
    }


    public function delete(Request $request, $userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
        }
        return response()->json([
            'success' => true,
            'message' => "User Deleted Successfully!",
            'close_modal' => true,
            'table' => 'users'
        ]);
    }
}
