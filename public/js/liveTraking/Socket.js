var socket = io.connect('http://localhost:30010');
var Map = initMap('map');


socket.on('liveTracking', function (data) {
    console.log(data)
    map.changePosition(data);

});
socket.on('driverList', function (data) {
    for (var i in data.drivers) {
        var driver = data.drivers[i];
        map.addDriver({position: driver.position, token: driver.token})
    }

})
socket.on('addDriverToMap', function (data) {
    console.log(data)
    map.addDriver({position: {lat: 24.7206475, lng: 46.8324284}, token: data.socketToken})
});

socket.emit('fireLiveTracking');