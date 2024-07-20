<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable=[
        'user_id',//
        'agent_id',
        'state_id',
        'city_id',
        'positions',//
        'contact_name', //
        'zip',//
        'phone',//
        'signed_in',//
        'address'//
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function agent(){
        return $this->belongsTo(Agent::class,'agent_id');
    }
    public function state(){
        return $this->belongsTo(Province::class,'state_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
}
