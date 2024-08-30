<x-app-layout>
     <!-- Load Tools -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script><!-- Header -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script><!-- Image -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script><!-- Delimiter -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script><!-- List -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script><!-- Checklist -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script><!-- Quote -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script><!-- Code -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script><!-- Embed -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script><!-- Table -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script><!-- Link -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script><!-- Warning -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@2.9.0/dist/image.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script><!-- Marker -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script><!-- Inline Code -->

    <!-- Load Editor.js's Core -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <link href="https://fonts.googleapis.com/css?family=PT+Mono" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">


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
                    onclick="showModal('service-modal')">
                    New
                </x-bladewind::button>
            </div>
        </div>
    </x-slot>

    <x-loading-modal />
    <div class="px-10">
        <div class="py-12 flex flex-stretch text-gray-900 dark:text-gray-100">
            @include('pages.record.partials.navigation')
            @include('pages.record.partials.export-form', ['url' => 'record.services.export'])
            
            <div class="w-full px-10">
                <div class=" bg-gray-100 dark:bg-gray-900">
                    

                    <x-bladewind::modal
                        size="large"
                        name="service-modal"
                        ok_button_label=""
                        title="Create Service">
                        @include('pages.record.services.partials.create')
                    </x-bladewind::mod>

                    <x-bladewind::modal
                        size="large"
                        name="service-update-modal"
                        ok_button_label=""
                        title="Participants Update">
                        @include('pages.record.services.partials.update')
                    </x-bladewind::mod>
                    

                    <div>
                        <x-bladewind::table
                            no_data_message="The Data is empty"
                            searchable="false"
                            :data="$services"
                            divider="thin"
                            id="service-table"
                            search_placeholder="Search Data..."
                            :action_icons="$action_icons"
                            exclude_columns="id, created_at, updated_at, service_post" 
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
        let on_delete_data = -1;
        deleteData = (id) => {
            showModal('delete-user');
            domEl('.bw-delete-user .title').innerText = `${name}`;
            on_delete_data = id
        }
        

        goDelete = () => {
            showModal('loading');
            fetch(`/record/services/destroy/${on_delete_data}`, {
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

         editData = (id, name, description, service_post) => {
            domEl('#id').value = id;
            domEl('#name-update').value = name;
            domEl('#description-update').value = description;
            loadEditor(JSON.parse(service_post));

            showModal('service-update-modal');
            
        }

        read = (id) => {
            window.location.href = `/record/services/${id}`;
        }
    </script>
    
</x-app-layout>