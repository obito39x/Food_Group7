@extends('admin.dashboard') <!-- Extend the main layout -->

@section('content')
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
            <a href="#" class="btn-download">
                <i class='bx bxs-cloud-download'></i>
                <span class="text">Download PDF</span>
            </a>
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
            <div class="todo">
                <div class="head">
                    <h3>Todos</h3>
                    <i class='bx bx-plus'></i>
                    <i class='bx bx-filter'></i>
                </div>
                <ul class="todo-list">
                    <li class="completed">
                        <p>Todo List</p>
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="completed">
                        <p>Todo List</p>
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="not-completed">
                        <p>Todo List</p>
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="completed">
                        <p>Todo List</p>
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="not-completed">
                        <p>Todo List</p>
                        <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                </ul>
            </div>
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
