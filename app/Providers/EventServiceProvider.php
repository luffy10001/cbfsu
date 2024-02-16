<?php

namespace App\Providers;

use App\Events\AgencyCognitoEvent;
use App\Events\CognitoAgencyActivationEvent;
use App\Events\S3Event;
use App\Events\AssignAreastoUser;
use App\Listeners\AssignAreastoUserListener;
use App\Listeners\AgencyCognitoListener;
use App\Listeners\CognitoAgencyActivationListener;
use App\Listeners\S3ListenerLink;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AgencyCognitoEvent::class =>    [
            AgencyCognitoListener::class
        ],
        CognitoAgencyActivationEvent::class =>[
            CognitoAgencyActivationListener::class
        ],
        S3Event::class=>[
            S3ListenerLink::class
        ],
        AssignAreastoUser::class => [
            AssignAreastoUserListener::class,
        ],
    ];
    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
