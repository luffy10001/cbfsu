<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'oblige_id',
        'name',
        'address',
        'city_id',
        'state_id',
        'zip',
        'bid_date',
        'bid_amount',
        'gpm',
        'delivery_method',
        'start_date',
        'completion_date',
        'warranty_terms',
        'damages',
        'retain_amount',
        'current_backlog',
        'oblige_address',
        'oblige_city',
        'oblige_state',
        'oblige_zip',
        'engineer_name',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'state_id');
    }
    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
}
