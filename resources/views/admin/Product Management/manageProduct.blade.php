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
                <li><a href="" class="active">Product Management</a></li>
            </ul>
        </div>
        <button  title="Add" class="cssbuttons-io-button" onclick="window.location='{{ route('createProduct') }}'">
            <svg height="25" width="25" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"></path><path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z" fill="currentColor"></path></svg>
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
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td><img src="{{ asset($product->image_url) }}" class="product-image"></td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->rating }}</td>
                    <td>${{ $product->old_price }}</td>
                    <td>${{ $product->new_price }}</td>
                    <td class="edit">
                        <a href="{{ route('editProduct', $product) }}"><i class="bx bxs-edit"></i></a>
                        <form action="{{ route('deleteProduct', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="buttonsubmit" type="submit">
                                <i class="bx bxs-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

@endsection
