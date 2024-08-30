<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubContractor extends Model
{
    use HasFactory;
    protected $table='subcontractors';
    protected $fillable=[
        'bond_id',
        'name',
        'type',
        'bid_amount',
        'is_bonded',
        'status',
    ];
}
