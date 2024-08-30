<x-app-layout>
    <!-- Page Header -->
    
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Settings: Roles and Permission') }}
            </h2>

            
        </div>
    </x-slot>

    <div class="px-10">
        <div class="py-12 flex flex-stretch text-gray-900 dark:text-gray-100">
            @include('pages.settings.partials.settings-navigation')
            
            <div class="w-full px-10">
                @include('pages.settings.roles_and_permissions.partials.role-manager')
                @include('pages.settings.roles_and_permissions.partials.permission-manager')
            </div>
        </div>
    </div>

    <script>
        $("#service-input").change(function(){
            alert("selection called");
        })

        function test(){
            alert("called");
        }
    </script>
</x-app-layout>