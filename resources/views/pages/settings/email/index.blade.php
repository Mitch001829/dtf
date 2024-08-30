<x-app-layout>
    <!-- Page Header -->
    
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Settings: Email') }}
            </h2>
        </div>
    </x-slot>

    <div class="px-10">
        <div class="py-12 flex flex-stretch text-gray-900 dark:text-gray-100">
            @include('pages.settings.partials.settings-navigation')

            <div class="w-full px-10">
                <form action="{{ route('settings.email-settings.test') }}" method="POST">
                    @csrf
                    <x-input-error :messages="$errors->get('email')" />
                    <x-bladewind::input type="email" name="email" required="true" label="Email" id="email-input" selected_value="{{old('email')}}" />

                    <x-bladewind::button icon="folder-minus" can_submit="true">
                        Send Email
                    </x-bladewind::button>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>