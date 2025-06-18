<?php

namespace App\Providers;

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
        \App\Events\ProductCreated::class => [
            \App\Listeners\SendProductNotification::class,
        ],
        \App\Events\ProductUpdated::class => [
            \App\Listeners\LogProductActivity::class,
        ],
        \App\Events\ProductDeleted::class => [
            \App\Listeners\CleanupProductData::class,
        ],
        \App\Events\StockIn::class => [
            \App\Listeners\UpdateInventory::class . '@handleStockIn',
        ],
        \App\Events\StockOut::class => [
            \App\Listeners\UpdateInventory::class . '@handleStockOut',
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