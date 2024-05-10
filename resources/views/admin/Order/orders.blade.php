<style>
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
</style>
@extends('admin.dashboard') <!-- Kế thừa layout của trang dashboard -->

@section('content')
    <!-- MAIN -->
    <main>
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
                        @if($user != null)
                        <p><strong>User:</strong>{{$user->username}} </p>
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
                    <div class="order-total">
                        <h3>Total Amount: ${{ $order->total_amount }}</h3>
                    </div>
                </div>
        @endforeach
    @else
        <p>no order</p>
        @endif
    </main>
    <!-- MAIN -->
@endsection
