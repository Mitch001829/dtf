<form action="{{ route('record.larvicide.store') }}" method="POST">
    @csrf

    
    
    <x-input-error :messages="$errors->get('date')" />
    <x-bladewind::datepicker placeholder="For the moth of" name="date" id="target-date-input" selected_value="{{old('date')}}" />

    <x-input-error :messages="$errors->get('health_center')" />
    <x-bladewind::input type="text" name="health_center" label="Health Center" id="health-center-input" selected_value="{{old('health_center')}}" />

    <x-input-error :messages="$errors->get('name')" />
    <x-bladewind::input type="text" name="name" label="Full name" id="name-input" selected_value="{{old('name')}}" />

    <x-input-error :messages="$errors->get('area_conducted')" />
    <x-bladewind::input type="text" name="area_conducted" label="Area conducted" id="aread-conducted-input" selected_value="{{old('area_conducted')}}" />

    <x-input-error :messages="$errors->get('aide_name')" />
    <x-bladewind::input type="text" name="aide_name" label="Name of pasig health aide" id="aide-name-input" selected_value="{{old('aide_name')}}" />

    <x-input-error :messages="$errors->get('contact_number')" />
    <x-bladewind::input type="number" name="contact_number" label="Contact Number" id="contact-number-input" selected_value="{{old('contact_number')}}" />

    <x-bladewind::button icon="folder-minus" can_submit="true">
        Submit Form
    </x-bladewind::button>
</form>
