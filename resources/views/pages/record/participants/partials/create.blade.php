<form action="{{ route('record.participants.store') }}" method="POST">
    @csrf

    <x-input-error :messages="$errors->get('name')" />
    <x-bladewind::input type="text" name="name" label="Full name" id="name-input" selected_value="{{old('name')}}" />

    <x-input-error :messages="$errors->get('age')" />
    <x-bladewind::input type="number" name="age" label="Age" id="age-input" selected_value="{{old('Age')}}" />

    <x-input-error :messages="$errors->get('address')" />
    <x-location-selector id="create-map" type="create"/>
    <input type="hidden" name="address" id="address-input" required/>

    <x-input-error :messages="$errors->get('health_center')" />
    <x-bladewind::input type="text" name="health_center" label="Health Center" id="health-center-input" selected_value="{{old('health_center')}}" />

    <x-input-error :messages="$errors->get('date')" />
    <x-bladewind::datepicker placeholder="Target Date" name="date" id="target-date-input" selected_value="{{old('date')}}" />
    
    <x-bladewind::button icon="folder-minus" can_submit="true">
        Submit Form
    </x-bladewind::button>

   
</form>

<script>
    function setLocationSelected(lat, long, address){
        domEl(' #address-input').value = address;
    }
</script>