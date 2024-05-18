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

    <form class="form" action="{{ route('menu') }}" method="GET">
        <div class="search-container">
            <!-- Input tìm kiếm -->
            <input class="seachtext" type="text" name="query" placeholder="Search...">
            <!-- Nút tìm kiếm -->
            <button type="submit" class="search-button">
                <i class="fa-solid fa-search"></i>
            </button>
        </div>
        <!-- Bộ lọc -->
        <div class="category-filter">
            <!--Bộ Lọc-->
            <div class="category-checkboxes">
                @foreach ($categories as $category)
                    <input type="checkbox" name="category[]" id="category_{{ $category->id_category }}"
                        value="{{ $category->id_category }}"
                        {{ in_array($category->id_category, (array) request('category')) ? 'checked' : '' }}>
                    <label for="category_{{ $category->id_category }}"
                        class="{{ in_array($category->id_category, (array) request('category')) ? 'active' : '' }}">{{ $category->name }}</label>
                @endforeach
            </div>
            <!-- Nút Filter -->
            <button class="contactButton">
                Filter
                <div class="iconButton">
                    <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                            fill="currentColor"></path>
                    </svg>
                </div>
            </button>
        </div>
    </form>


    <!-- Menu -->
    <div class="menu_box">
        <div class="menu">
            <div class="menu_box anim">
                @forelse ($products as $product)
                        <div class="menu_card">
                            <div class="menu_img"
                                onclick="window.location='{{ route('detail', ['id' => $product->id]) }}'">
                                <img src="{{ asset($product->image_url) }}">
                            </div>
                            <div class="menu_text">
                                <h2>{{ $product->name }}</h2>
                                {{-- <p>{{ $product->description }}</p> --}}
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
                                <p class="price">
                                    {{ $product->new_price }}$<sub><del>{{ $product->old_price }}$</del></sub>
                                </p>
                                <button class="CartBtn" onclick="addToCart({{ $product->id }})">
                                    <span class="IconContainer">
                                        <i class="fa-solid fa-burger"></i>
                                    </span>

                                    <p class="text">Order Now</p>
                                </button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    function addToCart(productId) {

        // Gửi yêu cầu AJAX để thêm sản phẩm vào giỏ hàng
        axios.post('{{ route('cart.add') }}', {
                productId: productId
            })
            .then(function(response) {
                document.querySelector('.fa-cart-shopping').classList.add('bounce');
                // Xóa lớp bounce sau khi hoàn thành animation
                setTimeout(function() {
                    document.querySelector('.fa-cart-shopping').classList.remove('bounce');
                }, 300);
            })
            .catch(function(error) {
                // Xử lý lỗi (nếu có)
                console.error(error);


            });
    }
</script>
<script>
    function toggleFilterFrame() {
        var filterFrames = document.getElementsByClassName("filter-frame");
        for (var i = 0; i < filterFrames.length; i++) {
            if (filterFrames[i].style.display === 'flex') {
                filterFrames[i].style.display = 'none';
            } else {
                filterFrames[i].style.display = 'flex';
            }
        }
    }
</script>
<script>
    // Chờ cho trang tải hoàn tất
    document.addEventListener("DOMContentLoaded", function() {
        // Lấy tất cả các checkbox
        var checkboxes = document.querySelectorAll('.category-checkboxes input[type="checkbox"]');

        // Đặt sự kiện "change" cho từng checkbox
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Nếu checkbox đang được chọn
                if (this.checked) {
                    // Thêm lớp "active" cho label tương ứng
                    this.nextElementSibling.classList.add('active');
                } else {
                    // Nếu checkbox không được chọn, xóa lớp "active" khỏi label tương ứng
                    this.nextElementSibling.classList.remove('active');
                }
            });
        });
    });
</script>
