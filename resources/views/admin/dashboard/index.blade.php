<!-- WHITE PANEL - TOP USER -->
@extends('layouts.dashboard')

@section('css')
    <script src="assets/js/chart-master/Chart.js"></script>
    <style>
        .bigTxt {
            font-size: 50px;;
        }
    </style>
@stop
@section('content')
    <?php $base = 'admin.dashboard.comp.';?>


    <div class="col-lg-9 main-chart">

        <!--CUSTOM CHART START -->
        @include($base.'totalIncome');
        <!--custom chart end-->

        <div class="row mt">
            <!-- SERVER STATUS PANELS -->

            @include($base.'totalDrivers')
            @include($base.'totalClient')
            @include($base.'executedTrip')
            @include($base.'rejectedTrip')


        </div><!-- /row -->


        <div class="row">

            @include($base.'onlineDriver')
            @include($base.'BringVsDliver')
            @include($base.'heightsOpen')


        </div><!-- /row -->

    </div><!-- /col-lg-9 END SECTION MIDDLE -->


    <!-- **********************************************************************************************************************************************************
    RIGHT SIDEBAR CONTENT
    *********************************************************************************************************************************************************** -->

    <div class="col-lg-3 ds">

        @include($base.'minyIncome')
        @include($base.'comments')
        @include($base.'calender')


    </div><!-- /col-lg-3 -->




    @stop

    @section('js')
            <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>
    <script src="assets/js/zabuto_calendar.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.content-panel').removeClass('content-panel')
        })

    </script>

    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "<?=5?>"},
                    {type: "block", label: "Regular event",}
                ]
            });
        });


        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
    @include($base.'ajax')
@stop

