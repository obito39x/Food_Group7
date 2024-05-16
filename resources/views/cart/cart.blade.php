<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/css/cart.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/menuAccount.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="image/short_icon.png">
    <script src="{{ asset('/js/menu.js') }}"></script>
    <title>Cart</title>
</head>

<body>

</body>

</html>
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Shopping Cart</h1>

        @if (count($products) > 0)
            <div class="product-list">
                @php
                    $totalAmount = 0; // Khởi tạo tổng số tiền
                @endphp
                @foreach ($products as $product)
                    <div class="product">
                        <img class="img-url" src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
                        <h3>{{ $product->name }}</h3>
                        <p class="price">Price: {{ $product->new_price }}$</p>
                        <a href="{{ route('cart.remove', ['id' => $product->id]) }}"><i class="fa-solid fa-trash"></i></a>
                        <div class="quantity">
                            <button class="decrease" data-id="{{ $product->id }}">-</button>
                            <input type="number" class="quantity-input" id="quantity-{{ $product->id }}"
                                value="{{ session()->get("cart.$product->id.quantity", 1) }}" readonly>
                            <button class="increase" data-id="{{ $product->id }}">+</button>
                        </div>
                        @php
                            // Tính toán tổng số tiền cho từng sản phẩm
                            $subtotal = $product->new_price * session()->get("cart.$product->id.quantity", 1);
                            // Cập nhật tổng số tiền
                            $totalAmount += $subtotal;
                        @endphp
                    </div>
                @endforeach
            </div>
            <p class="total">Total Amount: <span id="total-amount">{{ $totalAmount }}</span>$</p>


            <!-- Thêm nút thanh toán -->
            <button class="comic-button" onclick="window.location='{{ route('checkout') }}'">Buy</button>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.increase').forEach(function(button) {
                button.addEventListener('click', function() {
                    let productId = this.getAttribute('data-id');
                    let quantityInput = document.getElementById('quantity-' + productId);
                    let quantity = parseInt(quantityInput.value) + 1;
                    quantityInput.value = quantity;
                    updateCart(productId, quantity);
                });
            });

            document.querySelectorAll('.decrease').forEach(function(button) {
                button.addEventListener('click', function() {
                    let productId = this.getAttribute('data-id');
                    let quantityInput = document.getElementById('quantity-' + productId);
                    let quantity = parseInt(quantityInput.value) - 1;
                    if (quantity < 1) {
                        quantity = 1;
                    }
                    quantityInput.value = quantity;
                    updateCart(productId, quantity);
                });
            });
        });

        function updateCart(productId, quantity) {
            fetch('/cart/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        id: productId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Cart updated successfully');
                        document.getElementById('total-amount').textContent = data.totalAmount;
                    } else {
                        console.error('Failed to update cart');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
