<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link href="{{ asset('/css/product_detail.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="{{ asset('/image/short_icon.png') }}">
</head>

</html>
@extends('layouts.app') <!-- Extend the main layout -->

@section('content')
    <div class="success" id="success">
        <div class="success__icon">
            <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd"
                    d="m12 1c-6.075 0-11 4.925-11 11s4.925 11 11 11 11-4.925 11-11-4.925-11-11-11zm4.768 9.14c.0878-.1004.1546-.21726.1966-.34383.0419-.12657.0581-.26026.0477-.39319-.0105-.13293-.0475-.26242-.1087-.38085-.0613-.11844-.1456-.22342-.2481-.30879-.1024-.08536-.2209-.14938-.3484-.18828s-.2616-.0519-.3942-.03823c-.1327.01366-.2612.05372-.3782.1178-.1169.06409-.2198.15091-.3027.25537l-4.3 5.159-2.225-2.226c-.1886-.1822-.4412-.283-.7034-.2807s-.51301.1075-.69842.2929-.29058.4362-.29285.6984c-.00228.2622.09851.5148.28067.7034l3 3c.0983.0982.2159.1748.3454.2251.1295.0502.2681.0729.4069.0665.1387-.0063.2747-.0414.3991-.1032.1244-.0617.2347-.1487.3236-.2554z"
                    fill="#393a37" fill-rule="evenodd"></path>
            </svg>
        </div>
        <div class="success__title">Added to cart</div>
    </div>
    <div class="container">

        <div class="product-detail">
            <div class="product-image">
                <img src="{{ asset($product->image_url) }}" alt="Bacon Cheeseburger">
            </div>
            <div class="product-info">
                <h1>{{ $product->name }}</h1>
                <div class="rating">
                    @for ($i = 0; $i < $product->rating; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                    @for ($i = 0; $i < 5 - $product->rating; $i++)
                        <i class="fa-regular fa-star"></i>
                    @endfor
                    <span class="rating-text">({{ $product->rating }})</span>
                </div>
                <p class="description">{{ $product->description }}</p>
                <p class="price">${{ $product->new_price }} <sub><del>${{ $product->old_price }}</del></sub></p>
                <div class="quantity">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="100" value="1"
                        step="1" oninput="validateQuantity(this)">
                    <script>
                        function validateQuantity(input) {
                            if (input.value < 1) {
                                input.value = 1;
                            } else if (input.value > 100) {
                                input.value = 100;
                            }
                        }
                    </script>
                </div>
                <button class="CartBtn" onclick="addToCart({{ $product->id }})">
                    <span class="IconContainer">
                        <i class="fa-solid fa-burger"></i>
                    </span>
                    <p class="text">Order Now</p>
                </button>
            </div>
        </div>

        <!-- Product Reviews -->
        <div class="product-reviews">
            <h3>Customer Reviews</h3>
            @foreach ($reviews as $review)
                <div class="review">
                    <div class="review-header">
                        <span class="review-rating">
                            @for ($i = 0; $i < $review->rating; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                            @for ($i = 0; $i < 5 - $review->rating; $i++)
                                <i class="fa-regular fa-star"></i>
                            @endfor

                        </span>

                        <span class="review-author">{{ $review->username }}</span>
                    </div>
                    <p class="review-comment">{{ $review->comment }}</p>
                </div>
            @endforeach
            <!-- Additional reviews can be added in similar divs -->
        </div>

        <!-- Related Products -->
        <div class="related-products">
            <h3>Related Products</h3>
            @foreach($product_relateds as $product_related)
            <div class="related-product">
                <img src="{{ asset($product_related->image_url) }}" alt="Related Product Image">
                <div class="related-product-info">
                    <p class="related-product-name">{{$product_related->name}}</p>
                    <p class="related-product-price">Price: ${{$product_related->new_price}}</p>
                    <button class="related-product-btn">View Details</button>
                </div>
            </div>
            @endforeach
            <!-- Additional related products can be added in similar divs -->
        </div>
    </div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    function addToCart(productId) {

        // Gửi yêu cầu AJAX để thêm sản phẩm vào giỏ hàng
        var quantity = document.getElementById('quantity').value;
        axios.post('{{ route('detail.add') }}', {
                productId: productId,
                quantity: quantity
            })
            .then(function(response) {
                document.querySelector('.fa-cart-shopping').classList.add('bounce');
                var success = document.getElementById('success');
                success.style.display = 'flex';
                // Xóa lớp bounce sau khi hoàn thành animation
                setTimeout(function() {
                    document.querySelector('.fa-cart-shopping').classList.remove('bounce');
                }, 300);
                setTimeout(function() {
                    success.style.display = 'none';
                }, 3000);
            })
            .catch(function(error) {
                // Xử lý lỗi (nếu có)
                console.error(error);


            });
    }
</script>
