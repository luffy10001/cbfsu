<?php

use App\Models\User;
use App\Models\Role;
use App\Models\UserArea;

if (function_exists('isNotifyableUsers')){
    function isNotifyableUsers()
    {
        // $data = UserArea::join('user', 'user.id', '=', 'user_areas.user_id')
        // ->join('roles', 'roles.slug', '=', $role)
        // ->where('user_areas.area_id', $area_id)
        // ->get();
        return 'true';
    }
}
