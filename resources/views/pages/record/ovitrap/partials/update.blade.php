@php
    $update_symbol = [
        ['label' => 'Plus +', 'value' => '+'],
        ['label' => 'Minus -', 'value' => '-']
    ];
@endphp


<form action="{{ route('record.ovitrap.update'); }}" method="POST">
    @csrf

    <input type="hidden" name="id" id="data-id">

    <x-input-error :messages="$errors->get('health_center')" />
    <x-bladewind::input type="text" name="health_center" label="Health Center" id="health-center-update" selected_value="{{old('health_center')}}" required="true" />

    <x-input-error :messages="$errors->get('date_installed')" />
    <x-bladewind::datepicker placeholder="Date Installed" name="date_installed" id="date-installed-update" selected_value="{{old('date_installed')}}" required="true" />

    <x-input-error :messages="$errors->get('date_harvested')" />
    <x-bladewind::datepicker placeholder="Date Harvested" name="date_harvested" id="date-harvested-update" selected_value="{{old('date_harvested')}}" required="true" />

    <x-input-error :messages="$errors->get('area_type')" />
    <x-bladewind::input type="text" name="area_type" label="Area Type" id="area-type-update" selected_value="{{old('area_type')}}" required="true" />

    
    <x-input-error :messages="$errors->get('address')" />
    <x-location-selector id="update-map" type="edit"/>

    <input type="hidden" name="address" id="address-update" required/>
    <input type="hidden" name="latitude" id="latitude-update" required/>
    <input type="hidden" name="longitude" id="longitude-update" required/>
    
    <x-input-error :messages="$errors->get('trap_indoor_update')" />
    <x-bladewind::select  name="trap_indoor_update" label="Trap Indoor" id="trap-indoor-update" :data="$update_symbol" selected_value="{{old('trap_indoor_update')}}" required="true" />
    
    <x-input-error :messages="$errors->get('trap_outdoor_update')" />
    <x-bladewind::select  name="trap_outdoor_update" label="Trap Outdoor" id="trap-outdoor-update"  :data="$update_symbol" selected_value="{{old('trap_outdoor_update')}}" required="true" />

    <x-bladewind::button icon="folder-minus" can_submit="true">
        Update Form
    </x-bladewind::button>
</form>

<script>
      function setLocationSelectedEdit(lat, long, address){
        domEl('#latitude-update').value = lat;
        domEl('#longitude-update').value = long;
        domEl('#address-update').value = address;
    }
</script>