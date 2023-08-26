<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand mx-2" href="/">Kashier Store</a>
    <ul class="navbar-nav w-100 justify-content-around">

        @if(auth()->user())
            @if(auth()->user()->role != 'admin')
            <li class="nav-item ms-3">
                <a class="nav-link" href="/orders">Orders</a>
            </li>
            @endif
            <li class="nav-item ms-3">
                <p class="h-100 mb-0 text-light mt-1">welcome, {{auth()->user()->name}}</p>
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
        @if(auth()->user()&& auth()->user()->role == 'admin')
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart') }}">Cart</a>
                </li>
            @endif
    </ul>
</nav>
