<x-app-layout>
    <!-- Page Header -->
    
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Record: Inquiries') }}
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
                    size="tiny"
                    onclick="showModal('inquiries-modal')">
                    New
                </x-bladewind::button>
            </div>
        </div>
    </x-slot>



    <x-loading-modal />
    <div class="px-10">
        <div class="py-12 flex flex-stretch text-gray-900 dark:text-gray-100">
            @include('pages.record.partials.navigation')
            @include('pages.record.partials.export-form', ['url' => 'record.inquiries.export'])

            <div class="w-full px-10">
                <div class="bg-gray-100 dark:bg-gray-900">
                    
                    <!--Create Modal Form -->
                    <x-bladewind::modal
                        size="medium"
                        name="inquiries-modal"
                        title="Create New Inquiry for residents"
                        ok_button_label=""> 
                        <div class="scrollbar max-h-96 overflow-y-auto px-5">
                            @include('pages.record.inquiries.partials.create')
                        </div>
                    </x-bladewind::modal>

                    <!-- Update Modal Form -->
                    <x-bladewind::modal
                        size="medium"
                        name="inquiries-update-modal"
                        title="Update Inquiry for residents"
                        ok_button_label="">
                        <div class="scrollbar max-h-96 overflow-y-auto px-5">
                            @include('pages.record.inquiries.partials.update')
                        </div>
                    </x-bladewind::modal>
                   

                    <div>
                        <x-bladewind::table
                            no_data_message="The Data is empty"
                            searchable="false"
                            :data="$inquiries"
                            divider="thin"
                            search_placeholder="Search Data..."
                            :action_icons="$action_icons"
                            exclude_columns="id, created_at, updated_at, get_service, service_id" 
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
            fetch(`/record/inquiries/destroy/${on_delete_data}`, {
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
        editData = (id, name, email, service, service_id, message, status) => {
            domEl('#id-update').value = id;
            domEl('#name-update').value = name;
            domEl('#email-update').value = email;
            //domEl('#service-update').value = service;
            domEl('#message-update').value = message;
            domEl('#status-update').value = status;

            
            const bw_service_update = new BladewindSelect('service_update', '');
            const bw_status_update = new BladewindSelect('status_update', '');

            bw_service_update.selectByValue(`${service_id}`);
            bw_status_update.selectByValue(`${status}`);

            showModal('inquiries-update-modal');
        }
    </script>
</x-app-layout>