<form action="{{ route('record.containers.update') }}" method="POST">
    @csrf
    <input type="hidden" name="id" id="id-update" />
    <x-input-error :messages="$errors->get('period_covered')" />
    <x-bladewind::input type="text" name="period_covered" label="Period Covered" id="period-covered-update" selected_value="{{old('period_covered')}}" required="true" />

    <x-input-error :messages="$errors->get('barangay')" />
    <x-bladewind::input type="text" name="barangay" label="Barangay" id="barangay-update" selected_value="{{old('barangay')}}" required="true" />

    <x-input-error :messages="$errors->get('address')" />
    <x-bladewind::input type="text" name="address" label="Address" id="address-update" selected_value="{{old('address')}}" required="true" />

    <x-input-error :messages="$errors->get('inspection_date')" />
    <x-bladewind::datepicker placeholder="Inspection Date" name="inspection_date" id="inspection-date-update" selected_value="{{old('inspection_date')}}" required="true" />

    <x-input-error :messages="$errors->get('no_of_container')" />
    <x-bladewind::input type="number" name="no_of_container" label="No. of container" id="no-of-container-update" selected_value="{{old('no_of_container')}}" required="true" />

    <x-input-error :messages="$errors->get('no_of_containers_with_larvae')" />
    <x-bladewind::input type="number" name="no_of_containers_with_larvae" label="No. of containers with larvae" id="no-of-containers-with-larvae-update" selected_value="{{old('no_of_containers_with_larvae')}}" required="true" />

    <x-input-error :messages="$errors->get('containers_kind')" />
    <x-bladewind::input type="text" name="containers_kind" label="Containers Kind" id="containers-kind-update" selected_value="{{old('containers_kind')}}" required="true" />

    <x-input-error :messages="$errors->get('total_house')" />
    <x-bladewind::input type="number" name="total_house" label="Total House" id="total-house-update" selected_value="{{old('total_house')}}" required="true" />

    <x-input-error :messages="$errors->get('total_containers')" />
    <x-bladewind::input type="number" name="total_containers" label="Total Containers" id="total-containers-update" selected_value="{{old('total_containers')}}" required="true" />

    <x-input-error :messages="$errors->get('total_containers_with_larvae')" />
    <x-bladewind::input type="number" name="total_containers_with_larvae" label="Total Containers containing larvae" id="total-containers-with-larvae-update" selected_value="{{old('total_containers_with_larvae')}}" required="true" />

    <x-bladewind::button icon="folder-minus" can_submit="true">
        Update Form
    </x-bladewind::button>
</form>