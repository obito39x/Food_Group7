@php
    if (Auth::check()) {
        $account = Auth::user();
        $user = $account->user;
    }
@endphp
<nav>
    <div class="logo">
        <a href="{{ route('home') }}"><img src="{{ asset('image/logo.png') }}"></a>
    </div>
    <ul>
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'current' : '' }}">Home</a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'current' : '' }}">About</a></li>
        <li><a href="{{ route('menu') }}" class="{{ request()->routeIs('menu*') ? 'current' : '' }}">Menu</a></li>
        <li><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'current' : '' }}">Gallery</a>
        </li>
        <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'current' : '' }}">Blog</a></li>
    </ul>
    <div class="login-cart">
        <div class="notifications">
            <div class="btn btn-icon">
                <i class="fa-solid fa-bell"></i>
            </div>
            <div class="notification-dropdown">
                <div class="notification-head">
                    <h3><b>Notification</b></h3>
                    <button class="btn-notifacation">
                        <svg viewBox="0 0 448 512" class="bell">
                            <path
                                d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z">
                            </path>
                        </svg>
                        Mark all as read
                    </button>
                </div>
                <div class="btn-cate">
                    <button class="btn-all">
                        All
                    </button>
                    <button class="btn-unread">
                        Unread
                    </button>
                </div>

                <hr>
                @php
                    if (Illuminate\Support\Facades\Auth::check()) {
                        $account = Illuminate\Support\Facades\Auth::user();
                        $user = $account->user->id;
                        $notifications = App\Models\Notification::where('user_id', $user)->orderBy('created_at', 'desc')->get();
                    } else {
                        $notifications = [];
                    }
                @endphp
                <!-- Nơi hiển thị danh sách thông báo -->
                @foreach ($notifications as $notification)
                    <div class="notification-item">
                        <div class="notification">
                            <div class="notification-pic">
                                @if (!empty($user->img))
                                    <div class="notification-avatar">
                                        <img src="{{ $user->img }}" alt="">
                                    </div>
                                @else
                                    <svg fill="none" viewBox="0 0 24 24" height="20" width="20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linejoin="round" fill="#707277" stroke-linecap="round"
                                            stroke-width="2" stroke="#707277"
                                            d="M6.57757 15.4816C5.1628 16.324 1.45336 18.0441 3.71266 20.1966C4.81631 21.248 6.04549 22 7.59087 22H16.4091C17.9545 22 19.1837 21.248 20.2873 20.1966C22.5466 18.0441 18.8372 16.324 17.4224 15.4816C14.1048 13.5061 9.89519 13.5061 6.57757 15.4816Z">
                                        </path>
                                        <path stroke-width="2" fill="#707277" stroke="#707277"
                                            d="M16.5 6.5C16.5 8.98528 14.4853 11 12 11C9.51472 11 7.5 8.98528 7.5 6.5C7.5 4.01472 9.51472 2 12 2C14.4853 2 16.5 4.01472 16.5 6.5Z">
                                        </path>
                                    </svg>
                                @endif
                            </div>
                            <div class="notification-info">
                                <span>{{ $notification->content }}</span>
                                <p>{{ $notification->getTimeDiff() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>



        <div class="cart">
            <a href="{{ route('cart') }}" class="btn btn-icon {{ request()->routeIs('cart') ? 'current' : '' }}">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
        </div>
        <div class="wishlist">
            <a href="{{ route('wishlist') }}" class="btn btn-icon {{ request()->routeIs('wisht') ? 'current' : '' }}">
                <i class="fa-solid fa-heart fa-"></i>
            </a>
        </div>

        <div class="login">
            @if (Auth::check())
                <button type="button" class="btn position-relative btn-icon" id="btn-3" onclick="toggleMenu()">
                    <img src="{{ asset('image/profile.png') }}" alt="Profile Icon" width="30px">
                    <div class="menu-profile text-uppercase text-dark submenu" id="subMenu">
                        @if (Auth::check())
                            <h3>Xin chào!<br><span>{{ Auth::user()->username }}</span></h3>
                        @else
                            <h3>Xin chào!<br><span>Khách</span></h3>
                        @endif
                        <ul>
                            <li><img src="{{ asset('image/profile.png') }}" alt="Profile"><a
                                    href="{{ route('profile') }}">Profile</a></li>
                            <li><img src="{{ asset('image/logout.png') }}" alt="Logout"><a
                                    href="{{ route('order.history') }}">Order History</a></li>
                            <li><img src="{{ asset('image/key.png') }}" alt="ResetPassword"><a
                                    href="{{ route('changePassword') }}">Reset Password</a></li>
                            <li><img src="{{ asset('image/logout.png') }}" alt="Logout"><a
                                    href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </button>
            @else
                <a class="btnlogin" href="{{ route('login') }}">Login</a>
            @endif
        </div>
    </div>
</nav>

