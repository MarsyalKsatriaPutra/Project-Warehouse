@extends('layouts.app')

@section('content')
    <h1>Stock Management</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Stock In</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('stocks.in') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="product_id_in" class="form-label">Product</label>
                            <select class="form-select" id="product_id_in" name="product_id" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity_in" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity_in" name="quantity" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Record Stock In</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Stock Out</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('stocks.out') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="product_id_out" class="form-label">Product</label>
                            <select class="form-select" id="product_id_out" name="product_id" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity_out" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity_out" name="quantity" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Record Stock Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection