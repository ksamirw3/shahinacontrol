<!--COMPLETED ACTIONS DONUTS CHART-->
<div class="donut-main">
    <h4>{{__('admin.Income')}} (static)</h4>
    <canvas id="newchart" height="130" width="130"></canvas>
    <script>
        var doughnutData = [
            {
                value: 70,
                color: "#4ECDC4"
            },
            {
                value: 30,
                color: "#fdfdfd"
            }
        ];
        var myDoughnut = new Chart(document.getElementById("newchart").getContext("2d")).Doughnut(doughnutData);
    </script>
</div>