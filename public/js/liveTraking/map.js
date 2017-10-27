var googleMap = function (ele) {

    var $this = this;

    $this.center = {lat: 24.7206475, lng: 46.8324284};

    var imgUrl = "CAR_30PX.png";

    $this.map = null;

    $this.markers = [];

    $this.newMarker = function ($config) {
        this.markers[$config.token] = new google.maps.Marker({
//                        icon: imgUrl,
            position: {
                lat: parseFloat($config.position.lat),
                lng: parseFloat($config.position.lng)
            },
            map: this.map, title: $config.title
        });
    }

    return {
        setCenter: function (lat, lng) {
            $this.center = {lat: lat, lng: lng};
            $this.map.panTo(new google.maps.LatLng(lat, lng));
        },
        draw: function () {
            $this.map = new google.maps.Map(document.getElementById(ele), {center: $this.center, zoom: 10});
        },
        addDriver: function ($config) {
            $this.newMarker($config)

        },
        changePosition: function ($config) {
            $this.markers[$config.token].setPosition({
                lat: parseFloat($config.position.lat),
                lng: parseFloat($config.position.lng)
            })

        }
    }
}

/**
 * 
 * @returns googleMap
 */
function initMap(ele) {
    var map = new googleMap(ele);
    map.draw();
    return map;
}