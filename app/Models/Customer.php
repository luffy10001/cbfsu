<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable=[
        'user_id',
        'agent_id',
        'state_id',
        'city_id',
        'positions',
        'contact_name',
        'zip',
        'phone',
        'signed_in',
        'address',
        'corporation_type',
        'primary_contact',
        'average_size',
        'largest_size',
        'backlog',
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
    public function surerty(){
        return $this->hasOne(Insurer::class,'user_id');
    }
    public function authority(){
        return $this->hasOne(Authority::class,'customer_id');
    }
    public function questions(){
        return $this->hasMany(Questions::class,'customer_id');
    }
}
