<!DOCTYPE html>
<html lang="en">
    <head>
        @include('Front.partials.meta')
        @include('Front.partials.css')
        @yield('css')
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
        @include('Front.partials.js')
        @yield('js')
        <!-- End JS-->
    </body>
</html>
