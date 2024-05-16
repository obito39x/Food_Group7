<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/css/history.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/menuAccount.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="image/short_icon.png">
    <script src="{{ asset('/js/menu.js') }}"></script>
    <title>Document</title>
</head>

<body>

</body>

</html>
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Order History</h1>

        @if (count($orders) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->date_order)->format('d/m/Y') }}</td>
                            <td>{{ $order->total_amount }}$</td>
                            @if ($order->status_id == 1)
                                <td>Completed</td>
                            @elseif($order->status_id == 2)
                                <td>Pending</td>
                            @else
                                <td>Process</td>
                            @endif
                            <td>
                                <a onclick="toggleProductInfo(this)"
                                    data-order-id="{{ $order->id }}"class="btn btn-primary">View</a>
                                <div class="product-info" id="product-info-{{ $order->id }}">
                                    <div class="card cart">
                                        <label class="title">Product Information<i onclick="hideProductInfo()"
                                                class="fa-solid fa-xmark"></i></label>
                                        @foreach ($order_items as $order_item)
                                            @if ($order_item->order_id == $order->id)
                                                @foreach ($products as $product)
                                                    @if ($product->id == $order_item->product_id)
                                                        <div class="products">
                                                            <div class="product">
                                                                <img class="img_product"
                                                                    src="{{ asset($product->image_url) }}" alt="">
                                                                <div>
                                                                    <span>{{ $product->name }}</span>
                                                                    <div class="quantity">

                                                                        <label>{{ $order_item->quantity }}</label>

                                                                    </div>
                                                                </div>

                                                                <label
                                                                    class="price small">${{ $order_item->price }}</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </td>
                            @if ($order->status_id == 3)
                                <td><button class="buton_sucess" onclick="showReviewForm({{ $order->id }})"> Success
                                    </button></td>
                            @elseif($order->status_id == 2)
                                <td><button class="buton_sucess"
                                        onclick="window.location='{{ route('order.cancel', $order->id) }}'"> Cancel
                                    </button></td>
                            @endif
                            <td>
                                <div id="review-form" class="review-form" style="display: none;">
                                    <h2>Đánh giá sản phẩm</h2>
                                    <form action="{{ route('order.success', ['id' => $order->id]) }}" id="submit-review"
                                        method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" id="order_id" name="order_id" value="">
                                        <div class="form-group">
                                            <label for="comment">Bình luận của bạn:</label>
                                            <textarea id="comment" name="comment" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Đánh giá sao:</label>
                                            <div class="star-rating">
                                                <input type="radio" id="star5" name="rating" value="5"><label
                                                    for="star5">&#9733;</label>
                                                <input type="radio" id="star4" name="rating" value="4"><label
                                                    for="star4">&#9733;</label>
                                                <input type="radio" id="star3" name="rating" value="3"><label
                                                    for="star3">&#9733;</label>
                                                <input type="radio" id="star2" name="rating" value="2"><label
                                                    for="star2">&#9733;</label>
                                                <input type="radio" id="star1" name="rating" value="1"><label
                                                    for="star1">&#9733;</label>
                                            </div>
                                        </div>
                                        <button type="submit">Gửi đánh giá</button>
                                        <button type="button" onclick="hideReviewForm()">Đóng</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>You have no orders.</p>
        @endif
    </div>
    <script>
        function toggleProductInfo(button) {
            // Tìm phần tử cha <tr> chứa nút "View"
            var row = button.closest('tr');

            // Tìm phần tử .product-info trong phần tử cha đó
            var productInfo = row.querySelector('.product-info');

            // Toggle hiển thị ẩn của productInfo
            if (productInfo.style.display === 'none') {
                productInfo.style.display = 'block';
            } else {
                productInfo.style.display = 'none';
            }
        }

        function hideProductInfo() {
            // Tìm tất cả các phần tử .product-info và ẩn chúng
            var productInfos = document.querySelectorAll('.product-info');
            productInfos.forEach(function(productInfo) {
                productInfo.style.display = 'none';
            });
        }

        function showReviewForm(orderId) {
            document.getElementById('order_id').value = orderId;
            document.getElementById('review-form').style.display = 'block';
        }

        function hideReviewForm() {
            document.getElementById('review-form').style.display = 'none';
        }
    </script>
@endsection
