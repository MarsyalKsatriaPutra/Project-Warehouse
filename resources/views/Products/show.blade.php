@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Product Details</h1>
        <div>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $product->code }}</h6>
            <p class="card-text">{{ $product->description }}</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Price:</strong> {{ number_format($product->price, 2) }}</li>
                <li class="list-group-item"><strong>Initial Quantity:</strong> {{ $product->initial_quantity }}</li>
                <li class="list-group-item"><strong>Current Quantity:</strong> {{ $product->current_quantity }}</li>
            </ul>
            <a href="{{ route('stocks.logs', $product->id) }}" class="card-link">View Stock Logs</a>
        </div>
    </div>
@endsection