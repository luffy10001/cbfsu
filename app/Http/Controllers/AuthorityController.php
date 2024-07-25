<?php

namespace App\Http\Controllers;

use App\DataTables\AuthorityDataTable;
use App\Models\Authority;
use App\Models\Insurer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public string $userModule = 'Authority';
    public function index(AuthorityDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->render('authority.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $insurers = Insurer::get();
//        dd($insurers);
        return view('authority.create',compact('insurers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'insurer' => 'required',
            'start_date'  =>  'required',
            'exp_date'  =>  'required',
            'single_lim'  =>  'required',
            'aggr_lim'  =>  'required',
            'minim_bid'  =>  'required',
            'territory'  =>  'required',
            'job_dur'  =>  'required',
            'warranty_dur'  =>  'required',
            'payment_intervals'  =>  'required',
            'maintenance_limit'  =>  'required',
        ]);
        $data = [
            'insurer_id'=>$request['insurer'],
            'start_date'=>$request['start_date'],
            'expiry_date'=>$request['exp_date'],
            'single_job_limit'=>$request['single_lim'],
            'aggregate_limit'=>$request['aggr_lim'],
            'minimum_bid'=>$request['minim_bid'],
            'territory'=>$request['territory'],
            'territory_unit'=>$request['territ_unit'],
            'job_duration'=>$request['job_dur'],
            'job_duration_unit'=>$request['job_dur_unit'],
            'warranty_duration'=>$request['warranty_dur'],
            'warranty_duration_unit'=>$request['warranty_dur_unit'],
            'payment_interval'=>$request['payment_intervals'],
            'payment_interval_unit'=>$request['payment_intervals_unit'],
            'maintenance_limit'=>$request['maintenance_limit'],
            'maintenance_limit_unit'=>$request['maintenance_limit_unit'],


        ];
        Authority::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Authority Created Successfully!',
            'close_modal' => true,
            'table' => 'authorities'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
