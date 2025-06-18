@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Stock Logs for {{ $product->name }}</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <span class="badge bg-{{ $log->type === 'in' ? 'success' : 'danger' }}">
                            {{ strtoupper($log->type) }}
                        </span>
                    </td>
                    <td>{{ $log->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $logs->links() }}
@endsection