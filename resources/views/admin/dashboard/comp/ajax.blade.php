<script>
    //var app = {baseUrl: '<?= url('/') ?>', csrfToken: '<?= csrf_token() ?>'};
    //app.ajaxBaseUrl = app.baseUrl + '/admin/dashboard/';
//    $.ajaxSetup({headers: {'X-CSRF-TOKEN': app.csrfToken}});

    //var Urls = {
      //  tripType: app.ajaxBaseUrl + 'trip-type',
   // }

    $.get("http://localhost/mandobi/revamp/admin/dashboard/trip-type",{},function(d){
       console.log(d)
    })
</script>