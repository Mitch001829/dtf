<x-app-layout>
    <!-- Page Header -->
    
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Record: OVI Trap') }}
            </h2>

            <div class="flex justify-end">
                <x-bladewind::button
                    icon="table-cells"
                    show_close_icon="true"
                    class="mx-1"
                    color="gray"
                    size="small"
                    onclick="showModal('export-modal')">
                    Export CSV
                </x-bladewind::button>

                <x-bladewind::button
                    icon="plus"
                    class="mx-1"
                    size="small"
                    show_close_icon="true"
                    onclick="showModal('ovitrap-modal')">
                    New
                </x-bladewind::button>
            </div>

        </div>
    </x-slot>

    

    <x-loading-modal />
    <div class="px-10">
        <div class="py-12 flex flex-stretch text-gray-900 dark:text-gray-100">
            @include('pages.record.partials.navigation')
            @include('pages.record.partials.export-form', ['url' => 'record.ovitrap.export'])

            <div class="w-full px-10">
                <div class=" bg-gray-100 dark:bg-gray-900">
                    

                    <x-bladewind::modal
                        {{-- size="xl" --}}
                        name="ovitrap-modal"
                        ok_button_label="">
                        @include('pages.record.ovitrap.partials.create')
                    </x-bladewind::mod>

                    <x-bladewind::modal
                        {{-- size="xl" --}}
                        name="ovitrap-update-modal"
                        ok_button_label="">
                        @include('pages.record.ovitrap.partials.update')
                    </x-bladewind::mod>
                    


                    <div>

                        <x-bladewind::table
                            compact="true"
                            no_data_message="The Data is empty"
                            searchable="false"
                            :data="$ovitraps"
                            divider="thin"
                            search_placeholder="Search Data..."
                            :action_icons="$action_icons"
                            exclude_columns="id, created_at, updated_at, latitude, longitude" 
                        />


                        <x-bladewind::modal
                            name="delete-user"
                            type="error" 
                            title="Confirm User Deletion"
                            ok_button_action="goDelete()"
                        >
                            Are you really sure you want to delete <b class="title"></b>?
                            This action cannot be reversed.
                        </x-bladewind::modal>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    
    
    <script>
        // Delete Call
        let on_delete_data = -1;
        deleteData = (id) => {
            showModal('delete-user');
            domEl('.bw-delete-user .title').innerText = `${name}`;
            on_delete_data = id
        }
        

        goDelete = () => {
            showModal('loading');
            fetch(`/record/ovitrap/destroy/${on_delete_data}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then(response => {
                location.reload();
            })
            .catch(error => {
                console.error('Network error:', error);
            });
        }


        // Edit Call
        editData = (id, health_center, date_installed, date_harvested, area_type, address, trap_indoor, trap_outdoor) => {
            domEl('#health-center-update').value = health_center;
            domEl('#date-installed-update').value = date_installed;
            domEl('#date-harvested-update').value = date_harvested;
            domEl('#area-type-update').value = area_type;
            domEl('#address-update').value = address;
            
            domEl('#data-id').value = id;
           
            const bw_trap_indoor_update = new BladewindSelect('trap_indoor_update', '');
            const bw_trap_outdoor_update = new BladewindSelect('trap_outdoor_update', '');

            bw_trap_indoor_update.selectByValue(`${trap_indoor}`);
            bw_trap_outdoor_update.selectByValue(`${trap_outdoor}`);

            showModal('ovitrap-update-modal');
        }


        const openLocation = (latitude, longitude) => {
            // you can use google maps instead
            //window.open(`https://www.google.com/maps/search/?api=1&query=${latitude},${longitude}`, '_blank');

            const baseUrl = `{{ url('map/index') }}`;
            const formattedUrl = `${baseUrl}?latitude=${latitude}&longitude=${longitude}`;
            window.location.href = formattedUrl;
        }
 
    </script>
</x-app-layout>

