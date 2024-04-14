<nav>
    <div class="logo">
        <a href="{{ route('home') }}"><img src="{{ asset('image/logo.png') }}"></a>
    </div>
    <ul>
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'current' : '' }}">Home</a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'current' : '' }}">About</a></li>
        <li><a href="{{ route('menu') }}" class="{{ request()->routeIs('menu') ? 'current' : '' }}">Menu</a></li>
        <li><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'current' : '' }}">Gallery</a></li>
        <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'current' : '' }}">Blog</a></li>
    </ul>
    <div class="login">
        @if(Auth::check())
        <button type="button" class="btn position-relative btn-icon" id="btn-3" onclick="toggleMenu()">
            <img src="{{ asset('image/profile.png') }}" alt="Profile Icon" width="30px">
            <div class="menu-profile text-uppercase text-dark submenu" id="subMenu">
            @if(Auth::check())
                <h3>Xin chào!<br><span>{{Auth::user()->username}}</span></h3>
            @else
                <h3>Xin chào!<br><span>Khách</span></h3>
            @endif
                <ul>
                    <li><img src="{{ asset('image/profile.png') }}" alt="Profile"><a href="{{ route('profile') }}">Hồ sơ</a></li>
                    <li><img src="{{ asset('image/logout.png') }}" alt="Logout"><a href="{{ route('logout') }}">Đăng xuất</a></li>
                </ul>
            </div>
        </button>
        @else
            
            <a href="{{ route('login') }}">Login</a>
        @endif
    </div>
</nav>