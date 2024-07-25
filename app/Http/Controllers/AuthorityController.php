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
        ],
        [

            'exp_date'  =>  'The expire date field is required.',
            'single_lim'  =>  'The single limit field is required.',
            'aggr_lim'  =>  'The aggregate limit field is required.',
            'minim_bid'  =>  'The minimum bid field is required.',
            'job_dur'  =>  'The job duration field is required.',
            'warranty_dur'  =>  'The warranty duration field is required.',

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
    public function show($id)
    {
        $authority_id = mws_encrypt('D',$id);
        $authority_value = Authority::from(TableName(Authority::class).' as at')
            ->join(TableName(Insurer::class).' as ins','at.insurer_id', '=' ,'ins.id')
            ->select(
                'at.*',
                'ins.name as insurer_name','ins.id as insurer_id'
            )
            ->where('at.id',$authority_id)
            ->first();
//        $insurers = Insurer::get();
        return view('authority.detail',compact('authority_value'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $authority_id = mws_encrypt('D',$id);
        $authority_value = Authority::from(TableName(Authority::class).' as at')
            ->join(TableName(Insurer::class).' as ins','at.insurer_id', '=' ,'ins.id')
            ->select(
                'at.*',
                'ins.name as insurer_name','ins.id as insurer_id'
            )
            ->where('at.id',$authority_id)
            ->first();
        $insurers = Insurer::get();
        return view('authority.edit',compact('authority_value','insurers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
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
        ],
            [

                'exp_date'  =>  'The expire date field is required.',
                'single_lim'  =>  'The single limit field is required.',
                'aggr_lim'  =>  'The aggregate limit field is required.',
                'minim_bid'  =>  'The minimum bid field is required.',
                'job_dur'  =>  'The job duration field is required.',
                'warranty_dur'  =>  'The warranty duration field is required.',

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
        Authority::where('id',$request['authority_id'])->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Authority Updated Successfully!',
            'close_modal' => true,
            'table' => 'authorities'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
