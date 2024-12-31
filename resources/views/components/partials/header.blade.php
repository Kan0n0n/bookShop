<header class="header">
    <div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="https://www.facebook.com/@HCMUE.VN" class="fab fa-facebook-f"></a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> {{ session('error') }}
        </div>
    @endif

    <div class="header-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex">
                <a href="{{ route('index') }}" class="logo">
                    <img src="{{ asset('images/logo-removebg-preview.png') }}" alt="logo" class="img">
                    {{-- LOTU --}}
                </a>


                {{-- <nav class="navbar">
                <a href="{{ request()->routeIs('index') ? '#' : route('index') }}"
                    class="{{ request()->routeIs('index') ? 'chosen' : '' }}">Home</a>
                <a href="{{ request()->routeIs('about') ? '#' : route('about') }}"
                    class="{{ request()->routeIs(patterns: 'about') ? 'chosen' : '' }}">About</a>
                <a href="{{ request()->routeIs('book.create') ? '#' : route('book.create') }}"
                    class="{{ request()->routeIs(patterns: 'book.create') ? 'chosen' : '' }}">Explore Books</a>
                <a href="{{ request()->routeIs('contact') ? '#' : route('contact') }}"
                    class="{{ request()->routeIs(patterns: 'contact') ? 'chosen' : '' }}">Contact</a>
                <a href="{{ request()->routeIs('borrow') ? '#' : route('borrow') }}"
                    class="{{ request()->routeIs(patterns: 'borrow') ? 'chosen' : '' }}">Borrow
                    Status</a>
                </nav> --}}

                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{ request()->routeIs('index') ? '#' : route('index') }}"
                                    class="nav-link {{ request()->routeIs('index') ? 'chosen' : '' }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ request()->routeIs('about') ? '#' : route('about') }}"
                                    class="nav-link {{ request()->routeIs('about') ? 'chosen' : '' }}">About</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ request()->routeIs('book.create') ? '#' : route('book.create') }}"
                                    class="nav-link {{ request()->routeIs('book.create') ? 'chosen' : '' }}">Explore
                                    Books</a>
                            </li>
                            @if (Auth::check())
                                <li class="nav-item">
                                    <a href="{{ request()->routeIs('borrow') ? '#' : route('borrow') }}"
                                        class="nav-link {{ request()->routeIs('borrow') ? 'chosen' : '' }}">Borrow
                                        Status</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>

                <div class=" icons">
                    <div id="cart-btn" class="fa-solid fa-cart-shopping" onclick="openCart()"></div>
                    @if (Auth::check())
                        <div id="user-btn" class="user-btn">
                            <img src="{{ asset(Auth::user()->avatar_path) }}" alt="user" class="user-img">
                        </div>
                    @else
                        <div id="user-btn" class="fas fa-user"></div>
                    @endif
                </div>

                <div class="user-box" style="z-index: 1000;">
                    @if (Auth::check())
                        <p>Hello, {{ Auth::user()->name }}</p>
                        <a href="{{ route('activate', ['id' => Auth::user()->id]) }}" class="white-btn">Activate
                            Account</a>
                        <a href="{{ route('user.edit', ['id' => Auth::user()->id]) }}" class="primary-btn">Edit
                            Profile</a>
                        <a href="{{ route('user.password.edit', ['id' => Auth::user()->id]) }}" class="blue-btn">Change
                            Password</a>
                        @if (Auth::user()->role == 1)
                            <a href="{{ route('admin') }}" class="delete-btn">
                                Foward to Admin</a>
                        @endif
                        <a href="{{ route('logout') }}" class="delete-btn">logout</a>
                    @else
                        <a href="{{ route('login') }}" class="white-btn">Login</a>
                        <a href="{{ route('signup') }}" class="delete-btn">register</a>
                    @endif
                </div>

                <div class="cart-box" id="cart">
                    {{-- <div class="cart-item">
                    <img src="{!! asset('images/bookCovers/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg') !!}" class="cart-img">
                    <div class="cart-item-info">
                        <p>Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</p>
                        <p>Author: Fujiko F. Fujio</p>
                    </div>
                    <button type="button" class="cart-item-del-button">x</button>
                </div>
                <div class="cart-item">
                    <img src="{!! asset('images/bookCovers/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg') !!}" class="cart-img">
                    <div class="cart-item-info">
                        <p>Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</p>
                        <p>Author: Fujiko F. Fujio</p>
                    </div>
                    <button type="button" class="cart-item-del-button">x</button>
                </div>
                <div class="cart-item">
                    <img src="{!! asset('images/bookCovers/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg') !!}" class="cart-img">
                    <div class="cart-item-info">
                        <p>Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</p>
                        <p>Author: Fujiko F. Fujio</p>
                    </div>
                    <button type="button" class="cart-item-del-button">x</button>
                </div>
                <div class="cart-item">
                    <img src="{!! asset('images/bookCovers/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg') !!}" class="cart-img">
                    <div class="cart-item-info">
                        <p>Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</p>
                        <p>Author: Fujiko F. Fujio</p>
                    </div>
                    <button type="button" class="cart-item-del-button">x</button>
                </div>
                <div class="cart-item">
                    <img src="{!! asset('images/bookCovers/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg') !!}" class="cart-img">
                    <div class="cart-item-info">
                        <p>Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</p>
                        <p>Author: Fujiko F. Fujio</p>
                    </div>
                    <button type="button" class="cart-item-del-button">x</button>
                </div>
                <div class="cart-info">
                    <p><span>Items in cart:</span> <span>5</span></p>
                    <p><span>Due date:</span> <span>2021-12-31</span></p>
                    <p><span>Borrow fee:</span> <span>10,000 VND</span></p>
                    <a href="#" class="option-btn">
                        <i class="fas fa-shopping-cart"></i>
                        Proceed to checkout
                    </a>
                </div> --}}
                    @if (!Auth::check())
                        <p class="no-items"> Please <a href="{!! route('login') !!}"> login </a> to view your cart</p>
                    @else
                        @if (isset($cart) && $cart->items->count() > 0)
                            @foreach ($cart->items as $item)
                                <div class="cart-item">
                                    <img src="{{ asset($item->book_copy->book->book_cover_image_path) }}"
                                        class="cart-img">
                                    <div class="cart-item-info">
                                        <p>{{ $item->book_copy->book->title }}</p>
                                        <p>Author: {{ $item->book_copy->book->author->name }}</p>
                                    </div>
                                    <form action="{{ route('cart.remove', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                        <input type="hidden" name="book_copy_id" value="{{ $item->book_copy_id }}">
                                        <input type="hidden" name="book_id" value="{{ $item->book_copy->book_id }}">
                                        <button type="submit" class="cart-item-del-button">x</button>
                                    </form>
                                </div>
                            @endforeach
                            <div class="cart-info">
                                <p><span>Items in cart:</span> <span>{{ $cart->items->count() }}</span></p>
                                <button class="option-btn"
                                    onclick="window.location.href='{{ route('checkout', ['id' => $cart->id]) }}'">
                                    <i class="fas fa-shopping-cart"></i>
                                    Proceed to checkout
                                </button>
                            </div>
                        @else
                            <p class="no-items">Your cart is empty</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
