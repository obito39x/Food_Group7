<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="{{ asset('/css/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/menuAccount.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="image/short_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('/js/menu.js') }}"></script>
</head>
@extends('layouts.app') <!-- Extend the main layout -->

@section('content')
    <div class="search_box">
    </div>
    <!-- Banner -->
    <div class="banner_bg">
        <h1>Our <span>Menu</span></h1>
    </div>
    <!--Tim Kiem-->
    <form class="formseach" action="{{ route('menu') }}" method="GET">
        <input type="text" name="query" placeholder="Search...">
        <button type="submit"><i class="fa-solid fa-search"></i></button>
    </form>
    <!--Danh Muc-->
    <div class="category-filter">
        <form action="{{ route('menu') }}" method="GET">
            <input type="hidden" name="query" value="{{ request('query') }}">
            <div class="category-buttons">
                <button type="submit" name="category" value="all" class="{{ request('category') == 'all' ? 'active' : '' }}">All</button>
                <button type="submit" name="category" value="1" class="{{ request('category') == '1' ? 'active' : '' }}">Food</button>
                <button type="submit" name="category" value="2" class="{{ request('category') == '2' ? 'active' : '' }}">Drinks</button>
            </div>
        </form>
    </div>
    
    <!-- Menu -->
    <div class="menu_box">
        <div class="menu">
            <div class="menu_box anim">
                @forelse ($products as $product)
                    <div class="menu_card">
                        <div class="menu_img">
                            <img src="{{ asset($product->image_url) }}">
                        </div>
                        <div class="menu_text">
                            <h2>{{ $product->name }}</h2>
                            <p>{{ $product->description }}</p>
                            <div class="menu_icon">
                                @php
                                    $fullStars = floor($product->rating); // Số sao đầy đủ
                                    $halfStar = $product->rating - $fullStars; // Phần nửa sao
                                    $emptyStars = 5 - ceil($product->rating); // Số sao trống
                                @endphp
    
                                {{-- Hiển thị sao đầy đủ --}}
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
    
                                {{-- Hiển thị sao nửa --}}
                                @if ($halfStar >= 0.5)
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                @endif
    
                                {{-- Hiển thị sao trống --}}
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="fa-solid fa-star-empty"></i>
                                @endfor
                            </div>
                            <p class="price">${{ $product->new_price }}<sub><del>${{ $product->old_price }}</del></sub></p>
                            <a href="{{ route('cart.add', $product->id) }}" class="menu_btn">
                                <i class="fa-solid fa-burger"></i>Order Now
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="menu_box">
                        <h1>No products found.</h1>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Phân trang -->
    <div class="pagination-wrapper">
        <div class="pagination">
            {{-- Nút Previous --}}
            @if ($products->currentPage() > 1)
                <a href="{{ $products->previousPageUrl() }}" class="pagination-btn">Previous</a>
            @endif
    
            {{-- Hiển thị trang hiện tại --}}
            <span>Page {{ $products->currentPage() }} on {{ $products->lastPage() }}</span>
    
            {{-- Nút Next --}}
            @if ($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" class="pagination-btn">Next</a>
            @endif
        </div>
    </div>
    
    
@endsection

