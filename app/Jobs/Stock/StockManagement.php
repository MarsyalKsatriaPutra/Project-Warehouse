<?php

namespace App\Jobs\Stock;

use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
class StockManagement
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;
    protected $quantity;
    protected $type;

    public function __construct(Product $product, int $quantity, string $type)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->type = $type;
    }

    public function handle()
    {
        DB::transaction(function () {
            $this->product->refresh();

            if ($this->type === 'in') {
                $this->product->current_quantity += $this->quantity;
            } else {
                if ($this->product->current_quantity < $this->quantity) {
                    throw new \Exception("Insufficient stock");
                }
                $this->product->current_quantity -= $this->quantity;
            }

            $this->product->save();

            ProductLog::create([
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
                'type' => $this->type
            ]);
        });

        return $this->product;
    }
}