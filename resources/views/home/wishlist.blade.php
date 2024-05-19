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
    <title>Wishlist</title>
    <style>
        .container {
            padding: 100px 50px;
        }

        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .card-body {
            flex-grow: 1;
        }

        .card-img-top {
            max-height: 200px;
            object-fit: cover;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;

        }

        .card-footer:last-child {
            background-color: rgb(129, 124, 124);
        }

    </style>
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="container">
            <h1>Your Wishlist</h1>
            @if ($wishlistItems->isEmpty())
                <p>You have no items in your wishlist.</p>
            @else
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($wishlistItems as $item)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ asset($item->product->image_url) }}" class="card-img-top"
                                    alt="{{ $item->product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->product->name }}</h5>
                                    <p class="card-text">{{ $item->product->description }}</p>
                                    <p class="card-text">{{ $item->product->new_price }}$
                                        <del>{{ $item->product->old_price }}$</del></p>
                                </div>
                                <div class="card-footer btn-container">
                                    <button class="btn btn-primary" onclick="addToCart({{ $item->product->id }})">Order
                                        Now</button>
                                    <button class="btn btn-danger"
                                        onclick="removeFromWishlist({{ $item->product->id }})">Remove</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function removeFromWishlist(productId) {
            axios.post('/addwishlist', {
                    productId: productId
                })
                .then(function(response) {
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error(error);
                });
        }

        function addToCart(productId) {
            axios.post('{{ route('cart.add') }}', {
                    productId: productId
                })
                .then(function(response) {
                    document.querySelector('.fa-cart-shopping').classList.add('bounce');
                    setTimeout(function() {
                        document.querySelector('.fa-cart-shopping').classList.remove('bounce');
                    }, 300);
                })
                .catch(function(error) {
                    console.error(error);
                });
        }
    </script>
</body>

</html>
