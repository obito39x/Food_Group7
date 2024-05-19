@extends('admin.dashboard') <!-- Kế thừa layout chính -->

@section('content')
<style>
    main {
        margin: 20px;
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

    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .alert {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 20px;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Tìm li có class mystore
        const mystoreLi = document.querySelector("#sidebar .users");

        // Thêm lớp active cho li mystore
        mystoreLi.classList.add("active");
    });
</script>
<main>
    <h1>User Editing</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="username" id="name" class="form-control" value="{{ $user->username }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</main>
    
@endsection