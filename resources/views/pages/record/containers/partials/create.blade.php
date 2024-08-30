<form action="{{ route('record.containers.store') }}" method="POST">
    @csrf
    <x-input-error :messages="$errors->get('period_covered')" />
    <x-bladewind::input type="text" name="period_covered" label="Period Covered" id="period-covered-input" selected_value="{{old('period_covered')}}" required="true" />

    <x-input-error :messages="$errors->get('barangay')" />
    <x-bladewind::input type="text" name="barangay" label="Barangay" id="barangay-input" selected_value="{{old('barangay')}}" required="true" />

    <x-input-error :messages="$errors->get('address')" />
    <x-bladewind::input type="text" name="address" label="Address" id="address-input" selected_value="{{old('address')}}" required="true" />

    <x-input-error :messages="$errors->get('inspection_date')" />
    <x-bladewind::datepicker placeholder="Inspection Date" name="inspection_date" id="inspection-date-input" selected_value="{{old('inspection_date')}}" required="true" />

    <x-input-error :messages="$errors->get('no_of_container')" />
    <x-bladewind::input type="number" name="no_of_container" label="No. of container" id="no-of-container-input" selected_value="{{old('no_of_container')}}" required="true" />

    <x-input-error :messages="$errors->get('no_of_containers_with_larvae')" />
    <x-bladewind::input type="number" name="no_of_containers_with_larvae" label="No. of containers with larvae" id="no-of-containers-with-larvae-input" selected_value="{{old('no_of_containers_with_larvae')}}" required="true" />

    <x-input-error :messages="$errors->get('containers_kind')" />
    <x-bladewind::input type="text" name="containers_kind" label="Containers Kind" id="containers-kind-input" selected_value="{{old('containers_kind')}}" required="true" />

    <x-input-error :messages="$errors->get('total_house')" />
    <x-bladewind::input type="number" name="total_house" label="Total House" id="total-house-input" selected_value="{{old('total_house')}}" required="true" />

    <x-input-error :messages="$errors->get('total_containers')" />
    <x-bladewind::input type="number" name="total_containers" label="Total Containers" id="total-containers-input" selected_value="{{old('total_containers')}}" required="true" />

    <x-input-error :messages="$errors->get('total_containers_with_larvae')" />
    <x-bladewind::input type="number" name="total_containers_with_larvae" label="Total Containers containing larvae" id="total-containers-with-larvae-input" selected_value="{{old('total_containers_with_larvae')}}" required="true" />

    <x-bladewind::button icon="folder-minus" can_submit="true">
        Submit Form
    </x-bladewind::button>
</form>