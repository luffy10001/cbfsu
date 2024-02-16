<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cbo extends Model
{
    use HasFactory;
    protected $table='cbos';
    protected $fillable=['name','lot_no','community_id','province_id','city_id'];
}
