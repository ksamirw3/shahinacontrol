
<div class="col-md-4 col-sm-4 mb">
    <div class="darkblue-panel pn">
        <div class="darkblue-header">
            <h5>{{__('admin.Bring VS Deliver')}}</h5>
        </div>
        <canvas id="serverstatus02" height="120" width="120"></canvas>
        <script>
            var doughnutData = [
            {
                value: <?= $trip_type['dliver'] ?>,
                color: "#1c9ca7"
            },
            {
                value: <?= $trip_type['bring'] ?>,
                color: "#f68275"
            }
            ];
            var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
        </script>
    </div>
    <! -- /darkblue panel -->
</div><!-- /col-md-4 -->
