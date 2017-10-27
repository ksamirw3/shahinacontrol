<div class="col-md-4 col-sm-4 mb">
    <div class="grey-panel pn donut-chart">
        <div class="grey-header">
            <h5>{{__('admin.Online Drivers')}}</h5>
        </div>
        <canvas id="serverstatus01" height="120" width="120"></canvas>
        <script>
            var doughnutData = [
                {
                    value: <?= $online_drivers['online'] ?>,
                    color: "#FF6B6B"
                },
                {
                    value: <?= $online_drivers['offline_usrers'] ?>,
                    color: "#fdfdfd"
                }
            ];
            var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
        </script>
        <div class="row">
            <div class="col-sm-6 col-xs-6 goleft">
                <p>in Total<br/>Dreivers:</p>
            </div>
            <div class="col-sm-6 col-xs-6">
                <h2><?= round($online_drivers['online_perc'], 2) ?>%</h2>
            </div>
        </div>
    </div>
    <! --/grey-panel -->
</div><!-- /col-md-4-->