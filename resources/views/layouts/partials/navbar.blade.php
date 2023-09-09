@php
    $cartItems = session('shoppingCart', []);
    $totalElements = 0;

    foreach ($cartItems as $subArray) {
        $totalElements += $subArray['quantity'];
    }
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand mx-2" href="/">Kashier Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav ms-3">
            @if(auth()->user())
                @if(auth()->user()->role != 'admin')
                    <li class="nav-item ms-3">
                        <a class="nav-link" href="/orders">Orders</a>
                    </li>
                @endif
                <li class="nav-item ms-3">
                    <p class="h-100 mb-0 text-light mt-1 pt-1">welcome, {{auth()->user()->name}}</p>
                </li>
                <li class="nav-item ms-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav">
        @if(auth()->user() && auth()->user()->role == 'admin')
            @else
                <li class="nav-item ms-3">
                    <a class="nav-link" href="{{ route('cart') }}">
                        <div class="position-relative">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge badge-danger">{{ $totalElements }}</span>
                        </div>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
