<x-app-layout>
    <!-- Page Header -->
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Record: Record') }}
            </h2>
        </div>
    </x-slot>

    <div class="px-10">
        <div class="py-12 flex flex-stretch text-gray-900 dark:text-gray-100">
            @include('pages.record.partials.navigation')

            <div class="text-center w-full">
                <p class="text-black dark:text-white">You can add summaries here</p>
            </div>
        </div>
    </div>
</x-app-layout>