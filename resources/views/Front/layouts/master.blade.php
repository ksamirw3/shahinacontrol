<?php $scope = 'Front' ?>


<!doctype html>
<html class="no-js" lang="en">
    <head>
        @include($scope.'.partials.meta')
        @include($scope.'.partials.css')
        @yield('styles')
        @include($scope.'.partials.js_header')
    </head>
    <body>
        @include($scope.'.partials.header')

        @include($scope.'.partials.flash_messages')

        @yield('content')

        @include($scope.'.partials.footer')
        <!-- end footer -->
        <div class="dmtop">Scroll to Top</div>

        <!-- Main Scripts-->
        @include($scope.'.partials.js')
        @yield('javascripts')
    </body>
</html>
