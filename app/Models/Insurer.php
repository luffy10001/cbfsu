<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurer extends Model
{
    use HasFactory;
    protected $table='insurers';
    protected $fillable=[
        'city_id',
        'state_id',
        'underwriter_id',
        'name',
        'email',
        'address',
        'zip',
        'phone',
        'am_best_rating',
    ];
}