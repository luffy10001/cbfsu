<?php

namespace App\Http\Controllers;

use App\DataTables\NotificationsDataTable;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Not;

class NotificationController extends Controller
{
    public function index(NotificationsDataTable $dataTable)
    {
        $user = Auth::user();
        Notification::where('user_id',$user->id)->update(['is_read'=>true]);
        return $dataTable->render('notifications.index');
    }
    public function create(){

    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $notification =  Notification::where(['id'=>$request->id, 'user_id'=> $user->id])->first();
        $notification->update(['is_read' => true]);
        $bladeUrl = url($notification->page_route_name);
        return response()->json(['success' => true, 'bladeUrl' => $bladeUrl]);
    }
}
