<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $fillable = [
        'user_id',
        'sent_by_user_id',
        'message',
        'refrence_id',
        'modal_name',
        'message_type',
        'is_read',
        'page_route_name',
        'action_route',
        'is_modal'
    ];
    public function assigned_to(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function assigned_by(){
        return $this->belongsTo(User::class, 'sent_by_user_id');
    }
}
