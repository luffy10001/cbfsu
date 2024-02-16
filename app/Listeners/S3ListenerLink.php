<?php

namespace App\Listeners;

use App\Events\S3Event;
use App\Models\Property;
use App\Traits\AWSS3Link;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class S3ListenerLink implements ShouldQueue
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
    public function handle(S3Event $event): void
    {


    }
}
