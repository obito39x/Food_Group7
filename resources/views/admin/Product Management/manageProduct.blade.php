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
    <script src="{{ asset('/js/menu.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
@include('includes.navigation') 

<div class="Management">   
    <div class="addProduct">
        <a href="{{ route('createProduct') }}" class="buttonAdd"><span>Add</span><i class="fa-solid fa-plus"></i></a>
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
                        <a href="{{ route('editProduct', $product) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('deleteProduct', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="buttonsubmit" type="submit">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>