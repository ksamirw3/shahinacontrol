<!-- WHITE PANEL - TOP USER -->
@extends('layouts.dashboard')

@section('css')
<style>
    iframe {
        width: 100%;
        min-height: 700px;
        border: none;
        outline: none;
    }
</style>
@stop
@section('content')
    <iframe src="http://localhost:30010/map"></iframe>
<!--<div id="map"></div>
<script>
    function initMap() {

        /**
         * 
         *
         * creat functions
         *
         *
         */

        function creatMarker(map, positions) {
            var marker = new google.maps.Marker({
                position: positions,
                map: map
            });
//             map.setCenter(marker.getPosition());
            setTimeout(function () {
                map.panTo(marker.getPosition());
            }, 2000)
            return marker;
        }

        /**
         * 
         * create vars
         */

        var positions = {lat: 24.7206475, lng: 46.8324284};
        var markers = {};
        /**
         * 
         * create map
         */

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            center: positions
        });
          socket.on('driverList', function (data) {
            for (var i in data.drivers) {
                var driver = data.drivers[i];
                map.addDriver({position: driver.position, token: driver.token})
            }

        })
        markers[] = creatMarker(map, {lat: 24.7206475, lng: 46.8524284});
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKSfDk895nhKvQ0FQHo5Zs0oLnOJZmDlA&callback=initMap">
</script>-->
@stop

