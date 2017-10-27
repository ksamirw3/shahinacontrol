<!DOCTYPE html>
<html lang="en">
    <head>
        @include($scope.'.partials.meta')
        @include($scope.'.partials.css')
        @yield('css')
        @include($scope.'.partials.js_header')
    </head>
    <body>
        <section id="container" >
            <!-- ******************************************
            TOP BAR CONTENT & NOTIFICATIONS
            ******************************************* -->
            <!--header start-->
            @include($scope.'.partials.header')
            <!--header end-->

            <!-- ******************************************
            MAIN SIDEBAR MENU
            ****************************************** -->
            <!--sidebar start-->
            @include($scope.'.partials.asaid')
            <!--sidebar end-->
            <!-- ******************************************
            MAIN CONTENT
            ****************************************** -->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper site-min-height">
                    @yield('title')
                    @include($scope.'.partials.flash_messages')
                    @yield('content')
                </section>
            </section>
            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                @include($scope.'.partials.footer')
            </footer>
            <!--footer end-->
        </section>
        <!-- Main Scripts-->
        @include($scope.'.partials.js')

        @yield('js')
    </body>
</html>
