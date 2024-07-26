<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use GPBMetadata\Google\Api\Auth;
use Illuminate\Http\Request;

class PasswordVerification extends Controller
{
    Public function create(Request $request)
    {
        $email = $request->session()->get('email');
        if ($email === null) {
            $status= 'Session expired or invalid request.';
            return redirect()->route('password.request')->with(
                ['status'=>$status]
            );
        }
        $u_email = mws_encrypt('D',$email);
        $request->session()->flash('u_email', $u_email);
        return view('auth.verification',compact('u_email'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
            'email' =>  'required|email'
        ]);

        $user_value =User::where('email',$request['email'])->where('verification_code',$request['verification_code'])->first();
        $answer = $user_value ? 'yes': 'no';
        if($answer == 'yes'){
            $email_value = $request['email'];
            $email = mws_encrypt('E',$email_value);

            $request['email'];
            return redirect()->route('new-password')->with(
                [ 'email' => $email]
            );
        }else{

            $email_value = $request['email'];
            $email = mws_encrypt('E',$email_value);
            return redirect()->route('password.verification')->with([
                'email' => $email,
                'status' => 'Invalid Verification Code'
            ]);

//            return redirect()->back()->withErrors(['verification_error' => 'Invalid email or verification code. Please try again.'])->withInput($request->only('email'));

        }

    }
}
//$status = $request->session()->get('status');
//dd($status);
//return redirect()->route('password.verification')->with(
//    ['status'=>$status]
//);
