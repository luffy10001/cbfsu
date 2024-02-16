<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'department_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function permissions()
    {
        $permissions    =   self::from(TableName(User::class).' as u')
            ->join(TableName(Role::class)." as r",'r.id','=','u.role_id')
            ->join(TableName(Permission::class)." as p",'r.id','=','p.role_id')
            ->where('p.is_active',1)
            ->where('u.id',$this->id)
            ->where('p.role_id',$this->role_id)
            ->select('p.id as permissionId','p.route_name as routeName','p.role_id as roleId')
            ->get()->toArray();
        return $permissions;
    }
    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class,'role_id');
    }
}
