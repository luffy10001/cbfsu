<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user()->role;
        if($user->slug=='super-admin'){
            return view('dashboard');
        }elseif($user->slug == 'customer'){
            return redirect()->route('customer.profile');
        }else{
            return view('dashboard');
        }
    }
}

