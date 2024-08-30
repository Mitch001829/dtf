<x-app-layout>
    <!-- Page Header -->
    
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Record: Larvicide') }}
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
                    onclick="showModal('larvicide-modal')">
                    New
                </x-bladewind::button>
            </div>
        </div>
    </x-slot>



    <x-loading-modal />
    <div class="px-10">
        <div class="py-12 flex flex-stretch text-gray-900 dark:text-gray-100">
            @include('pages.record.partials.navigation')
            @include('pages.record.partials.export-form', ['url' => 'record.larvicide.export'])

            <div class="w-full px-10">
                <div class="bg-gray-100 dark:bg-gray-900">
                    
                    <!--Create Modal Form -->
                    <x-bladewind::modal
                        {{-- size="xl" --}}
                        name="larvicide-modal"
                        ok_button_label="">
                        @include('pages.record.larvicide.partials.create')
                    </x-bladewind::mod>

                    <!-- Update Modal Form -->
                    <x-bladewind::modal
                        {{-- size="xl" --}}
                        name="larvicide-update-modal"
                        ok_button_label="">
                        @include('pages.record.larvicide.partials.update')
                    </x-bladewind::mod>
                   

                    <div>
                        <x-bladewind::table
                            no_data_message="The Data is empty"
                            searchable="false"
                            :data="$larvicides"
                            divider="thin"
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
            fetch(`/record/larvicide/destroy/${on_delete_data}`, {
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
        editData = (id, date, health_center, name, area_conducted, aide_name, contact_number) => {
            domEl('#health-center-update').value = health_center;
            domEl('#name-update').value = name;
            domEl('#area-conducted-update').value = area_conducted;
            domEl('#aide-name-update').value = aide_name;
            domEl('#contact-number-update').value = contact_number;
            domEl('#data-id').value = id;

            showModal('larvicide-update-modal');
        }
    </script>
</x-app-layout>