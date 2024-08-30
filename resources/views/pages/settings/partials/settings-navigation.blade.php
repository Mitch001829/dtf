<div id="menu" class="w-25 px-5 flex flex-initial w-64 flex-col background-gray-500 border-r border-gray-300 dark:border-gray-600">
    @can("View Roles & Permission")
        <x-nav-link :href="route('settings.roles-and-permissions.index')" :active="request()->routeIs('settings.roles-and-permissions*')" class="py-2">
            {{ __('Roles Permissions') }}
        </x-nav-link>
    @endcan    

    @can("View App Settings")
        <x-nav-link :href="route('settings.app-settings.index')" :active="request()->routeIs('settings.app-settings.index*')" class="py-2">
            {{ __('App Settings') }}
        </x-nav-link>
    @endcan

    {{-- @can("View App Settings")
        <x-nav-link :href="route('settings.email-settings.index')" :active="request()->routeIs('settings.email-settings.index*')" class="py-2">
            {{ __('Email Settings') }}
        </x-nav-link>
    @endcan --}}
</div>