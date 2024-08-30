<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-4 px-4">
    <x-bladewind::alert color="red" icon="bell-alert">
    Hello User
    </x-bladewind::alert>
    </div>

    <div class="flex py-4 px-4">
        <div class="w-100 px-2">
        <div class="py-2 pr-5">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        
        <x-bladewind::statistic
        number="{{$inq}}"
        label="Total Count of Inquiries"> 
        
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 p-2 text-white rounded-full bg-blue-200" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.475 5.458c-.284 0-.514-.237-.47-.517C4.28 3.24 5.576 2 7.825 2c2.25 0 3.767 1.36 3.767 3.215 0 1.344-.665 2.288-1.79 2.973-1.1.659-1.414 1.118-1.414 2.01v.03a.5.5 0 0 1-.5.5h-.77a.5.5 0 0 1-.5-.495l-.003-.2c-.043-1.221.477-2.001 1.645-2.712 1.03-.632 1.397-1.135 1.397-2.028 0-.979-.758-1.698-1.926-1.698-1.009 0-1.71.529-1.938 1.402-.066.254-.278.461-.54.461h-.777ZM7.496 14c.622 0 1.095-.474 1.095-1.09 0-.618-.473-1.092-1.095-1.092-.606 0-1.087.474-1.087 1.091S6.89 14 7.496 14"/>
                </svg>
            </x-slot>
        
        </x-bladewind::statistic>
        </div>
       </div>
        </div>

        <div class="w-100 px-2">
            <div class="py-2 pr-5">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            
                <x-bladewind::statistic
                number="{{$part}}"
                label="Total Count of Participants"> 
                
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 p-2 text-white rounded-full bg-blue-200" viewBox="0 0 16 16"><path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M6 6.75v8.5a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2.75a.75.75 0 0 0 1.5 0v-2.5a.25.25 0 0 1 .5 0"/>
                        
                    </svg>
                </x-slot>
                
                </x-bladewind::statistic>
            </div>
            </div>
        </div>
        <div class="w-100 px-2">
            <div class="py-2 pr-5">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <x-bladewind::statistic
                number="{{$larv}}"
                label="Total Count of Larvicide">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 p-2 text-white rounded-full bg-blue-200" viewBox="0 0 16 16">
                        <path d="M4.355.522a.5.5 0 0 1 .623.333l.291.956A5 5 0 0 1 8 1c1.007 0 1.946.298 2.731.811l.29-.956a.5.5 0 1 1 .957.29l-.41 1.352A5 5 0 0 1 13 6h.5a.5.5 0 0 0 .5-.5V5a.5.5 0 0 1 1 0v.5A1.5 1.5 0 0 1 13.5 7H13v1h1.5a.5.5 0 0 1 0 1H13v1h.5a1.5 1.5 0 0 1 1.5 1.5v.5a.5.5 0 1 1-1 0v-.5a.5.5 0 0 0-.5-.5H13a5 5 0 0 1-10 0h-.5a.5.5 0 0 0-.5.5v.5a.5.5 0 1 1-1 0v-.5A1.5 1.5 0 0 1 2.5 10H3V9H1.5a.5.5 0 0 1 0-1H3V7h-.5A1.5 1.5 0 0 1 1 5.5V5a.5.5 0 0 1 1 0v.5a.5.5 0 0 0 .5.5H3c0-1.364.547-2.601 1.432-3.503l-.41-1.352a.5.5 0 0 1 .333-.623M4 7v4a4 4 0 0 0 3.5 3.97V7zm4.5 0v7.97A4 4 0 0 0 12 11V7zM12 6a4 4 0 0 0-1.334-2.982A3.98 3.98 0 0 0 8 2a3.98 3.98 0 0 0-2.667 1.018A4 4 0 0 0 4 6z"/>
                    </svg>
                </x-slot>
                </x-bladewind::statistic>
            </div>
            </div>
        </div>
        <div class="w-100 px-2">
            <div class="py-2 pr-5">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <x-bladewind::statistic
                number="{{$cont}}"
                label="Total Count of Container">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 p-2 text-white rounded-full bg-blue-200" viewBox="0 0 16 16">
                        <path d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5m1.005 0a4.5 4.5 0 0 1 8.945 0z"/>
                    </svg>
                </x-slot>
                </x-bladewind::statistic>
            </div>
            </div>
        </div>
        <div class="w-100 px-2">
            <div class="py-2 pr-5">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <x-bladewind::statistic
                number="{{$ovi}}"
                label="Total Count of OVI Trap">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 p-2 text-white rounded-full bg-blue-200" viewBox="0 0 16 16">
                        <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434zM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567zM7.5 9.933l-2.75 1.571v3.134l2.75-1.571zm1 3.134 2.75 1.571v-3.134L8.5 9.933zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567zm2.242-2.433V3.504L8.5 5.076V8.21zM7.5 8.21V5.076L4.75 3.504v3.134zM5.258 2.643 8 4.21l2.742-1.567L8 1.076zM15 9.933l-2.75 1.571v3.134L15 13.067zM3.75 14.638v-3.134L1 9.933v3.134z"/>
                    </svg>
                </x-slot>
                </x-bladewind::statistic>
            </div>
            </div>
        </div>
        <div class="w-100 px-2">
            <div class="py-2 pr-5">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <x-bladewind::statistic
                number="{{$serv}}"
                label="Total Count of Services" >
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 p-2 text-white rounded-full bg-blue-200" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z"/>
                        <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z"/>
                        <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z"/>
                    </svg>
                </x-slot>
                </x-bladewind::statistic>
            </div>
            </div>
        </div>
    </div>
    
    <div class="flex py-4 px-2">
        

        @can('View Inquiries Chart')
            <div class="w-1/2">
                <div class="w-100 px-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <p class="p-6 font-bold text-gray-900 dark:text-gray-100">
                            {{ __("Inquiries") }}
                        </p>
                        <div class="p-6 m-20 bg-white rounded shadow">
                            {!! $inquiriesChart->container() !!}
                      
                        </div>
                        
                    </div>
                </div>
            </div>
        @endcan()

        @can('View Participants Chart')
            <div class="w-1/2">
                <div class="w-100 px-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <p class="p-6 font-bold text-gray-900 dark:text-gray-100">
                            {{ __("Participant") }}
                        </p>
                        <div class="p-6 m-20 bg-white rounded shadow">
                            {!! $participantChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        @endcan()
    </div>
    

    <div class="flex py-4 px-2">
        @can('View Larvicides Chart')
            <div class="w-1/2">
                <div class="w-100 px-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <p class="p-6 font-bold text-gray-900 dark:text-gray-100">
                            {{ __("Larvicide") }}
                        </p>

                        <div class="p-6 m-20 bg-white rounded shadow">
                            {!! $larvicideChart->container() !!}
                        </div>
                        
                    </div>
                </div>
            </div>
        @endcan()

        @can('View Containers Chart')
            <div class="w-1/2">
                <div class="w-100 px-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <p class="p-6 font-bold text-gray-900 dark:text-gray-100">
                            {{ __("Container") }}
                        </p>

                        <div class="p-6 m-20 bg-white rounded shadow">
                            {!! $containerChart->container() !!}
                        </div>
                        
                    </div>
                </div>
            </div>
        @endcan()
    </div>



    <div class="flex py-4 px-2">
        @can('View OVI Traps Chart')
            <div class="w-1/2">
                <div class="w-100 px-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <p class="p-6 font-bold text-gray-900 dark:text-gray-100">
                            {{ __("OVI Trap") }}
                        </p>

                        <div class="p-6 m-20 bg-white rounded shadow">
                            {!! $ovitrapChart->container() !!}
                        </div>
                        
                    </div>
                </div>
            </div>
        @endcan()

        @can('View Services Chart')
            <div class="w-1/2">
                <div class="w-100 px-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <p class="p-6 font-bold text-gray-900 dark:text-gray-100">
                            {{ __("Services") }}
                        </p>

                        <div class="p-6 m-20 bg-white rounded shadow">
                            {!! $servicesChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        @endcan()
    </div>



    <script src="{{ $inquiriesChart->cdn() }}"></script>
    {{ $inquiriesChart->script() }}

    <script src="{{ $participantChart->cdn() }}"></script>
    {{ $participantChart->script() }}

    <script src="{{ $larvicideChart->cdn() }}"></script>
    {{ $larvicideChart->script() }}

    <script src="{{ $containerChart->cdn() }}"></script>
    {{ $containerChart->script() }}

    <script src="{{ $ovitrapChart->cdn() }}"></script>
    {{ $ovitrapChart->script() }}

    <script src="{{ $servicesChart->cdn() }}"></script>
    {{ $servicesChart->script() }}

    
</x-app-layout>



