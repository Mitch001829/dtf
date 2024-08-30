<x-app-layout>
    <!-- Page Header -->
    
    

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Record: Paticipants') }}
            </h2>

            <div class="flex">
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
                    show_close_icon="true"
                    class="mx-1"
                    size="small"
                    onclick="showModal('participant-modal')">
                    New
                </x-bladewind::button>
            </div>
        </div>
    </x-slot>

    <x-loading-modal />
    <div class="px-10">
        <div class="py-12 flex flex-stretch text-gray-900 dark:text-gray-100">
            @include('pages.record.partials.navigation')
            @include('pages.record.partials.export-form', ['url' => 'record.participants.export'])
            
            <div class="w-full px-10">
                <div class=" bg-gray-100 dark:bg-gray-900">
                    

                    <x-bladewind::modal
                        {{-- size="xl" --}}
                        name="participant-modal"
                        ok_button_label=""
                        title="Participants">
                        @include('pages.record.participants.partials.create')
                    </x-bladewind::mod>

                    <x-bladewind::modal
                        {{-- size="xl" --}}
                        name="participant-update-modal"
                        ok_button_label=""
                        title="Participants Update">
                        @include('pages.record.participants.partials.update')
                    </x-bladewind::mod>
                    


                    <div>
                        <x-bladewind::table
                            no_data_message="The Data is empty"
                            searchable="false"
                            :data="$participants"
                            divider="thin"
                            id="participants-table"
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
            fetch(`/record/participants/destroy/${on_delete_data}`, {
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
        editData = (id, name, age, health_center, address, date) => {
            domEl('#name-update').value = name;
            domEl('#age-update').value = age;
            domEl('#address-update').value = address;
            domEl('#health-center-update').value = health_center;
            domEl('#target-date-update').value = date;
            domEl('#id-update').value = id;
            showModal('participant-update-modal');
        }
    </script>
</x-app-layout>