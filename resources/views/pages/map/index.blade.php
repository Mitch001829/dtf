<x-app-layout>
    <!-- Add CDN of leaflet map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>

    <script src="{{ asset('js/leaflet-heat.js') }}"></script>
    <script src="https://leaflet.github.io/Leaflet.markercluster/example/realworld.388.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- Page Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Map') }}
        </h2>
    </x-slot>

    <style>
        #map {
            height: 75vh;
            width: 100%;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="map" class="dark:text-neutral-950"></div>
                </div>
            </div>
        </div>
    </div>

    
    
    <script>
        function getData(){
            fetch('{{ route('map.getOVILocData') }}')
            .then(response => response.json())
            .then(data => {
                if(data.length !== 0){
                    let radius = data[0][2];
                    var heat = L.heatLayer(data, {radius: radius}).addTo(map);
                }
            })
            .catch(error => {
                alert('Error:' +  error);
            });
        }



        var map;
        var latitude = parseFloat(getUrlParameter('latitude'));
        var longitude = parseFloat(getUrlParameter('longitude'));
        
        if (latitude && longitude) {
            map = L.map('map').setView([latitude, longitude], 13);
            L.marker([latitude, longitude], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 500
            }).addTo(map);
        } else {
            map = L.map('map').setView([14.6760, 121.0437], 13);
        }

        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var geocoder = L.Control.geocoder({
            defaultMarkGeocode: false
            })
            .on('markgeocode', function(e) {
                var latlng = e.geocode.center;
                L.marker(latlng).addTo(map)
                .bindPopup(latlng.toString())
                .openPopup();

                // access the latitude and longitude if you need 
                console.log("Latitude: " + latlng.lat + ", Longitude: " + latlng.lng);
            })
        .addTo(map);

        

        
        
        /**
        var heat = L.heatLayer([
            // lat, lng, intensity
            [14.6760, 121.0437, 10], 
            [14.6760, 121.042, 10],
        ], {radius: 25}).addTo(map);
        */


        getData();

        // Manual Heat map painting
        /**
        addressPoints = addressPoints.map(function (p) { return [p[0], p[1]]; });
        var heat = L.heatLayer(addressPoints).addTo(map),
            draw = true;

        map.on({
            movestart: function () { draw = false; },
            moveend:   function () { draw = true; },
            mousemove: function (e) {
                if (draw) {
                    heat.addLatLng(e.latlng);
                }
            }
        })
        **/



        // circle marker 
        /*
        var circle = L.marker([14.6760, 121.0437], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map);
        */


    </script>
</x-app-layout>