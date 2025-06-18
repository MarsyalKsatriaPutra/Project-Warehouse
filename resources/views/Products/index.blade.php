@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Price</th>
                <th>Current Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->current_quantity }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@endsection