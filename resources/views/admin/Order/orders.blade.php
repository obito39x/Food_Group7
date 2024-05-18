<style>
    .container {
        margin-top: 24px;
    }

    .order {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
    }

    .customer-info,
    .product-info {
        flex: 1;
    }

    .customer-info h3,
    .product-info h3 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .customer-info p,
    .product-info table {
        margin-bottom: 10px;
    }

    .product-info table {
        width: 100%;
    }

    .product-info table th,
    .product-info table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .product-info table th {
        background-color: #f2f2f2;
    }

    .customer-info,
    .product-info,
    .order-total {
        flex: 1;
        padding: 10px;
    }

    .customer-info h3,
    .product-info h3,
    .order-total h3 {
        margin-bottom: 10px;
        font-size: 18px;
        font-weight: bold;
    }

    .customer-info p,
    .product-info table,
    .order-total h3 {
        font-size: 16px;
    }

    .product-info table {
        width: 100%;
        border-collapse: collapse;
    }

    .product-info th,
    .product-info td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    .order-total h3 {
        text-align: right;
        font-size: 20px;
        font-weight: bold;
    }

    .card {
        width: 400px;
        background: #FFFFFF;
        box-shadow: 0px 187px 75px rgba(0, 0, 0, 0.01), 0px 105px 63px rgba(0, 0, 0, 0.05), 0px 47px 47px rgba(0, 0, 0, 0.09), 0px 12px 26px rgba(0, 0, 0, 0.1), 0px 0px 0px rgba(0, 0, 0, 0.1);
    }

    .title {
        width: 100%;
        height: 40px;
        position: relative;
        display: flex;
        align-items: center;
        padding-left: 20px;
        border-bottom: 1px solid #efeff3;
        font-weight: 700;
        font-size: 11px;
        color: #63656b;
    }

    /* cart */
    .cart {
        border-radius: 19px 19px 7px 7px;
    }

    .cart .products {
        display: flex;
        flex-direction: column;
        padding: 10px;
    }

    .cart .products .product {
        display: grid;
        grid-template-columns: 60px 1fr 1fr;
        gap: 10px;
    }

    .cart .products .product span {
        font-size: 13px;
        font-weight: 600;
        color: #47484b;
        margin-bottom: 8px;
        display: block;
    }

    .cart .products .product p {
        font-size: 11px;
        font-weight: 600;
        color: #7a7c81;
    }

    .cart .quantity {
        height: 30px;
        width: 100px;
        padding-left: 5px;
        background-color: #ffffff;
        border: 1px solid #e5e5e5;
        border-radius: 7px;
        filter: drop-shadow(0px 1px 0px #efefef) drop-shadow(0px 1px 0.5px rgba(239, 239, 239, 0.5));
    }

    .cart .quantity label {
        width: 20px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-bottom: 2px;
        font-size: 15px;
        font-weight: 700;
        color: #47484b;
    }

    .cart .quantity button {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 0;
        outline: none;
        background-color: transparent;
        padding-bottom: 2px;
    }

    .card .small {
        font-size: 15px;
        margin: 0 0 auto auto;
    }

    .card .small sup {
        font-size: px;
    }

    .img_product {
        width: 58px;
        height: 58px;
        border-radius: 8px;
    }

    .confirmation {
        position: absolute;
        padding: 17px 40px;
        border-radius: 50px;
        cursor: pointer;
        border: 0;
        bottom: 0;
        right: 0;
        background-color: rgb(237, 235, 132);
        box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        font-size: 15px;
        transition: all 0.5s ease;
    }

    .confirmation:hover {
        letter-spacing: 3px;
        background-color: hsl(261deg 80% 48%);
        color: hsl(0, 0%, 100%);
        box-shadow: rgb(93 24 220) 0px 7px 29px 0px;
    }

    .confirmation:active {
        letter-spacing: 3px;
        background-color: hsl(261deg 80% 48%);
        color: hsl(0, 0%, 100%);
        box-shadow: rgb(93 24 220) 0px 0px 0px 0px;
        transform: translateY(10px);
        transition: 100ms;
    }

    .total_confirm {
        position: relative;
    }

    .component-title {
        width: 100%;
        position: absolute;
        z-index: 999;
        top: 30px;
        left: 0;
        padding: 0;
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: #888;
        text-align: center;
    }

    .ul {
        width: fit-content;
        height: fit-content;
        background-color: transparent;
        list-style: none;
    }

    .li {
        margin-bottom: 5px;
    }

    .button {
        background-color: transparent;
        font-family: sans-serif;
        color: rgb(0, 0, 0);
        border: none;
        font-size: 22px;
        font-weight: 700;
        padding: 10px 30px;
        cursor: pointer;
        position: relative;
        padding-left: 11px;
        text-align: center;
        transition: 0.1s;
        z-index: 1;
    }

    .p {
        z-index: 2;
        position: relative;
    }

    .button:hover {
        color: rgb(172, 40, 0);
        text-align: center;
    }



    .button::before {
        content: "";
        border-radius: 1px;
        position: absolute;
        width: 6px;
        height: 6px;
        background-color: tomato;
        left: -10px;
        top: 19px;
        cursor: pointer;
        transform: rotate(225deg);
        transition: 0.3s;
        z-index: -1;
    }

    .button:active::before {
        background-color: rgb(255, 38, 0);
    }

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
</style>
@extends('admin.dashboard') <!-- Kế thừa layout của trang dashboard -->

@section('content')
    <!-- MAIN -->
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
                <h1>Orders</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="{{ route('mystore') }}">My Store</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Orders</a>
                    </li>
                </ul>
            </div>
            <form class="form" action="{{ route('dashboard.order') }}" method="GET">
                <input type="hidden" name="status" value="{{ $status }}">
                <label for="search">
                    <input required autocomplete="off" name="search" placeholder="search..." id="search" type="text">
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
            <ul class="ul">
                <li class="li">
                    <button class="button" onclick="redirectToOrderDashboard('Pending')">
                        <p class="p">Pending</p>
                    </button>
                </li>
                <li class="li">
                    <button class="button" onclick="redirectToOrderDashboard('Process')">
                        <p class="p">Process</p>
                    </button>
                </li>
                <li class="li">
                    <button class="button" onclick="redirectToOrderDashboard('Completed')">
                        <p class="p">Completed</p>
                    </button>
                </li>
            </ul>
        </div>
        <div class="container">
            @if (count($orders) > 0)
                @foreach ($orders as $order)
                    @php
                        $user = \App\Models\User::find($order->id_user);
                    @endphp
                    <div class="order">
                        <div class="customer-info">
                            <h3>Customer Information</h3>
                            <p><strong>Email:</strong> {{ $order->email }}</p>
                            <p><strong>Fullname:</strong> {{ $order->fullname }}</p>
                            <p><strong>Phone:</strong> {{ $order->phone }}</p>
                            <p><strong>Address:</strong> {{ $order->address }}</p>
                            <p><strong>City:</strong> {{ $order->city }}</p>
                            <p><strong>District:</strong> {{ $order->district }}</p>
                            <p><strong>Ward:</strong> {{ $order->ward }}</p>
                            <p><strong>Payment:</strong> {{ $order->payment_method }}</p>
                            @if ($user != null)
                                <p><strong>User:</strong>{{ $user->username }} </p>
                            @endif

                        </div>
                        <div class="product-info">
                            <div class="card cart">
                                <label class="title">Product Information</label>
                                @foreach ($order_items as $order_item)
                                    @if ($order_item->order_id == $order->id)
                                        @foreach ($products as $product)
                                            @if ($product->id == $order_item->product_id)
                                                <div class="products">
                                                    <div class="product">
                                                        <img class="img_product" src="{{ asset($product->image_url) }}"
                                                            alt="">
                                                        <div>
                                                            <span>{{ $product->name }}</span>
                                                            <div class="quantity">

                                                                <label>{{ $order_item->quantity }}</label>

                                                            </div>
                                                        </div>

                                                        <label class="price small">${{ $order_item->price }}</label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <div class="total_confirm">
                            <div class="order-total">
                                <h3>Total Amount: ${{ $order->total_amount }}</h3>
                            </div>
                            <button class="confirmation"
                                onclick="window.location='{{ route('order.comfirm', $order->id) }}'">Confirm</button>
                        </div>


                    </div>
                @endforeach
            @else
                <p>no order</p>
            @endif
        </div>
        <div class="pagination-wrapper">
            <div class="pagination">
                {{-- Nút Previous --}}
                @if ($orders->currentPage() > 1)
                    <a href="{{ $orders->appends(['status' => $status, 'search' => $searchQuery])->previousPageUrl() }}" class="pagination-btn">Previous</a>
                @endif
    
                {{-- Hiển thị trang hiện tại --}}
                <span>Page {{ $orders->currentPage() }} of {{ $orders->lastPage() }}</span>
    
                {{-- Nút Next --}}
                @if ($orders->hasMorePages())
                    <a href="{{ $orders->appends(['status' => $status, 'search' => $searchQuery])->nextPageUrl() }}" class="pagination-btn">Next</a>
                @endif
            </div>
        </div>

    </main>
    <script>
        const queryString = window.location.search;

        // Tạo một đối tượng URLSearchParams từ query string
        const params = new URLSearchParams(queryString);

        // Lấy giá trị của tham số "status"
        const status = params.get('status');

        // Kiểm tra nếu status là 'Process' thì ẩn phần tử 'confirmation'
        if (status === 'Process' || status === 'Completed') {
            // Ẩn phần tử 'confirmation'
            var confirmationElements = document.getElementsByClassName("confirmation");
            for (var i = 0; i < confirmationElements.length; i++) {
                confirmationElements[i].style.display = "none";
            }
        }
        document.addEventListener("DOMContentLoaded", function() {
            // Tìm tất cả các phần tử có lớp là "confirmation"
            var confirmationElements = document.getElementsByClassName("confirmation");
        });

        function redirectToOrderDashboard(status) {
            window.location = "{{ route('dashboard.order') }}?status=" + status;
        }
    </script>
    <!-- MAIN -->
@endsection
