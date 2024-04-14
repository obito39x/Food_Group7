<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="{{ asset('/css/menu.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="image/short_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('/js/menu.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
@extends('layouts.app') <!-- Extend the main layout -->

@section('content')
    <!-- Banner -->
    <div class="banner_bg">
        <h1>Our <span>Menu</span></h1>
    </div>

    <!-- Menu -->
    <div class="menu">
        <div class="menu_box anim">
            @foreach($products as $product)
            <div class="menu_card" data-category="{{ $product->category->name }}">
                <div class="menu_img">
                    <img src="{{ $product->image_url }}">
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
                        @if($halfStar >= 0.5)
                            <i class="fa-solid fa-star-half-stroke"></i>
                        @endif
                    
                        {{-- Hiển thị sao trống --}}
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <i class="fa-solid fa-star-empty"></i>
                        @endfor
                    </div>
                    <p class="price">${{ $product->new_price }}<sub><del>${{ $product->old_price }}</del></sub></p>
                    <a href="#" class="menu_btn"><i class="fa-solid fa-burger"></i>Order Now</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endsection
