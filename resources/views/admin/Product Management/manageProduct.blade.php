@extends('admin.dashboard') <!-- Kế thừa layout chính -->

@section('content')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Tìm li có class mystore
            const mystoreLi = document.querySelector("#sidebar .mystore");

            // Thêm lớp active cho li mystore
            mystoreLi.classList.add("active");
        });
    </script>
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Product Management</h1>
                <ul class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li><a href="{{ route('mystore') }}" class="active">My Store</a></li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li><a href="{{ route('products.index') }}" class="active">Product Management</a></li>
                </ul>
            </div>
            <form class="form" action="{{ route('products.index') }}" method="GET">
                <label for="search">
                    <input required autocomplete="off" name="search" placeholder="search..." id="search"
                        type="text">
                    <div class="icon">
                        <svg stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="swap-on">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linejoin="round"
                                stroke-linecap="round"></path>
                        </svg>
                        <svg stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="swap-off">
                            <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linejoin="round" stroke-linecap="round"></path>
                        </svg>
                    </div>
                    <button type="reset" class="close-btn">
                        <svg viewBox="0 0 20 20" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </label>
            </form>
            <button title="Add" class="cssbuttons-io-button" onclick="window.location='{{ route('products.create') }}'">
                <svg height="25" width="25" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z" fill="currentColor"></path>
                </svg>
                <span>Add Product</span>
            </button>
        </div>

        <div class="table-data">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Rating</th>
                        <th>Old Price</th>
                        <th>New Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Hide</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td><img src="{{ asset($product->image_url) }}" class="product-image"></td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->rating }}</td>
                            <td>${{ $product->old_price }}</td>
                            <td>${{ $product->new_price }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}"><i class="bx bxs-edit"></i></a>


                            </td>
                            <td>
                                <form action="{{ route('products.delete', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="buttonsubmit" type="submit">
                                        <i class="bx bxs-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td>

                                <label class="container">
                                    <button class="hide" value="{{ $product->id }}" onclick="window.location='{{ route('products.toggleHide', ['id' => $product->id]) }}'">
                                        @if ($product->hide)
                                            <svg class="eye" xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 576 512">
                                                <path
                                                    d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z">
                                                </path>
                                            </svg>
                                        @else
                                            <svg class="eye-slash" xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 640 512">
                                                <path
                                                    d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z">
                                                </path>
                                            </svg>
                                        @endif
                                    </button>

                                </label>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
    </main>
@endsection
<style>
    /* CSS cho phân trang */
    .pagination-wrapper {
        margin-top: 20px;
        text-align: center;
    }

    .pagination {
        display: inline-block;
        padding: 8px 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .pagination-btn {
        color: #007bff;
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 4px;
        margin: 0 5px;
        transition: background-color 0.3s ease;
    }

    .pagination-btn:hover {
        background-color: #f0f0f0;
    }

    /* From uiverse.io by @satyamchaudharydev */
    /* this button is inspired by -- whatsapp input */
    /* == type to see fully interactive and click the close buttom to remove the text  == */

    .form {
        --input-bg: #FFf;
        /*  background of input */
        --padding: 1.5em;
        --rotate: 80deg;
        /*  rotation degree of input*/
        --gap: 2em;
        /*  gap of items in input */
        --icon-change-color: #15A986;
        /*  when rotating changed icon color */
        --height: 40px;
        /*  height */
        width: 200px;
        padding-inline-end: 1em;
        /*  change this for padding in the end of input */
        background: var(--input-bg);
        position: relative;
        border-radius: 4px;
    }

    .form label {
        display: flex;
        align-items: center;
        width: 100%;
        height: var(--height);
    }

    .form input {
        width: 100%;
        padding-inline-start: calc(var(--padding) + var(--gap));
        outline: none;
        background: none;
        border: 0;
    }

    /* style for both icons -- search,close */
    .form svg {
        /* display: block; */
        color: #111;
        transition: 0.3s cubic-bezier(.4, 0, .2, 1);
        position: absolute;
        height: 15px;
    }

    /* search icon */
    .icon {
        position: absolute;
        left: var(--padding);
        transition: 0.3s cubic-bezier(.4, 0, .2, 1);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* arrow-icon*/
    .swap-off {
        transform: rotate(-80deg);
        opacity: 0;
        visibility: hidden;
    }

    /* close button */
    .close-btn {
        /* removing default bg of button */
        background: none;
        border: none;
        right: calc(var(--padding) - var(--gap));
        box-sizing: border-box;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #111;
        padding: 0.1em;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        transition: 0.3s;
        opacity: 0;
        transform: scale(0);
        visibility: hidden;
    }

    .form input:focus~.icon {
        transform: rotate(var(--rotate)) scale(1.3);
    }

    .form input:focus~.icon .swap-off {
        opacity: 1;
        transform: rotate(-80deg);
        visibility: visible;
        color: var(--icon-change-color);
    }

    .form input:focus~.icon .swap-on {
        opacity: 0;
        visibility: visible;
    }

    .form input:valid~.icon {
        transform: scale(1.3) rotate(var(--rotate))
    }

    .form input:valid~.icon .swap-off {
        opacity: 1;
        visibility: visible;
        color: var(--icon-change-color);
    }

    .form input:valid~.icon .swap-on {
        opacity: 0;
        visibility: visible;
    }

    .form input:valid~.close-btn {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
        transition: 0s;
    }

    .container {
        --color: #a5a5b0;
        --size: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        cursor: pointer;
        font-size: var(--size);
        user-select: none;
        fill: var(--color);
        margin-left: 10px;
    }

    .container .eye {
        position: absolute;
        animation: keyframes-fill .5s;
    }

    .container .eye-slash {
        position: absolute;
        animation: keyframes-fill .5s;

    }

    /* ------ On check event ------ */
    .container input:checked~.eye {}

    .container input:checked~.eye-slash {
        display: block;
    }

    /* ------ Hide the default checkbox ------ */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* ------ Animation ------ */
    @keyframes keyframes-fill {
        0% {
            transform: scale(0);
            opacity: 0;
        }

        50% {
            transform: scale(1.2);
        }
    }

    .edit {
        margin-top: 20px;
    }

    .hide {
        background-color: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
        width: 24px;
        /* Thiết lập kích thước nút */
        height: 24px;
        /* Thiết lập kích thước nút */
    }

    .hide svg {
        width: 100%;
        /* Chiều rộng của SVG bằng với kích thước nút */
        height: 100%;
        /* Chiều cao của SVG bằng với kích thước nút */
    }
</style>
