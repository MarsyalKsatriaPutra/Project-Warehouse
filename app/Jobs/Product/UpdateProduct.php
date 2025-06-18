<?php

namespace App\Jobs\Product;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateProduct
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;
    protected $data;

    public function __construct(Product $product, array $data)
    {
        $this->product = $product;
        $this->data = $data;
    }

    public function handle()
    {
        $this->product->update($this->data);
        return $this->product;
    }
}