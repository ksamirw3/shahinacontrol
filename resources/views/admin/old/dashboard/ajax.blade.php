@section('js')

<!-- js files for chart-->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>

<script>
    /*
     * defind global vars
     */
    var app = {baseUrl: '<?= url('/') ?>', csrfToken: '<?= csrf_token() ?>', urls: {}};
    app.ajaxBaseUrl = app.baseUrl + '/admin/dashboard/';
    /*
     * init urls
     */
    app.urls = {
        totalLabs: app.ajaxBaseUrl + 'count-labs',
        totalDiplomas: app.ajaxBaseUrl + 'count-diploma',
        totalCourses: app.ajaxBaseUrl + 'count-courses',
        totalInstructors: app.ajaxBaseUrl + 'count-instructors'
    };
    /*
     *
     * @param {type} param
     */
    function setData($item, $data) {
        $($item).html($data)
                .removeClass('loaderGif')
                .parents('loaderContener')
                .removeClass('loaderContener');
    }
    /*
     * setup ajax header
     */
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': app.csrfToken}});
    /*
     * start ajax methods
     */

    /*
     * get active provider
     *
     */
    $.post(app.urls.totalLabs, {}, function (res) {
        setData('#totalLabs', parseInt(res.result.count));
    });
    /*
     * set active services
     */
    $.post(app.urls.totalDiplomas, {}, function (res) {
        setData('#totalDiplomas', parseInt(res.result.count));
    });
    /**
     *
     * @type @exp;data@pro;result
     */
    $.post(app.urls.totalCourses, {}, function (res) {
        setData('#totalCourses', parseInt(res.result.count));
    });
    /**
     *
     * @type @exp;data@pro;result
     */
    $.post(app.urls.totalInstructors, {}, function (res) {
        setData('#totalInstructors', parseInt(res.result.count));
    });
    /*
     * set active users
     */
    $.post(app.urls.providerDetails, {}, function (data) {
        var res = data.result;
        setData('#p-approved', (res.approved));
        setData('#p-reject', (res.reject));
        setData('#p-panding', (res.panding));
        setData('#totalProvider', parseInt(res.approved) + parseInt(res.reject) + parseInt(res.panding));
    });
    /*
     *
     * get services details
     */
    $.post(app.urls.servicesDetails, {}, function (data) {
        var res = data.result;
        setData('#s-approved', (res.approved));
        setData('#s-reject', (res.reject));
        setData('#s-panding', (res.panding));
        setData('#totalServices', parseInt(res.approved) + parseInt(res.reject) + parseInt(res.panding));
    });
    /*
     *
     * get services details
     */
    $.post(app.urls.topServices, {}, function (data) {
        var res = data.result;
        var html = '';
        for (var i in res) {
            var service = res[i];
            html += '<tr><td>' + service.title_ar + '</td><td>' + service.provider_name + '</td><td>' + service.rate + '</td></tr>';
        }
        setData('#topServices', html);
    });
    /*
     *
     * get services details
     */
    $.post(app.urls.topProvider, {}, function (data) {
        var res = data.result;
        console.log(res);
        var html = '';
        for (var i in res) {
            var service = res[i];
            html += '<tr><td>' + service.name + '</td><td>' + service.rate + '</td></tr>';
        }
        setData('#topProvider', html);
    });
    /*
     *
     *
     *
     * chart section
     *
     *
     *
     */
    var morrisAttr = {
        xkey: 'months',
        ykeys: ['count'],
        barRatio: .4,
        xLabelAngle: 35,
        hideHover: false,
        barColors: ['#ac92ec']
    };
    $.post(app.urls.providerPerMonth, {}, function (data) {
        morrisAttr.element = 'ProviderChart';
        morrisAttr.data = data.result;
        morrisAttr.labels = ['Provider'];
        Morris.Bar(morrisAttr);
    });
    $.post(app.urls.usersPerMonth, {}, function (data) {
        morrisAttr.element = 'UsersChart';
        morrisAttr.data = data.result;
        morrisAttr.labels = ['Users'];
        Morris.Bar(morrisAttr);
    });
    $.post(app.urls.usersPerGender, {}, function (data) {
        Morris.Donut({element: 'UsersInfo', data: data.result});
    });
    $.post(app.urls.servicesByCategory, {}, function (data) {
        Morris.Donut({element: 'ServicesPie', data: data.result});
    });
    $.post(app.urls.income, {}, function (data) {
        console.log(data.result)
        Morris.Bar({
            element: 'income',
            xLabelAngle: 35,
            data: data.result,
            xkey: 'label',
            ykeys: ['value'],
            labels: ['value'],
        });
    });
    /*
     *
     *
     *
     *
     *
     *
     *
     *
     */

    $('#userStatics').change(function () {
        if ($(this).val() === 'gender') {
            $.post(app.urls.usersPerGender, {}, function (data) {
                Morris.Donut({element: 'UsersInfo', data: data.result});
            });
        } else {
            $.post(app.urls.usersPerAge, {}, function (data) {
                Morris.Donut({element: 'UsersInfo', data: data.result});
            });
        }
    })

</script>
@stop
