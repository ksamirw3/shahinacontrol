<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="codex-global">
        <base href="{{App::make("url")->to('/')}}/"/>
        <!-- Bootstrap core CSS -->
        <title>Shahina Dashboard {{@$pageTitel}}</title>
        <!-- Bootstrap core CSS -->
        <link href="{{ URL::asset('/css/bootstrap.css') }}" rel="stylesheet">
        <!--external css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">
        <link href="assets/css/sweetalert.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        @if(Amit\Msic\Lang::isArabic())
        <link href="assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custome-rtl.css" rel="stylesheet" type="text/css"/>
        @endif
        <link href="assets/css/custome.css" rel="stylesheet" type="text/css"/>
        @yield('scopeCss')
    </head>
    <body>


        @yield('scopeContent')


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="assets/js/sweetalert.min.js" type="text/javascript"></script>
        <script src="assets/js/swalHelper.js" type="text/javascript"></script>


        <!--common script for all pages-->
        <script src="assets/js/common-scripts.js"></script>
        <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

        @yield('scopeJs')
    </body>
</html>





