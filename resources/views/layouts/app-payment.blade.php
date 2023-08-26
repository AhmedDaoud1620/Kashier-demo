<!DOCTYPE html>
<!-- Head -->
@include('layouts.partials.header')
<!-- Head -->
<body>

<!-- Header Start -->
@include('layouts.partials.navbar')
<!-- Header End -->

<!-- Content -->
@yield('content')
<!-- Content -->

<!-- Footer -->
{{--@include('layouts.partials.footer')--}}
<!-- Footer -->

<!-- Scripts -->
@include('layouts.partials.scripts-assets')
@include('layouts.partials.scripts')
<!-- Scripts -->
</body>

</html>

