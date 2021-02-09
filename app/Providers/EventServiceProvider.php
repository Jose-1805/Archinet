<?php

namespace Archinet\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Archinet\Events\Event' => [
            'Archinet\Listeners\EventListener',
        ],
        'Illuminate\Auth\Events\Login' => [
            'Archinet\Listeners\EventLogin',
        ],
        'Illuminate\Auth\Events\Logout' => [
            'Archinet\Listeners\EventLogout',
        ],
        /*'Illuminate\Foundation\Http\Events\RequestHandled' => [
            'Archinet\Listeners\EventRequestHandled',
        ],*/
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
