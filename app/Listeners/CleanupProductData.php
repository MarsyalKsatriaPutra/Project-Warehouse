<?php

namespace App\Listeners;

use App\Events\ProductDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CleanupProductData
{
    public function handle(ProductDeleted $event)
    {
        // Bersihkan data terkait product yang dihapus
        $event->product->logs()->delete();
    }
}