<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class ProjectManagement extends Model
{
    use HasFactory;
    protected $table = 'project_managements';
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'bid_date',
        'bid_amount',
        'gpm',
        'obligee_id',
        'obligee_address',
        'obligee_city',
        'obligee_state',
        'obligee_zip',
        'engineer_name',
        'project_name',
        'project_address',
        'project_city',
        'project_state',
        'project_zip',
        'project_delivery_method',
        'estimated_project_start_date',
        'estimated_project_completion_date',
        'warranty_terms',
        'liquidated_damages',
        'retainage_amount',
        'current_backlog',
    ];

    public function provinceName()
    {
        return $this->hasOne(Province::class, 'id', 'project_state');
    }
    public function cityName(){
        return $this->hasOne(City::class, 'id', 'project_city');
    }
}
