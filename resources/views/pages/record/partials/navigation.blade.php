<div id="menu" class="min-w-48 w-48 px-5 flex flex-initial  flex-col background-gray-500 border-r border-gray-300 dark:border-gray-600">
    {{-- @can("View Inquiry")
        <x-nav-link :href="route('record.inquiries.index')" :active="request()->routeIs('record.inquiries.index*')" class="my-1 py-2">
            {{ __('Inquiries') }}
        </x-nav-link>
    @endcan --}}
    
    @can("View Participant")
        <x-nav-link :href="route('record.participants.index')" :active="request()->routeIs('record.participants.index')" class="my-1 py-2">
            {{ __('Participant') }}
        </x-nav-link>
    @endcan
    
    @can("View Larvicide")
        <x-nav-link :href="route('record.larvicide.index')" :active="request()->routeIs('record.larvicide.index*')" class="my-1 py-2">
            {{ __('Larvicide') }}
        </x-nav-link>
    @endcan

    @can("View Container")
        <x-nav-link :href="route('record.containers.index')" :active="request()->routeIs('record.containers.index*')" class="my-1 py-2">
            {{ __('Container') }}
        </x-nav-link>
    @endcan

    @can("View OVI Trap")
        <x-nav-link :href="route('record.ovitrap.index')" :active="request()->routeIs('record.ovitrap.index*')" class="my-1 py-2">
            {{ __('OVI Trap') }}
        </x-nav-link>
    @endcan

    @can("View Service")
        <x-nav-link :href="route('record.services.index')" :active="request()->routeIs('record.services.index*')" class="my-1 py-2">
            {{ __('Services') }}
        </x-nav-link>
    @endcan
</div>