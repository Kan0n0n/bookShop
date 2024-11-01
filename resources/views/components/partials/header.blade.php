@if(session('success'))
<div class="alert">
    {{session('success')}}
    <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
</div>
@endif

<header class="header">
    <div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
        </div>
    </div>

    <div class="header-2">
        <div class="flex">
            <a href="{{route("index")}}" class="logo">Library Of The Unknown</a>

            <nav class="navbar">
                <a href="{{route("index")}}" class="{{request()->routeIs('index') ? 'chosen' : '' }}">Home</a>
                <a href="{{route("about")}}" class="{{request()->routeIs(patterns:'about') ? 'chosen' : ''}}">About</a>
                <a href="{{route("book.create")}}"
                    class="{{request()->routeIs(patterns:'book.create') ? 'chosen' : ''}}">Explore Books</a>
                <a href="{{route("contact")}}"
                    class="{{request()->routeIs(patterns:'contact') ? 'chosen' : ''}}">Contact</a>
                <a href="{{route("borrow")}}" class="{{request()->routeIs(patterns:'borrow') ? 'chosen' : ''}}">Borrow
                    Status</a>
            </nav>

            <div class=" icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="search-btn" class="fas fa-search"></div>
                <div id="user-btn" class="fas fa-user"></div>
            </div>

            <div class="user-box">
                @if(Auth::check())
                <p>Hello, {{Auth::user()->name}}</p>
                <a href="{{route('logout')}}" class="delete-btn">logout</a>
                @else
                <a href="{{route('login')}}" class="white-btn">Login</a>
                <a href="{{route('signup')}}" class="delete-btn">register</a>
                @endif
            </div>

            <div class="search-box">
                <input type="text" placeholder="search here" class="search-input">
            </div>
        </div>
    </div>

</header>