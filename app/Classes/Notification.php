<?php

namespace App\Classes;
use App\Models\Notification as NotificationModel;
use App\Models\User;

class Notification {
    public function __construct() {
    }
    public function sendNotification($notifyableUser,$send_by_user_id,$message,$refrence_id,$modal_name,$message_type,$page_route_name,$action_route,$is_modal, $email_subject = "CBFSU Notification") {


        $status_logs=[
            'user_id'         => $notifyableUser->id,
            'sent_by_user_id' => $send_by_user_id,
            'message'         => $message,
            'refrence_id'     => $refrence_id,
            'modal_name'      => $modal_name,
            'message_type'    => $message_type,
            'page_route_name' => $page_route_name,
            'action_route'    => $action_route,
            'is_modal'        => $is_modal,
        ];


        $send_notification = NotificationModel::create($status_logs);


        $user = User::where('id', $notifyableUser->id)->first(['email']);


        if($user)
        {
            if($email_subject)
            {
                if($user->email)
                {
                    try {
                        send_email($user->email, $email_subject, $message, '',$page_route_name,$notifyableUser->name);
                    } catch (\Exception $e) {
                        true;
                    }
                }

            }

            if($user->phone)
            {
                try {
                    send_message($user->phone, $message);
                } catch (\Exception $e) {
                    true;
                }
            }
        }

        return $send_notification;
    }
}