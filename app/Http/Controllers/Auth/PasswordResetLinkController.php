<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordForgot;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(Request $request): View
    {
        $status = $request->session()->get('status');
//        dd($status);
        return view('auth.forgot-password',compact('status'));
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'email' => 'required|email',
        ]);
        $verified_mail = User::where('email', $request['email'])->first();
        $answer = $verified_mail ? 'yes' : 'no';
        if($answer == 'yes'){

            $randomNumber = mt_rand(100000, 999999);
            Mail::to($request['email'])->send(new PasswordForgot(
                [
                    'name' => $verified_mail['name'],
                    'otp' => $randomNumber,
                ]
            ));
            $data = [
                'verification_code' => $randomNumber
            ];

            User::where('id',$verified_mail->id)->update($data);
            $email_value = $verified_mail['email'];
            $email = mws_encrypt('E',$email_value);

            return redirect()->route('password.verification')->with([
                'email' => $email
            ]);
//            return view('auth.verification');
        }
        else
        {
            $status = Password::sendResetLink(
                $request->only('email')
            );
            return redirect()->route('login')->with([
                'status'=> __($status)
            ]);
            return $status == Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
        }


        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
//        $status = Password::sendResetLink(
//            $request->only('email')
//        );
//
//        return $status == Password::RESET_LINK_SENT
//                    ? back()->with('status', __($status))
//                    : back()->withInput($request->only('email'))
//                            ->withErrors(['email' => __($status)]);
    }
}
