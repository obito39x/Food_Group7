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
    font-family: Arial, sans-serif;
}
nav{
    display: flex;
    align-items: center;
    justify-content: space-around;
    background: #fff;
    position: fixed;
    right: 0;
    left: 0;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
    z-index: 1000;
}

nav .logo img{
    width: 120px;
    margin: 20px 0;
    position: relative;
    left: -45%;
    cursor: pointer;
}

nav ul{
    list-style: none;
}

nav ul li{
    display: inline-block;
    margin: 0 10px;
}

nav ul li a{
    color: #000;
    text-decoration: none;
    transition: 0.3s;
}

nav ul li a:hover{
    color: #facc22;
}
.current {
    color: #facc22; /* Màu cho liên kết của trang hiện tại */
}
/* nav ul li a.action{
    color: #facc22;
} */

nav .login a{
    color: #000;
    text-decoration: none;
    border: 2px solid #facc22;
    border-radius: 20px;
    padding: 7px 20px;
    transition: 0.3s;
}

nav .login a:hover{
    background: #facc22;
    color: #fff;
}
.formedit{
    padding: 100px;
}
/* Form styling */
.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 5px;
}

textarea {
    height: 100px;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

/* Container styling */
.Management {
    padding: 20px;
}

/* Table container styling */
.table-container {
    margin-top: 20px;
}

/* Table styling */
.table-container table {
    width: 100%;
    border-collapse: collapse;
}

.table-container th,
.table-container td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
}

.table-container th {
    background-color: #f2f2f2;
    text-align: left;
}

/* Hover effect */
.table-container tr:hover {
    background-color: #f2f2f2;
}

/* Product image styling */
.product-image {
    max-width: 100px;
    max-height: 100px;
}


</style>
@include('includes.navigation')

<div class="formedit">
    <form action="{{ route('updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description">{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image_url">Image:</label>
            <input type="file" name="image" id="image">
        </div>
        <div class="form-group">
            <label for="rating">Rating:</label>
            <input type="number" name="rating" id="rating" value="{{ $product->rating }}">
        </div>
        <div class="form-group">
            <label for="old_price">Old Price:</label>
            <input type="number" name="old_price" id="old_price" value="{{ $product->old_price }}">
        </div>
        <div class="form-group">
            <label for="new_price">New Price:</label>
            <input type="number" name="new_price" id="new_price" value="{{ $product->new_price }}">
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
