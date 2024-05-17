@extends('admin.dashboard') <!-- Kế thừa layout của trang dashboard -->

@section('content')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Tìm li có class mystore
            const mystoreLi = document.querySelector("#sidebar .mystore");

            // Thêm lớp active cho li mystore
            mystoreLi.classList.add("active");
        });
    </script>
    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Category Management</h1>
                <ul class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li><a href="{{ route('mystore') }}" class="active">My Store</a></li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li><a href="" class="active">Category Management</a></li>
                </ul>
            </div>
        </div>
        <div class="container">
            @if (session('success'))
                <div class="success" id="success">
                    <div class="success__icon">
                        <svg fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                d="m12 1c-6.075 0-11 4.925-11 11s4.925 11 11 11 11-4.925 11-11-4.925-11-11-11zm4.768 9.14c.0878-.1004.1546-.21726.1966-.34383.0419-.12657.0581-.26026.0477-.39319-.0105-.13293-.0475-.26242-.1087-.38085-.0613-.11844-.1456-.22342-.2481-.30879-.1024-.08536-.2209-.14938-.3484-.18828s-.2616-.0519-.3942-.03823c-.1327.01366-.2612.05372-.3782.1178-.1169.06409-.2198.15091-.3027.25537l-4.3 5.159-2.225-2.226c-.1886-.1822-.4412-.283-.7034-.2807s-.51301.1075-.69842.2929-.29058.4362-.29285.6984c-.00228.2622.09851.5148.28067.7034l3 3c.0983.0982.2159.1748.3454.2251.1295.0502.2681.0729.4069.0665.1387-.0063.2747-.0414.3991-.1032.1244-.0617.2347-.1487.3236-.2554z"
                                fill="#393a37" fill-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="success__title">Delete directory successfully</div>
                </div>
            @endif

            @if (session('warning'))
                <div class="failed" id="failed">
                    <div class="failed__icon">
                        <svg fill="none" height="24" viewBox="0 0 24 24" width="24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="failed__title">Delete category failed</div>
                </div>
            @endif
            <div class="category-list">
                @foreach ($categories as $category)
                    <div class="category">
                        <h2>{{ $category->name }}</h2>
                        <button class="btn btn-primary"
                            onclick="window.location='{{ route('categories.edit', $category) }}'">Edit</button>
                        <button class="btn btn-danger"
                            onclick="window.location='{{ route('categories.delete', ['id' => $category->id_category]) }}'">Delete</button>

                    </div>
                @endforeach
                <!-- More categories -->
            </div>
            <button class="btn btn-success add-category-btn"
                onclick="window.location='{{ route('categories.create') }}'">Add
                Category</button>
        </div>
    </main>
    <!-- MAIN -->
@endsection
<style>
    .container {
        padding: 20px;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .category-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .category {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
    }

    .category h2 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .category button {
        margin-top: 10px;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-success {
        background-color: #28a745;
        color: #fff;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .add-category-btn {
        margin-top: 20px;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        background-color: #28a745;
        color: #fff;
        transition: all 0.3s ease;
    }

    .add-category-btn:hover {
        background-color: #218838;
    }

    .success {
        display: flex;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        width: 320px;
        padding: 12px;
        flex-direction: row;
        align-items: center;
        justify-content: start;
        background: #EDFBD8;
        border-radius: 8px;
        box-shadow: 0px 0px 5px -3px #111;
        position: absolute;
        right: 10px;
        top: 100px;
    }

    .success__icon {
        width: 20px;
        height: 20px;
        transform: translateY(-2px);
        margin-right: 8px;
    }

    .success__icon path {
        fill: #84D65A;
    }

    .success__title {
        font-weight: 500;
        font-size: 14px;
        color: #2B641E;
    }

    .success__close {
        width: 20px;
        height: 20px;
        cursor: pointer;
        margin-left: auto;
    }

    .success__close path {
        fill: #2B641E;
    }

    .failed {
        display: flex;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        width: 320px;
        padding: 12px;
        flex-direction: row;
        align-items: center;
        justify-content: start;
        background-color: #fef2f2;
        border-radius: 8px;
        box-shadow: 0px 0px 5px -3px #111;
        position: absolute;
        right: 10px;
        top: 100px;
    }

    .failed__icon {
        width: 20px;
        height: 20px;
        transform: translateY(1px);
        margin-right: 8px;
    }

    .failed__icon path {
        fill: #f87171;
    }

    .failed__title {
        font-weight: 500;
        font-size: 14px;
        color: #991b1b;
    }
</style>
<script>
    // Tự động ẩn thông báo sau 5 giây
    setTimeout(function() {
        document.getElementById('success').style.display = 'none';
    }, 3000);
    setTimeout(function() {
        document.getElementById('failed').style.display = 'none';
    }, 3000);
</script>
