<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $fillable=[
        'route_name','role_id' ,'is_active'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
