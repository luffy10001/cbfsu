<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurer extends Model
{
    use HasFactory;
    protected $table='insurers';
    protected $fillable=[
        'user_id', //for future use
        'city_id',
        'state_id',
        'underwriter_id',
        'name',
        'email',
        'address',
        'zip',
        'phone',
        'am_best_rating',
        'status',
    ];
    public function underwriter(){
        return $this->belongsTo(User::class,'underwriter_id');
    }
    public function state(){
        return $this->belongsTo(Province::class,'state_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
}