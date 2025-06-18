<?php

namespace App\Listeners;

use App\Events\StockIn;
use App\Events\StockOut;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class UpdateInventory
{
    public function handleStockIn(StockIn $event)
    {
        ActivityLog::create([
            'description' => "Stock in: {$event->quantity} units",
            'subject_type' => get_class($event->product),
            'subject_id' => $event->product->id,
            'causer_type' => Auth::user() ? get_class(Auth::user()) : null,
            'causer_id' => Auth::id(),
            'properties' => ['quantity' => $event->quantity]
        ]);
    }

    public function handleStockOut(StockOut $event)
    {
        ActivityLog::create([
            'description' => "Stock out: {$event->quantity} units",
            'subject_type' => get_class($event->product),
            'subject_id' => $event->product->id,
            'causer_type' => Auth::user() ? get_class(Auth::user()) : null,
            'causer_id' => Auth::id(),
            'properties' => ['quantity' => $event->quantity]
        ]);
    }
}