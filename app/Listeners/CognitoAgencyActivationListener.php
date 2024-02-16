<?php

namespace App\Listeners;

use App\Events\CognitoAgencyActivationEvent;
use App\Traits\AgencyCognitoTrailt;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CognitoAgencyActivationListener
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
    public function handle(CognitoAgencyActivationEvent $event): void
    {
        $agencyId   =   $event->agencyData['agencyId'];
        $status     =   (bool) $event->agencyData['status'];
        AgencyCognitoTrailt::agencyStatusCognito($agencyId,($status)?'active':'inactive',$status);
    }
}
