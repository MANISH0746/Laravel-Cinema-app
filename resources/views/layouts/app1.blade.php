@include('layouts.header')
    @guest
        @yield('content')
    @else
        @include('layouts.sidebar')
        @yield('content')
        @include('layouts.footer')
    @endguest
