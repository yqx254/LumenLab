<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ExampleEvent::class => [
            \App\Listeners\ExampleListener::class,
        ],
        \App\Events\CaseCreatedEvent::class =>[
            \App\Listeners\CaseCreatedListener::class
        ],
    ];

    protected $subscribe = [
        \App\Listeners\CaseSubscriber::class
    ];
}
