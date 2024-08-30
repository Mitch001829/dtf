<form action="{{ route('record.participants.update') }}" method="POST">
    @csrf
    <input type="hidden" name="id" id="id-update" />

    <x-input-error :messages="$errors->get('name')" />
    <x-bladewind::input type="text" name="name" label="Full name" id="name-update" />

    <x-input-error :messages="$errors->get('age')" />
    <x-bladewind::input type="number" name="age" label="Age" id="age-update" />
    
    <x-input-error :messages="$errors->get('address')" />
    <x-location-selector id="udpdate-map" type="edit" />
    
    <input type="hidden" name="address" id="address-update" required/>
    
    <x-input-error :messages="$errors->get('health_center')" />
    <x-bladewind::input type="text" name="health_center" label="Health Center" id="health-center-update" />

    <x-input-error :messages="$errors->get('date')" />
    <x-bladewind::datepicker placeholder="Target Date" name="date" id="target-date-update" />
    
    <x-bladewind::button icon="folder-minus" can_submit="true">
        Update Record
    </x-bladewind::button>
</form>

<script>
    function setLocationSelectedEdit(lat, long, address){
        domEl(' #address-update').value = address;
    }
</script>