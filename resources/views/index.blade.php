{{-- included header file --}}
@include('header')

{{-- included sidebar file --}}
@include('sidebar')

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

        <!-- [ Main Content ] start -->
        <div class="row m-3">
            @yield('content')

        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->

{{-- included footer file --}}
@include('footer')
</body>

</html>
