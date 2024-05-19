@extends('admin.dashboard') <!-- Extend the main layout -->

@section('content')
    <style>
        .todo .head form {
            display: flex;
            align-items: center;
        }

        .todo .head input[type="text"] {
            width: calc(100% - 40px);
            /* Trừ đi chiều rộng của nút */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            font-size: 14px;
        }

        .todo .head button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
        }

        .todo .head button i {
            font-size: 18px;
        }

        .todo .head button:hover {
            background-color: #45a049;
        }

        .todo .todo-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .todo .todo-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .todo .todo-list li.completed p {
            text-decoration: line-through;
            color: #999;
        }

        .todo .todo-list li p {
            margin: 0;
            flex: 1;
        }

        .todo .todo-list li form {
            display: inline-block;
        }

        .todo .todo-list li button {
            background: none;
            border: none;
            cursor: pointer;
        }

        .todo .todo-list li button i {
            color: #ff0000;
        }

        .todo .todo-list li button i:hover {
            color: #b30000;
        }
    </style>
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="#">Home</a>
                    </li>
                </ul>
            </div>
            
        </div>

        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="text">
                    <h3>{{ $new_order->count() }}</h3>
                    <p>New Order</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-group'></i>
                <span class="text">
                    <h3>{{ $visitors }}</h3>
                    <p>Visitors</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-dollar-circle'></i>
                <span class="text">
                    <h3>${{ $total_sales }}</h3>
                    <p>Total Sales</p>
                </span>
            </li>
        </ul>


        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Recent Orders</h3>
                    <form action="{{ route('dashboard') }}" method="GET">
                        <input placeholder="Search ..." type="text" name="text" class="input">
                        {{-- <i class='bx bx-search'></i> --}}
                        <div class="filter-box">
                            @foreach ($states as $status)
                                <input type="checkbox" name="status[]" id="status_{{ $status->id }}"
                                    value="{{ $status->id }}"
                                    {{ in_array($status->id, (array) request('status')) ? 'checked' : '' }}>
                                <label for="category_{{ $status->id }}"
                                    class="{{ in_array($status->id, (array) request('status')) ? 'active' : '' }}">{{ $status->name }}</label>
                            @endforeach
                            <button type="submit" id="apply-filter">Apply Filter</button>
                        </div>

                        <i class='bx bx-filter' id="filter-toggle"></i>
                    </form>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Date Order</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @php
                                $user = \App\Models\User::find($order->id_user);
                            @endphp
                            <tr>
                                <td>
                                    @if ($user != null)
                                        <img src="{{ asset($user->img) }}">
                                    @endif
                                    @if ($user != null)
                                        <p>{{ $user->username }}</p>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($order->date_order)->format('d/m/Y') }}</td>
                                @if ($order->status_id == 1)
                                    <td><span class="status completed">Completed</span></td>
                                @elseif($order->status_id == 2)
                                    <td><span class="status pending">Pending</span></td>
                                @else
                                    <td><span class="status process">Process</span></td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @php
                $account = Illuminate\Support\Facades\Auth::user();
            @endphp
            @if ($account->role == 'admin')
                <div class="todo">
                    <div class="head">
                        <h3>Todos</h3>
                        <form action="{{ route('todos.store') }}" method="POST">
                            @csrf
                            <input type="text" name="title" placeholder="Add new todo">
                            <button type="submit"><i class='bx bx-plus'></i></button>
                        </form>
                    </div>
                    <ul class="todo-list">
                        @foreach ($todos as $todo)
                            <li class="{{ $todo->is_completed ? 'completed' : 'not-completed' }}">
                                <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <p>{{ $todo->title }}</p>
                                    <input type="checkbox" name="is_completed" {{ $todo->is_completed ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                </form>
                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class='bx bx-trash'></i></button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="todo">
                    <div class="head">
                        <h3>Todos</h3>
                    </div>
                    <ul class="todo-list">
                        @foreach ($todos as $todo)
                            <li class="{{ $todo->is_completed ? 'completed' : 'not-completed' }}">
                                <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <p>{{ $todo->title }}</p>
                                    <input type="checkbox" name="is_completed" {{ $todo->is_completed ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </main>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const filterToggle = document.getElementById("filter-toggle");
        const filterBox = document.querySelector(".filter-box");

        filterToggle.addEventListener("click", function() {
            filterBox.classList.toggle("show");
        });

        const applyFilterBtn = document.getElementById("apply-filter");
        applyFilterBtn.addEventListener("click", function() {
            const checkedCheckboxes = document.querySelectorAll(
                '.filter-box input[type="checkbox"]:checked');
            const selectedFilters = Array.from(checkedCheckboxes).map(checkbox => checkbox.value);
            // Thực hiện các thao tác lọc với selectedFilters (ví dụ: lọc danh sách đơn hàng)
        });
    });
</script>
