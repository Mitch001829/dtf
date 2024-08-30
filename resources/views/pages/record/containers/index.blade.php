<x-app-layout>
    <!-- Page Header -->
    
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Record: Containers') }}
            </h2>

            <div class="flex">
                <x-bladewind::button
                    icon="table-cells"
                    show_close_icon="true"
                    color="gray"
                    class="mx-1"
                    size="small"
                    onclick="showModal('export-modal')">
                    Export CSV
                </x-bladewind::button>

                <x-bladewind::button
                    icon="plus"
                    show_close_icon="true"
                    class="mx-1"
                    size="small"
                    onclick="showModal('container-modal')">
                    New
                </x-bladewind::button>
            </div>
        </div>
    </x-slot>




    <x-loading-modal />
    <div class="px-10">
        <div class="py-12 flex flex-stretch text-gray-900 dark:text-gray-100">
            @include('pages.record.partials.navigation')
            @include('pages.record.partials.export-form', ['url' => 'record.containers.export'])

            <div class="w-full px-10">
                <div class="bg-gray-100 dark:bg-gray-900">

                    <!--Create Modal Form -->
                    <x-bladewind::modal
                        {{-- size="xl" --}}
                        name="container-modal"
                        ok_button_label=""
                        title="Containers">
                        
                        <div class="h-96 overflow-y-auto scrollbar px-4">
                            @include('pages.record.containers.partials.create')
                        </div>
                    </x-bladewind::mod>

                    <!-- Update Modal Form -->
                    <x-bladewind::modal
                        {{-- size="xl" --}}
                        name="container-update-modal"
                        ok_button_label=""
                        title="Containers Update">
                        <div class="h-96 overflow-y-auto scrollbar px-4">
                            @include('pages.record.containers.partials.update')
                        </div>
                    </x-bladewind::mod>

                    
                    <div>
                        <x-bladewind::table
                            no_data_message="The Data is empty"
                            searchable="false"
                            :data="$containers"
                            divider="thin"
                            compact="true"
                            search_placeholder="Search Data..."
                            :action_icons="$action_icons"
                            exclude_columns="id, created_at, updated_at" 
                            
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
            fetch(`/record/containers/destroy/${on_delete_data}`, {
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
        editData = (id, period_covered, barangay, address, inspection_date, no_of_container, no_of_containers_with_larvae, containers_kind, total_house, total_containers, total_containers_with_larvae) => {
            
            domEl('#id-update').value = id;
            domEl('#period-covered-update').value = period_covered;
            domEl('#barangay-update').value = barangay;
            domEl('#address-update').value = address;
            domEl('#inspection-date-update').value = inspection_date;
            domEl('#no-of-container-update').value = no_of_container;
            domEl('#no-of-containers-with-larvae-update').value = no_of_containers_with_larvae;
            domEl('#containers-kind-update').value = containers_kind;
            domEl('#total-house-update').value = total_house;
            domEl('#total-containers-update').value = total_containers;
            domEl('#total-containers-with-larvae-update').value = total_containers_with_larvae;

            showModal('container-update-modal');
        }
    </script>
</x-app-layout>