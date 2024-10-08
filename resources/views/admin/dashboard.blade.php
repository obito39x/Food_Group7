<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="short icon" href="{{ asset('image/short_icon.png') }}">
    <!-- My CSS -->
    <link rel="stylesheet" href="{{ asset('/css/management/dashboard.css') }}">

    <title>AdminFood</title>
</head>


<body>


    <!-- SIDEBAR -->
    <section id="sidebar">
        {{-- <a href="{{route('dashboard')}}" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminHub</span>
		</a> --}}
        <div class="brand logo">
            <a href="{{ route('home') }}"><img src="{{ asset('image/logo.png') }}"></a>
        </div>
        <ul class="side-menu top">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="mystore {{ request()->routeIs('mystore') ? 'active' : '' }}">
                <a href="{{ route('mystore') }}">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">My Store</span>
                </a>
            </li>
            <li class="users {{ request()->routeIs('users') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}">
                    <i class='bx bx-user'></i>
                    <span class="text">Users</span>
                </a>
            </li>
            <li class="blogs {{ request()->routeIs('blogs') ? 'active' : '' }}">
                <a href="{{ route('admin.blog') }}">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Blogs</span>
                </a>
            </li>
            
        </ul>
        <ul class="side-menu">
            <li>
                <a href="{{ route('logout') }}" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->



    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            {{-- <a href="#" class="nav-link">Categories</a> --}}
            {{-- <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form> --}}
            {{-- <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label> --}}
            {{-- <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a> --}}
            @php
                $account = Illuminate\Support\Facades\Auth::user();

                $user = \App\Models\User::where('id_account', $account->id)->first();
            @endphp
            <a href="" class="profile">
                <img src="{{$user->img}}">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        @yield('content')
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->


    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy tất cả các liên kết trong sidebar
            const sidebarLinks = document.querySelectorAll("#sidebar .side-menu a");

			// Lặp qua mỗi liên kết
			sidebarLinks.forEach(link => {
				// Bắt sự kiện khi liên kết được nhấp vào
				link.addEventListener("click", function () {
					// Lấy tất cả các phần tử li cùng cấp
					const siblings = this.parentNode.parentNode.querySelectorAll("li");

					// Loại bỏ lớp active từ tất cả các phần tử li cùng cấp
					siblings.forEach(item => {
						item.classList.remove("active");
					});

					// Thêm lớp active cho phần tử li chứa liên kết được nhấp vào
					this.parentNode.classList.add(".active");
				});
			});
		});
	</script>
</body>


</html>
