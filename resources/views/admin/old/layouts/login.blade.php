<!DOCTYPE html>
<html lang="en">
    <head>
        @include($scope.'.partials.meta')
        @include($scope.'.partials.css')
        @yield('styles')
    </head>

    <body>
        <section id="container" >
            <div id="login-page">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </section>
        <!-- JS -->
        @include($scope.'.partials.js')
        @yield('javascripts')
        <!-- End JS-->
    </body>
</html>
