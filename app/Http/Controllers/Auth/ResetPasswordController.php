<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function create(Request $request)
    {
        $email = $request->session()->get('email');
        $u_email = mws_encrypt('D',$email);
        if ($u_email == "") {
            $status = 'Session is Expired.';
            return redirect()->route('password.request')->with([
                'status' => $status
            ]);
        }
        $request->session()->flash('u_email', $u_email);

        return view('auth.reset-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
            'conf_password' => 'required|string|min:8|same:password',
        ], [
            'conf_password.same' => 'The confirmation password does not match.'
        ]);
        $u_email = $request->session()->get('u_email');

        $password =Hash::make($request['password']);
        $data = [
                'password' => $password
            ];
        User::where('email',$u_email)->update($data);

        return redirect()->route('login');
    }
}
