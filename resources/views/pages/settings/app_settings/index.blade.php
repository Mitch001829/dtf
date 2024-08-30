<x-app-layout>
    <!-- Page Header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings: Application Settings') }}
        </h2>
    </x-slot>

    <div class="px-10">
        <div class="py-12 flex flex-stretch text-gray-900 dark:text-gray-100">
            @include('pages.settings.partials.settings-navigation')
            
           
            <div class="w-full px-10">
                <form method="POST" action="{{ route('settings.app-settings.update') }}" enctype="multipart/form-data">
                    @csrf

                    <x-bladewind::card title="App Settings">
                        <x-bladewind::input type="text" name="app_name" label="App Name" id="app-name" value="{{ $all_settings->app_name }}" />

                        <x-bladewind::filepicker
                            name="app_logo_file"
                            placeholder="Upload a logo (max 10mb)"
                            max_file_size="10"
                            accepted_file_types=".png"  />
                    </x-bladewind::card>

                    <x-bladewind::card title="Map Settings">
                        <x-bladewind::input type="number" name="heatmap_intensity" label="Heatmap Intensity" id="heatmap-intensity" value="{{ $all_settings->heatmap_intensity }}" />
                    </x-bladewind::card>

                    <x-bladewind::button icon="folder-minus" can_submit="true">
                        Update Settings
                    </x-bladewind::button>
                </form>
            </div>


        </div>
    </div>
</x-app-layout>