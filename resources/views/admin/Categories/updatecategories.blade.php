@extends('admin.dashboard') <!-- Kế thừa layout của trang dashboard -->

@section('content')
<main>
    <form class="formedit" action="{{ route('categories.update', $category->id_category) }}" method="POST">
        @csrf
        @method('PUT')
    
        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" value="{{ $category->name }}">
    
        <button type="submit">Save Changes</button>
    </form>
</main>

@endsection
<style>
    .formedit {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 20px;
}

button[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

.error {
    color: red;
    margin-top: 5px;
}
</style>