<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand mx-2" href="/">Kashier Store</a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/orders">Orders</a>
        </li>
        @if(auth()->user())
            <li class="nav-item">
                <p>welcome, {{auth()->user()->name}}</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link">Logout</button>
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
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cart') }}">Cart</a>
        </li>
    </ul>
</nav>
