<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="short icon" href="{{ asset('image/short_icon.png') }}">
	<!-- My CSS -->
	<link rel="stylesheet" href="{{asset('/css/management/dashboard.css')}}">

	<title>AdminHub</title>
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
				<a href="{{route('dashboard')}}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="mystore {{ request()->routeIs('manageProduct') ? 'active' : '' }}">
				<a href="{{route('manageProduct')}}">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">My Store</span>
				</a>
			</li>
			<li class="order {{ request()->routeIs('dashboard.order') ? 'active' : '' }}">
				<a href="{{route('dashboard.order')}}">
					<svg class="bx svg-icon" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M733.280244 645.89143c-54.359049 0-98.429777 44.246737-98.429777 98.812493 0 54.606689 44.069705 98.841146 98.429777 98.841146s98.429777-44.234457 98.429777-98.841146C831.710021 690.138166 787.639293 645.89143 733.280244 645.89143zM798.258141 718.952422c0 0-70.821999 69.891813-71.161736 70.244854-8.068769 7.971555-12.287861 6.702656-15.875572 3.081175l-42.341341-42.518373c-3.597945-3.598968-3.388167-9.66615 0.457418-13.522991s9.865695-4.068665 13.462616-0.447185l34.643008 34.781154 67.068512-65.75868c3.8814-3.810792 10.113335-3.727904 13.922081 0.163729C802.221406 708.886159 802.149774 715.142653 798.258141 718.952422zM406.700257 248.419859l150.802588 0c15.897062 0 29.290093-15.004739 29.290093-33.512255 0-18.49626-13.368472-33.441647-30.137391-33.441647l-149.95529 0c-16.743336 0-30.125111 14.944364-30.125111 33.441647C376.576169 233.416144 389.992737 248.419859 406.700257 248.419859zM721.910289 615.155405c17.553795 0 34.264385 3.656273 49.408293 10.252505l0-331.22375c0-45.398979-24.387433-76.853365-75.464739-76.853365l-67.963904 0c0.681522 3.63376 1.081635 7.349385 1.081635 11.100826 0.035816 28.137851-20.306488 55.82954-44.493354 55.82954l-208.795397 0c-25.451672 0-45.811372-27.691689-45.811372-55.82954 0.035816-3.751441 0.417509-7.467065 1.116427-11.100826l-68.792782 0c-55.282071 0-68.858274 31.454386-68.858274 76.853365l0 449.64893c0 48.773843 19.442818 76.077699 73.043596 76.077699l360.027773 0c-18.014282-21.659299-28.856211-49.526997-28.856211-79.933517C597.55198 671.042249 653.240303 615.155405 721.910289 615.155405zM338.448804 388.063293l294.685579 0c10.886955 0 20.10592 10.17064 20.917402 21.929452 0 10.958586-11.464099 22.717398-22.340821 22.717398L336.19753 432.710143c-10.906397 0-17.832134-11.757788-17.832134-22.717398C318.365396 399.021879 327.566966 388.063293 338.448804 388.063293zM471.149105 684.799578 336.19753 684.799578c-10.906397 0-17.832134-11.746532-17.832134-22.717398 0-10.946306 9.201569-21.905916 20.083407-21.905916l134.122697 0c10.900258 0 20.106943 10.148128 20.918425 21.905916C493.489926 673.053046 482.038106 684.799578 471.149105 684.799578zM334.985936 560.713468c-10.894118 0-21.753443-13.415544-21.753443-24.375154 0-10.912537 9.18929-20.259416 20.095687-20.259416l294.677393 0c10.889001 0 20.084431 8.501628 20.919449 20.259416 0 10.959609-7.515161 24.375154-18.413372 24.375154L334.985936 560.713468z"  /></svg>
					<span class="text">Order</span>
				</a>
			</li>
			<li >
				<a href="#">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li >
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
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
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="image/img_dashboard/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		@yield('content') 
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="{{asset('js/script.js')}}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy tất cả các liên kết trong sidebar
            const sidebarLinks = document.querySelectorAll("#sidebar .side-menu a");

            // Lặp qua mỗi liên kết
            sidebarLinks.forEach(link => {
                // Bắt sự kiện khi liên kết được nhấp vào
                link.addEventListener("click", function() {
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