<!doctype html>
<html lang="en">

@include('includes.user.head')

@include('includes.user.style')
<body>

    <button class="btn" id="scroll-to-top-btn">^</button>

    @yield('content')

    
    @include('includes.user.footer')
    
    @include('includes.user.script')

    @yield('js')
    
</body>

</html>
