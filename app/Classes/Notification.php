<?php

namespace App\Classes;
use App\Models\CRMNotification;
use App\Models\User;

class Notification {
    public function __construct() {
    }
    public function sendNotification($notifyableUser,$send_by_user_id,$message,$refrence_id,$modal_name,$message_type,$page_route_name,$action_route,$is_modal, $email_subject = "CRM Notification") {
       
        $status_logs=[
            'user_id' =>  $notifyableUser,
            'sent_by_user_id' => $send_by_user_id,
            'message' => $message,
            'refrence_id' => $refrence_id,
            'modal_name' => $modal_name,
            'message_type' => $message_type,
            'page_route_name' => $page_route_name,
            'action_route' => $action_route,
            'is_modal' => $is_modal,
        ];
        $send_notification = CRMNotification::create($status_logs);

        $user = User::where('id', $notifyableUser)->first(['email','phone']);
        if($user)
        {
            if($email_subject)
            {
                if($user->email)
                {
                    try {
                        send_email($user->email, $email_subject, $message, '');
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