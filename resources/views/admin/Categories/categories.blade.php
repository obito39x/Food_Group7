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
            <div class="category-list">
                @foreach ($categories as $category)
                    <div class="category">
                        <h2>{{ $category->name }}</h2>
                        <button class="btn btn-primary" onclick="window.location='{{ route('categories.edit', $category) }}'">Edit</button>
                        <button class="btn btn-danger" onclick="window.location='{{ route('categories.delete', ['id' => $category->id_category]) }}'">Delete</button>

                    </div>
                @endforeach
                <!-- More categories -->
            </div>
            <button class="btn btn-success add-category-btn" onclick="window.location='{{ route('categories.create') }}'">Add
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
</style>
