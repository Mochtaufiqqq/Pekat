<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Peta</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />
    <script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.umd.js"></script>
    <style>
        #leafletMap-registration {
            height: 400px;
            width: 400px;
            /* The height is 400 pixels */
        }
    </style>
</head>

<body>

    <div class="container">

        <div id="leafletMap-registration"></div>

        <form action="/create/store" style="margin-top: 50px" method="POST">
            @csrf

            <div class="form-group mb-3">
                <input class="form-control" type="text" name="name" id="" placeholder="name">
            </div>
            <div class="form-group mb-3">
               <span id="address"></span>
            </div>
            <div class="form-group mb-3">
                <input class="form-control" type="hidden" name="longitude" id="longitude" placeholder="longitude">
            </div>
            <div class="form-group mb-3">
                <input class="form-control" type="hidden" name="latitude" id="latitude" placeholder="latitude">
            </div>
            <button class="btn btn-secondary" type="submit">Submit</button>
        </form>
    </div>
</body>

</html>


<script>
    // you want to get it of the window global
    const providerOSM = new GeoSearch.OpenStreetMapProvider();

    //leaflet map
    var leafletMap = L.map('leafletMap-registration', {
        fullscreenControl: true,
        // OR
        fullscreenControl: {
            pseudoFullscreen: false // if true, fullscreen to page width and height
        },
        minZoom: 2
    }).setView([0, 0], 2);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leafletMap);

    let theMarker = {};

    leafletMap.on('click', function (e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);

        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`)
            .then(response => response.json())
            .then(data => {
                // Get address from response and update HTML
                let address = data.display_name;
                document.querySelector("#address").value = address;
            })
            .catch(error => console.error(error));

        let popup = L.popup()
            .setLatLng([latitude, longitude])
            .setContent("Coordinate : " + latitude + " - " + longitude)
            .openOn(leafletMap);

        if (theMarker != undefined) {
            leafletMap.removeLayer(theMarker);
        };

        document.querySelector("#longitude").value = longitude;
        document.querySelector("#latitude").value = latitude;


        theMarker = L.marker([latitude, longitude]).addTo(leafletMap);

    });
    

    const search = new GeoSearch.GeoSearchControl({
        provider: providerOSM,
        style: 'bar',
        searchLabel: 'Search',
    });

    leafletMap.addControl(search);

    
</script>