<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/css/management/manageProduct.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="short icon" href="{{ asset('image/short_icon.png') }}">
    <title>Product Management</title>
</head>
@include('includes.navigation') 

<div class="Management">   
    <div class="addProduct">
        <button><span>Add</span><i class="fa-solid fa-plus"></i></button>
    </div>
    <div class="table-container">
       
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
                    <th>Created At</th>
                    <th>Updated At</th>
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
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->update_at }}</td>
                    <td class="edit">
                        <a href=""><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href=""><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>