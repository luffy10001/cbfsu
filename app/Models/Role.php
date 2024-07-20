<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table='roles';
    protected $fillable=[
        'name', 'parent_id', 'slug'
    ];
    public function permissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Permission::class,'role_id','id');
    }
}
