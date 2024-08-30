@props([
    'id' => 'map',
    'type' => 'create'
])

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

<x-bladewind::button class="mb-3 py-3 min-w-full border border-slate-500 " color="cyan-blue" icon="map-pin" onclick="openMapModal('{{ 'location-selector-modal_'.$id }}', '{{ $id }}', '{{ $type }}')">
    <span class="dark:text-slate-400 text-gray-500"> Select Location </span>
    <p id="location-name-{{ $id }}" class="dark:text-slate-400 text-gray-500" style="display: inline;"></p>
</x-bladewind::button>

<style>
    .map{
        min-width: 50vw;
        height: 70vh;
    }
    .modal-body-ext {
        background-color: rgb(255, 255, 255);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 80vh; 
        width: 80vw; 
        min-height: 80vh;
        min-width: 80vw;  
    }
    .modal-foot-ext{
        background-color: rgba(1, 1, 1, 0);
        position: absolute;
        top: 35vh;
        left: 40vw;
        height: 10vh;
        width: 10vw;
        min-height: 10vh;
        min-width: 10vw; 
    }
</style>

<x-bladewind::modal
    size="omg"
    name="{{ 'location-selector-modal_'.$id }}"
    cancel_button_label=""
    body_css="modal-body-ext"
    footer_css="modal-foot-ext"
>
    <div id="{{ $id }}" class="map dark:text-neutral-950"></div>
</x-bladewind::mod>

<script>
    var mapInstances = {};

    function initializeMap(mapId, type) {
        if (mapInstances[mapId]) {
            mapInstances[mapId].remove();
        }

        var map = L.map(mapId).setView([14.6760, 121.0437], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var geocoder = L.Control.geocoder({
            defaultMarkGeocode: false
        })
        .on('markgeocode', function(e) {
            map.invalidateSize();
            let latlng = e.geocode.center;
            let loc_name = e.geocode.name;
        
            L.marker(latlng).addTo(map)
            .bindPopup(latlng.toString())
            .openPopup();

            console.log("Latitude: " + latlng.lat + ", Longitude: " + latlng.lng);
            document.getElementById('location-name-' + mapId).innerText = " : " + loc_name;

            
            if(type === "create"){
                setLocationSelected(latlng.lat, latlng.lng, loc_name);
            } else {
                setLocationSelectedEdit(latlng.lat, latlng.lng, loc_name);
            }
            
        })
        .addTo(map);
        mapInstances[mapId] = map;
    }

    function openMapModal(modalId, mapId, type) {
        showModal(modalId);
        initializeMap(mapId, type);
    }
</script>