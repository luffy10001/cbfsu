<?php

namespace App\Listeners;

use App\Events\AgencyCognitoEvent;
use App\Traits\AgencyCognitoTrailt;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AgencyCognitoListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AgencyCognitoEvent $event): void
    {
        $agency     =   $event->agency_data['agency'];
        $city_ids   =   $event->agency_data['city_ids'];
       /* AgencyCognitoTrailt::addAgencyUser($agency,$city_ids);*/
    }
}
