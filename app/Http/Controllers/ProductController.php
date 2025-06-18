<?php

namespace App\Http\Controllers;

use App\Events\ProductCreated;
use App\Events\ProductDeleted;
use App\Events\ProductUpdated;
use App\Jobs\Product\CreateProduct;
use App\Jobs\Product\DeleteProduct;
use App\Jobs\Product\UpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:products',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'initial_quantity' => 'required|integer|min:0',
        ]);

        $product = CreateProduct::dispatchSync($request->all());
        
        event(new ProductCreated($product));

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:products,code,'.$product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = UpdateProduct::dispatchSync($product, $request->all());
        
        event(new ProductUpdated($product));

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        DeleteProduct::dispatchSync($product);
        
        event(new ProductDeleted($product));

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}