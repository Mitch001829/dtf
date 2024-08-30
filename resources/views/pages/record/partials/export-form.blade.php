@props([
    'url' => '#',
])

<x-bladewind::modal
    name="export-modal"
    type="info" 
    title="Limit Export Data"
    ok_button_action="goDelete()"
    ok_button_label=""
>
    <div>
        <form action="{{ route($url) }}" method="POST">
            @csrf
            <x-input-error :messages="$errors->get('From')" />
            <x-bladewind::datepicker placeholder="From" name="from" id="date-harvested-input" selected_value="{{old('from')}}" required="true" />

            <x-input-error :messages="$errors->get('To')" />
            <x-bladewind::datepicker placeholder="From" name="to" id="date-harvested-input" selected_value="{{old('to')}}" required="true" />

            <x-bladewind::button icon="folder-minus" can_submit="true">
                Export Data
            </x-bladewind::button>
        </form>
    </div>
</x-bladewind::modal>