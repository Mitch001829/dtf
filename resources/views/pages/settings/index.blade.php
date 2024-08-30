<x-app-layout>
    <!-- Page Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="px-10">
        <div class="py-12 flex flex-stretch text-gray-900 dark:text-gray-100">
            @include('pages.settings.partials.settings-navigation')
            
            <div class="w-75 background-gray-500 px-5">
                <p>Select Settings (Important settings can be added here)</p>
            </div>
        </div>
    </div>
</x-app-layout>