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
        <!--Bộ Lọc-->
        <button onclick="toggleFilterFrame()" title="filter" class="filter">
            <svg viewBox="0 0 512 512" height="1em">
                <path
                    d="M0 416c0 17.7 14.3 32 32 32l54.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 448c17.7 0 32-14.3 32-32s-14.3-32-32-32l-246.7 0c-12.3-28.3-40.5-48-73.3-48s-61 19.7-73.3 48L32 384c-17.7 0-32 14.3-32 32zm128 0a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM320 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm32-80c-32.8 0-61 19.7-73.3 48L32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l246.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48l54.7 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-54.7 0c-12.3-28.3-40.5-48-73.3-48zM192 128a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm73.3-64C253 35.7 224.8 16 192 16s-61 19.7-73.3 48L32 64C14.3 64 0 78.3 0 96s14.3 32 32 32l86.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 128c17.7 0 32-14.3 32-32s-14.3-32-32-32L265.3 64z">
                </path>
            </svg>
        </button>
        <div class="filter-frame">
            <button onclick="filterBestSelling('{{ request('category') }}')">Best Selling</button>
            <button onclick="filterHighestRated()">Highest Rated</button>
        </div>
        <form action="{{ route('menu') }}" method="GET">
            <div class="category-buttons">
                <button type="submit" name="category" value="all"
                    class="{{ request('category') == 'all' ? 'active' : '' }}">All</button>
                @foreach ($categories as $category)
                    <button type="submit" name="category" value="{{ $category->id_category }}"
                        class="{{ request('category') == $category->id_category ? 'active' : '' }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </form>
    </div>

    <!-- Menu -->
    <div class="menu_box">
        <div class="menu">
            <div class="menu_box anim">
                @forelse ($products as $product)
                    <div class="menu_card">
                        <div class="menu_img" onclick="window.location='{{ route('detail', ['id' => $product->id]) }}'">
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
                            <p class="price">{{ $product->new_price }}$<sub><del>{{ $product->old_price }}$</del></sub>
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
    // Hàm để lọc sản phẩm bán chạy nhất
    function filterBestSelling(categoryId) {
    var url = "{{ route('menu') }}?filter=best_selling";
    if (categoryId) {
        url += "&category=" + categoryId;
    }
    window.location = url;
}
</script>
