<!-- resources/views/basket/view.blade.php -->

@extends('layouts.dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Basket</li>
@endsection

@section('content')
    <div class="p-5">

        <x-alert type="success"/>
        <h1>Your Basket</h1>

        @if ($basket && count($basket) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($basket as $item)
                        <tr>
                            <td>{{ $item['product']->name ?? 'Unknown' }}</td>
                            <td>
                                <form action="{{ route('basket.update', $item['product']->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="action" value="decrease" class="btn btn-sm btn-outline-secondary">-</button>
                                    {{ $item['quantity'] ?? 0 }}
                                    <button type="submit" name="action" value="increase" class="btn btn-sm btn-outline-secondary">+</button>
                                </form>
                            </td>
                            <td>${{ number_format($item['product']->price ?? 0, 2) }}</td>
                            <td>${{ number_format(($item['product']->price ?? 0) * ($item['quantity'] ?? 0), 2) }}</td>
                            <td>
                                <!-- Remove Button -->
                                <form action="{{ route('basket.remove', $item['product']->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total:</strong></td>
                        <td>${{ number_format($totalPrice, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Clear Basket Button -->
            <form action="{{ route('basket.clear') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-danger">Clear Basket</button>
            </form>
        @else
            <p>Your basket is empty.</p>
        @endif
    </div>
@endsection
