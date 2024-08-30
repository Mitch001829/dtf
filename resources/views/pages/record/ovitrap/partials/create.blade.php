@php
    $symbol = [
        ['label' => 'Plus +', 'value' => '+'],
        ['label' => 'Minus -', 'value' => '-']
    ];
@endphp

<!-- Locator 
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
-->




<form action="{{ route('record.ovitrap.store'); }}" method="POST" id="ovi-form-create">
    @csrf
    
    <x-input-error :messages="$errors->get('health_center')" />
    <x-bladewind::input type="text" name="health_center" label="Health Center" id="health-center-input" selected_value="{{old('health_center')}}" required="true" />

    <x-input-error :messages="$errors->get('date_installed')" />
    <x-bladewind::datepicker placeholder="Date Installed" name="date_installed" id="date-installed-input" selected_value="{{old('date_installed')}}" required="true" />

    <x-input-error :messages="$errors->get('date_harvested')" />
    <x-bladewind::datepicker placeholder="Date Harvested" name="date_harvested" id="date-harvested-input" selected_value="{{old('date_harvested')}}" required="true" />

    <x-input-error :messages="$errors->get('area_type')" />
    <x-bladewind::input type="text" name="area_type" label="Area Type" id="area-type-input" selected_value="{{old('area_type')}}" required="true" />
    
    <x-input-error :messages="$errors->get('address')" />
    <x-location-selector id="create-map"/>

    <input type="hidden" name="address" id="address-input" required/>
    <input type="hidden" name="latitude" id="latitude-input" required/>
    <input type="hidden" name="longitude" id="longitude-input" required/>

    <x-input-error :messages="$errors->get('trap_indoor')" />
    <x-bladewind::select  name="trap_indoor" label="Trap Indoor" id="trap-indoor-input" :data="$symbol" selected_value="{{old('trap_indoor')}}" required="true" />

    <x-input-error :messages="$errors->get('trap_outdoor')" />
    <x-bladewind::select  name="trap_outdoor" label="Trap Outdoor" id="trap-outdoor-input"  :data="$symbol" selected_value="{{old('trap_outdoor')}}" required="true" />

    <x-bladewind::button icon="folder-minus" can_submit="true">
        Submit Form
    </x-bladewind::button>
</form>


<script>

    function setLocationSelected(lat, long, address){
        domEl('#latitude-input').value = lat;
        domEl('#longitude-input').value = long;
        domEl('#address-input').value = address;
    }
</script>