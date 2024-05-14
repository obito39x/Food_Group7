<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="short icon" href="{{ asset('image/short_icon.png') }}">
    <title>Product Management Edit</title>
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: #F9F9F9;
}

main {
    margin-top: 56px;
    padding: 24px;
}

.formedit {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: 600;
}

input[type="text"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #eee;
    border-radius: 4px;
    margin-top: 5px;
}

button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #3C91E6;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #2980B9;
}

.table-container {
    margin-top: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
}

.table-container table {
    width: 100%;
    border-collapse: collapse;
}

.table-container th,
.table-container td {
    padding: 12px;
    border-bottom: 1px solid #eee;
}

.table-container th {
    background-color: #F9F9F9;
    font-weight: 600;
}

.table-container tr:hover {
    background-color: #F0F0F0;
}

.product-image {
    max-width: 100px;
    max-height: 100px;
    border-radius: 4px;
}

.button-back {
    margin-top: 20px;
    width: 20%;
    padding: 12px;
    background-color: #eee;
    color: #342E37;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button-back:hover {
    background-color: #ddd;
}

</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Tìm li có class mystore
        const mystoreLi = document.querySelector("#sidebar .mystore");

        // Thêm lớp active cho li mystore
        mystoreLi.classList.add("active");
    });
</script>
@extends('admin.dashboard') <!-- Kế thừa layout chính -->

@section('content')
<button type="button" class="button-back" onclick="window.history.back()">Back</button>
<div class="formedit">
    <form action="{{ route('updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" required>{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image_url">Current Image:</label>
            <img src="{{ asset($product->image_url) }}" alt="Current Image" style="max-width: 100px; max-height: 100px;">
        </div>
        <div class="form-group">
            <label for="image_url">Image:</label>
            <input type="file" name="image" id="image" onchange="previewImage(event)">
            <img id="preview" src="#" alt="Preview Image" style="max-width: 100px; max-height: 100px; margin-top: 10px; display: none;">
        </div>
        <div class="form-group">
            <label for="rating">Rating:</label>
            <input type="number" name="rating" id="rating" min="1" max="5" value="{{ $product->rating }} required">
        </div>
        <div class="form-group">
            <label for="old_price">Old Price:</label>
            <input type="number" name="old_price" id="old_price" value="{{ $product->old_price }} required">
        </div>
        <div class="form-group">
            <label for="new_price">New Price:</label>
            <input type="number" name="new_price" id="new_price" value="{{ $product->new_price }} required">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category" id="category">
                @foreach($categories as $category)
                    <option value="{{ $category->id_category }}" {{ $product->id_categories == $category->id_category ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
</div>
   
</html>
<script>
    function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function() {
        var img = document.getElementById('preview');
        img.src = reader.result;
        img.style.display = 'block';
    }
    reader.readAsDataURL(input.files[0]);
}
</script>

@endsection
