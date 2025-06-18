<?php

namespace App\Listeners;

use App\Events\ProductUpdated;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogProductActivity
{
    public function handle(ProductUpdated $event)
    {
        ActivityLog::create([
            'description' => 'Product updated',
            'subject_type' => get_class($event->product),
            'subject_id' => $event->product->id,
            'causer_type' => Auth::user() ? get_class(Auth::user()) : null,
            'causer_id' => Auth::id(),
            'properties' => $event->product->getChanges()
        ]);
    }
}