<div class="alert-container position-fixed top-0 end-0 p-3" style="z-index: 1100">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

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
            <a href="{{ route('index') }}" class="logo">
                <img src="{{ asset('images/logo-removebg-preview.png') }}" alt="logo" class="img">
                {{-- LOTU --}}
            </a>

            <nav class="navbar">
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
            </nav>

            <div class=" icons">
                {{-- <div id="menu-btn" class="fas fa-bars"></div> --}}
                <div id="cart-btn" class="fa-solid fa-cart-shopping" onclick="openCart()"></div>
                @if (Auth::check())
                    <div id="user-btn" class="user-btn">
                        <img src="{{ asset(Auth::user()->avatar_path) }}" alt="user" class="user-img">
                    </div>
                @else
                    <div id="user-btn" class="fas fa-user"></div>
                @endif
            </div>

            <div class="user-box">
                @if (Auth::check())
                    <p>Hello, {{ Auth::user()->name }}</p>
                    <a href="{{ route('logout') }}" class="delete-btn">logout</a>
                @else
                    <a href="{{ route('login') }}" class="white-btn">Login</a>
                    <a href="{{ route('signup') }}" class="delete-btn">register</a>
                @endif
            </div>

            {{-- <div class="search-box">
                <input type="text" placeholder="search here" class="search-input">
            </div> --}}

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
                                <img src="{{ asset($item->book_copy->book->book_cover_image_path) }}" class="cart-img">
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
                            {{-- <p><span>Due date:</span> <span>{{ $cart->due_date }}</span></p> --}}
                            <p><span>Borrow fee:</span> <span>{{ $cart->items->count() * 2000 }} VND</span></p>
                            <a href="#" class="option-btn">
                                Proceed to checkout
                            </a>
                        </div>
                    @else
                        <p class="no-items">Your cart is empty</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
</header>
