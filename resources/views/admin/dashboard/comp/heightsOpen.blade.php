
<div class="col-md-4 col-sm-4 mb">
    <div class="green-panel pn">
        <div class="green-header">
            <h5>{{__('admin.Highest Open Connection')}}</h5>
        </div>
        <canvas id="serverstatus03" height="120" width="120"></canvas>
        <script>
            var doughnutData = [
                {
                    value: 60,
                    color: "#2b2b2b"
                },
                {
                    value: 40,
                    color: "#fffffd"
                }
            ];
            var myDoughnut = new Chart(document.getElementById("serverstatus03").getContext("2d")).Doughnut(doughnutData);
        </script>
        <h3>60% USED</h3>
    </div>
</div>
<! --/col-md-4 -->