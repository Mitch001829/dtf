@php
    $status = [
        ['label' => 'Pending', 'value' => 'pending'],
        ['label' => 'In Progress', 'value' => 'in_progress'],
        ['label' => 'Completed', 'value' => 'completed'],
];

    $empty_select = [];
@endphp


<form action="{{ route('record.inquiries.store') }}" method="POST">
    @csrf

    <x-input-error :messages="$errors->get('name')" />
    <x-bladewind::input type="text" name="name" required="true" label="Name" id="name-input" selected_value="{{old('name')}}" />
    
    <x-input-error :messages="$errors->get('email')" />
    <x-bladewind::input type="email" name="email" required="true" label="Email" id="email-input" selected_value="{{ auth()->user()->email }}"/>
    
    <x-input-error :messages="$errors->get('service')" />
    @if(!$services->isEmpty())
        <x-bladewind::select label_key="name" required="true" value_key="id" :data="$services" label="Service" name="service" id="service-input" />
    @else
        <x-bladewind::input type="text" label="No service available" disabled /> 
    @endif
   
    <x-input-error :messages="$errors->get('message')" />
    <x-bladewind::textarea name="message" label="Message" required="true" id="message-input" selected_value="{{old('message')}}"/>
    
    <x-input-error :messages="$errors->get('status')" />
    <x-bladewind::select :data="$status" required="true" name="status" label="Status" id="status-input" />
    
    <x-bladewind::button icon="folder-minus" can_submit="true">
        Submit Form
    </x-bladewind::button>
</form>