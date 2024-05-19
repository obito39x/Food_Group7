<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="{{ asset('/css/oder.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        @php
            $totalAmount = 0; // Khởi tạo tổng số tiền
        @endphp

        <form class="row" action="{{ route('checkout.process') }}" method="post">
            <!-- Phần Thông Tin Khách Hàng (Bên trái) -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Checkout</div>
                    <div class="card-body">

                        @csrf
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ $profile->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">First and last name:</label>
                            <input type="text" name="fullname" id="fullname" class="form-control"
                                value="{{ $profile->fullname }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone number:</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ $profile->phone_number }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Delivery address:</label>
                            <input type="text" name="address" id="address" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="city">Province/City:</label>
                            <select name="city" id="city" class="form-control" required>
                                <option value="">Select province/city</option>
                                <!-- Thêm các tùy chọn cho các tỉnh/thành phố -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="district">District:</label>
                            <select name="district" id="district" class="form-control" required>
                                <option value="">Select district</option>
                                <!-- Thêm các tùy chọn cho các quận/huyện -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ward">Wards:</label>
                            <select name="ward" id="ward" class="form-control" required>
                                <option value="">Select ward/commune</option>
                                <!-- Thêm các tùy chọn cho các phường/xã -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="payment_method">Payments:</label>
                            <select name="payment_method" id="payment_method" class="form-control" required>
                                <option value="">Choose payment method</option>
                                <option value="COD">Pay upon receipt (COD)</option>
                                <!-- Thêm các hình thức thanh toán khác nếu cần -->
                            </select>
                        </div>

                        <input type="hidden" name="products" id="productsInput" value='@json($products)'>
                        <button type="submit" class="btn btn-primary" onclick="sendDataToController()">Proceed to payment</button>

                    </div>
                </div>
            </div>

            <!-- Phần Thanh Toán (Bên phải) -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Pay</div>

                    <div class="card-body">
                        <!-- Danh sách các voucher của người dùng -->
                        <div class="form-group">
                            <label for="voucher">Select voucher:</label>
                            <select name="voucher" id="voucher" class="form-control" onchange="updateTotal()">
                                <option value="">Do not use vouchers</option>
                                @if ($userVouchers)
                                    @foreach ($userVouchers as $voucher)
                                        <option value="{{ $voucher->id }}" data-discount="{{ $voucher->discount_value }}">
                                            {{ $voucher->code }}({{$voucher->description}})</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @foreach ($products as $product)
                            <div class="product">
                                <img src="{{ asset($product->image_url) }}" alt="">
                                <p class="name">{{ $product->name }}</p>
                                <p class="price">{{ $product->new_price }} $</p>
                                <p class="quantity">Quantity: {{ session()->get("cart.$product->id.quantity", 1) }}
                                </p>
                            </div>
                            @php
                                // Tính toán tổng số tiền cho từng sản phẩm
                                $subtotal = $product->new_price * session()->get("cart.$product->id.quantity", 1);
                                // Cập nhật tổng số tiền
                                $totalAmount += $subtotal;
                            @endphp
                        @endforeach
                        <div class="mt-3">
                            <p>Into money: <span id="totalAmountBeforeDiscount">{{ $totalAmount }}</span> $</p>
                        </div>
                        <hr>
                        <div>
                            <p>Total discount: <span id="totalDiscount">0</span> $</p>
                            <p>Shipping fee: Free</p>
                            <p>Estimated time: 1-2 days</p>
                        </div>
                        <hr>
                        <div>
                            <p><strong id="finalTotalAmount">Total: {{ $totalAmount }} $</strong></p>
                            <input type="hidden" name="total_amount" id="totalAmountInput" value="{{ $totalAmount }}">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function(result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Name); // Sử dụng x.Name thay vì x.Id
        }
        citis.onchange = function () {
            district.length = 1;
            ward.length = 1;
            if (this.value != "") {
                const result = data.filter(n => n.Name === this.value); // Sử dụng Name thay vì Id

                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k
                        .Name); // Sử dụng k.Name thay vì k.Id
                }
            }
        };
        district.onchange = function () {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Name === citis.value); // Sử dụng Name thay vì Id
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0]
                    .Wards; // Sử dụng Name thay vì Id

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Name); // Sử dụng w.Name thay vì w.Id
                }
            }
        };
    }
</script>
<script>
    // Tạo một hàm không tên để gửi dữ liệu lên server
    function sendDataToController() {
        // Lấy giá trị của trường ẩn
        var productsJSON = document.getElementById('productsInput').value;

        // Chuyển đổi chuỗi JSON thành một đối tượng JavaScript
        var products = JSON.parse(productsJSON);

        // Gửi dữ liệu $products lên server dưới dạng JSON
        axios.post('{{ route('checkout.process') }}', {
                products: products
            })
            .then(function (response) {
                // Xử lý phản hồi từ server nếu cần
                console.log(response);
            })
            .catch(function (error) {
                // Xử lý lỗi nếu có
                console.error(error);
            });
    }
</script>
<script>
    function updateTotal() {
        var selectVoucher = document.getElementById("voucher");
        var selectedOption = selectVoucher.options[selectVoucher.selectedIndex];
        var discount = parseFloat(selectedOption.dataset.discount) || 0;
        var totalAmountBeforeDiscount = parseFloat(document.getElementById("totalAmountBeforeDiscount").innerText.replace(/,/g, ''));
        var totalDiscount = document.getElementById("totalDiscount");
        var finalTotalAmount = document.getElementById("finalTotalAmount");
        var totalAmountInput = document.getElementById("totalAmountInput");

        // Tính tổng số tiền sau khi áp dụng chiết khấu từ voucher
        var finalTotal = totalAmountBeforeDiscount - discount;

        // Nếu giá trị của voucher lớn hơn tổng số tiền, đặt tổng số tiền bằng 0
        if (finalTotal < 0) {
            finalTotal = 0;
        }

        // Cập nhật giá trị chiết khấu và tổng số tiền mới lên giao diện
        totalDiscount.innerText = "-"+discount.toLocaleString('en-US');
        finalTotalAmount.innerText = "Total: " + finalTotal.toLocaleString('en-US') + " $";

        // Cập nhật giá trị của trường ẩn total_amount với giá trị mới
        totalAmountInput.value = finalTotal;
    }
</script>
