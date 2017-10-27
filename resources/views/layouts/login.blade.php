@extends('layouts.base')

@section('scopeCss')
    @yield('css')
@stop



@section('scopeContent')
    <div id="login-page">
        <div class="container">

            @yield('content')


        </div>
    </div>
@stop



@section('scopeJs')
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>
    @yield('js')
    @stop


            <!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->


