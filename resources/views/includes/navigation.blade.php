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
        <a href="{{ route('login') }}">Login</a>
    </div>
</nav>