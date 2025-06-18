<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockOut
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;
    public $quantity;

    public function __construct(Product $product, $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
}