<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $table   ="agents";
    protected $fillable= [
      'user_id',
      'phone',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
