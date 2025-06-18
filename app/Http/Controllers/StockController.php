<?php

namespace App\Http\Controllers;

use App\Events\StockIn;
use App\Events\StockOut;
use App\Jobs\Stock\StockManagement;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('stocks.index', compact('products'));
    }

    public function stockIn(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        $quantity = $request->quantity;

        StockManagement::dispatchSync($product, $quantity, 'in');
        
        event(new StockIn($product, $quantity));

        return redirect()->route('stocks.index')
            ->with('success', 'Stock in recorded successfully.');   
    }

    public function stockOut(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        $quantity = $request->quantity;

        if ($product->current_quantity < $quantity) {
            return back()->with('error', 'Insufficient stock.');
        }

        StockManagement::dispatchSync($product, $quantity, 'out');
        
        event(new StockOut($product, $quantity));

        return redirect()->route('stocks.index')
            ->with('success', 'Stock out recorded successfully.');
    }

    public function logs(Product $product)
    {
        $logs = $product->logs()->latest()->paginate(10);
        return view('stocks.logs', compact('product', 'logs'));
    }
}