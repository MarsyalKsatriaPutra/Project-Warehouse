<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendProductNotification
{
    public function handle(ProductCreated $event)
    {
        // Kirim notifikasi atau lakukan aksi lain saat product dibuat
        // Contoh: Kirim email notifikasi
    }
}