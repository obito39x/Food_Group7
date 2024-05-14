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
