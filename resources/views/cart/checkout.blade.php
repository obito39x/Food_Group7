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
        <div class="row">
            <!-- Phần Thông Tin Khách Hàng (Bên trái) -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Checkout</div>
                    <div class="card-body">
                        <form action="{{ route('checkout.process')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="fullname">Họ và tên:</label>
                                <input type="text" name="fullname" id="fullname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại:</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ nhận hàng:</label>
                                <input type="text" name="address" id="address" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="city">Tỉnh/Thành phố:</label>
                                <select name="city" id="city" class="form-control" required>
                                    <option value="" >Chọn tỉnh/thành phố</option>
                                    <!-- Thêm các tùy chọn cho các tỉnh/thành phố -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="district">Quận/Huyện:</label>
                                <select name="district" id="district" class="form-control" required>
                                    <option value="">Chọn quận/huyện</option>
                                    <!-- Thêm các tùy chọn cho các quận/huyện -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ward">Phường/Xã:</label>
                                <select name="ward" id="ward" class="form-control" required>
                                    <option value="">Chọn phường/xã</option>
                                    <!-- Thêm các tùy chọn cho các phường/xã -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="payment_method">Hình thức thanh toán:</label>
                                <select name="payment_method" id="payment_method" class="form-control" required>
                                    <option value="">Chọn hình thức thanh toán</option>
                                    <option value="COD">Trả tiền khi nhận hàng (COD)</option>
                                    <!-- Thêm các hình thức thanh toán khác nếu cần -->
                                </select>
                            </div>
                            <input type="hidden" name="products" id="productsInput" value='@json($products)'>
                            <button type="submit" class="btn btn-primary" onclick="sendDataToController()">Tiến hành thanh toán</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Phần Thanh Toán (Bên phải) -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Thanh toán</div>
                    @php
                        $totalAmount = 0; // Khởi tạo tổng số tiền
                    @endphp
                    <div class="card-body">
                        @foreach ($products as $product)
                            <div class="product">
                                <img src="{{ asset($product->image_url) }}" alt="">
                                <p class="name">{{ $product->name }}</p>
                                <p class="price">{{ $product->new_price }} ₫</p>
                                <p class="quantity">Số lượng: {{ session()->get("cart.$product->id.quantity", 1) }}</p>
                            </div>
                            @php
                        // Tính toán tổng số tiền cho từng sản phẩm
                        $subtotal = $product->new_price * session()->get("cart.$product->id.quantity", 1);
                            // Cập nhật tổng số tiền
                        // Cập nhật tổng số tiền
                        $totalAmount += $subtotal;
                    @endphp
                        @endforeach
                        
                        <div class="mt-3">
                            <p>Thành tiền: {{ $totalAmount }} ₫</p>
                        </div>
                        <hr>
                        <div>
                            <p>Tổng chiết khấu: -0 ₫</p>
                            <p>Phí vận chuyển: Miễn phí</p>
                            <p>Ước tính thời gian: 1-2 ngày</p>
                        </div>
                        <hr>
                        <div>
                            <p><strong>Tổng: {{ $totalAmount }} ₫</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    citis.onchange = function() {
        district.length = 1;
        ward.length = 1;
        if (this.value != "") {
            const result = data.filter(n => n.Name === this.value); // Sử dụng Name thay vì Id

            for (const k of result[0].Districts) {
                district.options[district.options.length] = new Option(k.Name, k.Name); // Sử dụng k.Name thay vì k.Id
            }
        }
    };
    district.onchange = function() {
        ward.length = 1;
        const dataCity = data.filter((n) => n.Name === citis.value); // Sử dụng Name thay vì Id
        if (this.value != "") {
            const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards; // Sử dụng Name thay vì Id

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
        axios.post('{{ route("checkout.process") }}', {
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
</html>