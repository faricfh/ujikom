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
            <li><a href="{{ url('/checkout') }}">Checkout</a></li>
        </ul>
    </nav>
    <!-- Cart Menu -->
    <div class="cart-fav-search mb-100">
        <a href="{{ url('/cart')}}" class="cart-nav"><img src="{{ asset('assets/frontend/img/core-img/cart.png') }}" alt=""> Cart (<span id="totalproduk"></span>)</a>
        <a href="#" class="fav-nav"><img src="{{ asset('assets/frontend/img/core-img/favorites.png') }}" alt=""> Favourite</a>
        <a href="#" class="search-nav"><img src="{{ asset('assets/frontend/img/core-img/search.png') }}" alt=""> Search</a>
    </div>
</header>
<!-- Header Area End -->
