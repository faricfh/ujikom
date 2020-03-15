<!-- Header Area Start -->
<header class="header-area clearfix">
    <!-- Close Icon -->
    <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <!-- Logo -->
    <div class="logo">
        <h1>FShop</h1>
    </div>
    <!-- Amado Nav -->
    <nav class="amado-nav">
        <ul>
            <li class="active"><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/shop') }}">Shop</a></li>
            <li><a href="{{ url('/cart') }}">Cart</a></li>
            @if (Auth::guard('customer')->check())
            <li><a href="{{ url('/checkout') }}">Checkout</a></li>
            @endif
        </ul>
    </nav>
    <!-- Cart Menu -->
    <div class="cart-fav-search mb-100">
        <a href="{{ url('/cart')}}" class="cart-nav"><img src="{{ asset('assets/frontend/img/core-img/cart.png') }}" alt=""> Cart (<b id="totalproduk"></b>)</a>
        <!-- <a href="#" class="fav-nav"><img src="{{ asset('assets/frontend/img/core-img/favorites.png') }}" alt=""> Favourite</a> -->
        <a href="#" class="search-nav"><img src="{{ asset('assets/frontend/img/core-img/search.png') }}" alt=""> Search</a>
        {{-- @if (Auth::guard('customer')->check())
        <a class="btn amado-btn w-100" href="{{ url('/logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form-customer').submit();">
            Logout
        </a>
        <form id="logout-form-customer" action="{{ url('/logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endif --}}
    </div>
    @if (Auth::guard('customer')->check())
        <div class="cart-btn mt-100">
            <a class="btn amado-btn w-100" href="{{ url('/logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form-customer').submit();">
                Logout
            </a>
            <form id="logout-form-customer" action="{{ url('/logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    @else
        <div class="cart-btn mt-100">
            <a class="btn amado-btn w-100">
                Login
            </a>
        </div>
    @endif
</header>
<!-- Header Area End -->
