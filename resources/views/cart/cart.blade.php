<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/css/cart.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/menuAccount.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('/js/menu.js') }}"></script>
    <link rel="shortcut icon" href="image/short_icon.png">
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
                        <img class="image_product" src="{{ asset($product->image_url) }}">
                        <h3>{{ $product->name }}</h3>
                        <p class="price">Price: ${{ $product->new_price }}</p>
                        <a href="{{ route('cart.remove', ['id' => $product->id]) }}"><i class="fa-solid fa-trash"></i></a>
                        <div class="quantity">
                            <p>Quantity: {{session()->get("cart.$product->id.quantity", 1)}}</p>
                        </div>
                        @php
                        // Tính toán tổng số tiền cho từng sản phẩm
                        $subtotal = $product->new_price * session()->get("cart.$product->id.quantity", 1);
                            // Cập nhật tổng số tiền
                        // Cập nhật tổng số tiền
                        $totalAmount += $subtotal;
                    @endphp

                        <!-- Hiển thị thông tin khác của sản phẩm nếu cần -->
                    </div>
                       
                @endforeach
            </div>
            <p>Total Amount: ${{ $totalAmount }}</p>

                <a href="{{route('checkout')}}" class="checkout-btn"><span>Checkout</span></a>
            
             <!-- Thêm nút thanh toán -->
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
