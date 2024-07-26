<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    use HasFactory;
    protected $table = 'authorities';
    protected $fillable = [
        'insurer_id',
        'start_date',
        'expiry_date',
        'single_job_limit',
        'aggregate_limit',
        'territory',
        'territory_unit',
        'job_duration',
        'job_duration_unit',
        'warranty_duration',
        'warranty_duration_unit',
        'payment_interval',
        'payment_interval_unit',
        'minimum_bid',
        'maintenance_limit',
        'maintenance_limit_unit',
    ];
}
