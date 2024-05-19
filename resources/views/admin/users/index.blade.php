<style>
    .btn-primary {
        display: inline-block;
        padding: 8px 12px;
        text-decoration: none;
        background-color: #007bff;
        /* Màu nền cho nút primary */
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Màu nền hover cho nút primary */
    }

    .btn-secondary {
        display: inline-block;
        padding: 8px 12px;
        text-decoration: none;
        background-color: #6c757d;
        /* Màu nền cho nút secondary */
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        /* Màu nền hover cho nút secondary */
    }
</style>
@extends('admin.dashboard') <!-- Kế thừa layout chính -->

@section('content')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Tìm li có class mystore
            const mystoreLi = document.querySelector("#sidebar .users");

            // Thêm lớp active cho li mystore
            mystoreLi.classList.add("active");
        });
    </script>
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Users</h1>
                <ul class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li><a href="{{ route('admin.users.index') }}" class="active">Users</a></li>
                </ul>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-data">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tên </i></th>
                            <th>Email</th>
                            <th>Vai Trò</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                @php
                                    $account = Illuminate\Support\Facades\Auth::user();
                                @endphp
                                @if ($account->role == 'admin')
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Chỉnh
                                        Sửa</a>
                                    <a href="{{ route('admin.users.assign-role', $user->id) }}"
                                        class="btn btn-secondary">Gán Vai Trò</a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

    </main>
@endsection
