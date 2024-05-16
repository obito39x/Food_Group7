@extends('admin.dashboard') <!-- Kế thừa layout của trang dashboard -->

@section('content')
    <!-- MAIN -->
    <main>
        <div class="container">
            <h1>Add Category</h1>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="category_name">Category Name:</label>
                    <input type="text" class="form-control" id="category_name" name="name" required>
                </div>
                <button type="submit" class="btn btn-success">Add Category</button>
            </form>
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

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        background-color: #28a745;
        color: #fff;
        transition: all 0.3s ease;
    }

    button:hover {
        background-color: #218838;
    }
</style>