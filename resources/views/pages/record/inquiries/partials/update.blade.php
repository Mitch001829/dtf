@php
    $status_update = [
        ['label' => 'Pending', 'value' => 'pending'],
        ['label' => 'In Progress', 'value' => 'in_progress'],
        ['label' => 'Completed', 'value' => 'completed'],
    ]
@endphp


<form action="{{ route('record.inquiries.update') }}" method="POST">
    @csrf
    <input type="hidden" name="id" id="id-update" />
    <x-bladewind::input type="text" name="name" label="Name" id="name-update" />
    <x-bladewind::input type="email" name="email" label="Email" id="email-update" />

    
    @if(!$services->isEmpty())
        <x-bladewind::select label_key="name" value_key="id" :data="$services" label="Service" name="service_update" id="service-update" selected_value=""/>
    @else
        <x-bladewind::input type="text" label="No service available" disabled /> 
    @endif
    
    <x-bladewind::textarea name="message" label="Message" id="message-update" />
    <x-bladewind::select :data="$status_update" name="status_update" label="Status" id="status-update" />
    
    <x-bladewind::button icon="folder-minus" can_submit="true">
        Update Form
    </x-bladewind::button>
</form>