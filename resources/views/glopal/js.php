<script>
    var AMIT = function () {
        var jsonArrayToText = function (j) {
            var rt = '';
            for (var i in j) {
                rt += j[i]
            }
            return rt;
        }
        return {
            baseUrl: '<?= url('/') ?>/',
            csrfToken: '<?= csrf_token() ?>',
            ajax: function () {

                $.ajaxSetup({headers: {'X-CSRF-TOKEN': AMIT().csrfToken}});
                var send = function (_url, _data, _type, _succ, _err) {
                    $.ajax({
                        url: _url,
                        data: _data,
                        type: _type,
                        success: function (result) {
                            _succ(result)
                        },
                        error: function (result) {
                            var tx = '';
                            try {
                                tx = jsonArrayToText(JSON.parse(result.responseText));
                            } catch (e) {
                            }
                            swal("Some thing went wrong!", tx, "error");
                            if (_err != undefined)
                                _err(result)
                        }
                    });
                }
                return {
                    post: function (_url, _data, _succ, _err) {
                        send(_url, _data, 'POST', _succ, _err)
                    },
                    get: function (_url, _data, _succ, _err) {
                        send(_url, _data, 'GET', _succ, _err)

                    }
                };
            }
        }

    };





</script>