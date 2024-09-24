<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class Bond extends Model
{
    use HasFactory;
    protected $table    = 'bonds';
    protected $fillable = [

//        'job_description',
//        'job_location',

        'customer_id',
        'name',
        'state_id',
        'city_id',
        'zip',
        'address',
        'delivery_method',
        'start_date',
        'completion_date',
        'warranty_terms',
        'damages',
        'retain_amount',
        'current_backlog',
        'gpm',
        'engineer_name',
        'owner_name',
        'owner_state',
        'owner_city',
        'owner_zip',
        'owner_address',
        'owner_bid_date',
//        'oblige_address',
//        'oblige_city',
//        'oblige_state',
//        'oblige_zip',
        'bid_start_date',
        'bid_completion_date',
        'bid_amount',
        'bid_project_cost',
        'bid_amount_percentage',
        'bid_warranty_period',
        'bid_damages',
        'pb_contract_date',
        'pb_contract_amount',
        'pb_estimated_profit',
        'pb_start_date',
        'pb_completion_date',
        'pb_warranty_period',
        'pb_damages',
        'is_subcontracted',
        'attachment',
        'status',
        'issue_doc',

    ];
    public function subcontractors(){
        return $this->hasMany(SubContractor::class,'bond_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function state(){
        return $this->belongsTo(Province::class,'state_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function states(){
        return $this->belongsTo(Province::class,'owner_state');
    }
    public function cities(){
        return $this->belongsTo(City::class,'owner_city');
    }

}
