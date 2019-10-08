@include('client/layout/head')
@include('client/layout/header')
@include('client/layout/sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @yield('content')
</div>

@include('client/layout/footer')
@include('client/layout/foot')
