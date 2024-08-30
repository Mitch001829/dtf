


 <div>
    <form action="{{ route('record.services.update') }}" method="POST">
        @csrf
        <input type="hidden" name="id" id="id" />
        <input type="hidden" name="service_post_update" id="service-post-update" />



        <x-input-error :messages="$errors->get('name')" />
        <x-bladewind::input type="text" name="name" label="Service Name" id="name-update" selected_value="{{old('name')}}" readonly />

        <x-input-error :messages="$errors->get('description')" />
        <x-bladewind::textarea type="text" name="description" label="Description" id="description-update" selected_value="{{old('description')}}" required="true" />




        <x-input-error :messages="$errors->get('service_post')" />
        <div class="border border-slate-600 overflow-y-auto scrollbar" style="height: 50vh;">
            <div id="editor-update"></div>
         </div>

        <x-bladewind::button icon="folder-minus" can_submit="true">
            Update Form
        </x-bladewind::button>
    </form>
 </div>




<script>
    loadEditor = (data) => {
        console.log(data);
        var update_editor = new EditorJS({
            readOnly: false,
            holder: 'editor-update',

            tools: {
                header: {
                class: Header,
                inlineToolbar: ['marker', 'link'],
                config: {
                    placeholder: 'Header'
                },
                shortcut: 'CMD+SHIFT+H'
                },

                image: {
                    class: ImageTool,
                    config: {
                        endpoints: {
                        byFile: `${"/record/services/image-handler"}`, 
                        byUrl:  `${"/record/services/image-handler"}`,
                        },
                        additionalRequestHeaders: {
                            'X-CSRF-TOKEN' : "{{ csrf_token() }}"//meta.constant
                        },
                    }
                },

                list: {
                    class: List,
                    inlineToolbar: true,
                    shortcut: 'CMD+SHIFT+L'
                },

                checklist: {
                    class: Checklist,
                    inlineToolbar: true,
                },

                quote: {
                    class: Quote,
                    inlineToolbar: true,
                    config: {
                        quotePlaceholder: 'Enter a quote',
                        captionPlaceholder: 'Quote\'s author',
                    },
                    shortcut: 'CMD+SHIFT+O'
                },

                warning: Warning,

                marker: {
                class:  Marker,
                shortcut: 'CMD+SHIFT+M'
                },

                code: {
                class:  CodeTool,
                shortcut: 'CMD+SHIFT+C'
                },

                delimiter: Delimiter,

                inlineCode: {
                class: InlineCode,
                shortcut: 'CMD+SHIFT+C'
                },

                linkTool: LinkTool,

                embed: Embed,

                table: {
                class: Table,
                inlineToolbar: true,
                shortcut: 'CMD+ALT+T'
                },

            },

            data: data,

            onChange: function(api, event) {
                const blog_data_input = document.getElementById("service-post-update");
                
                update_editor.save()
                .then((savedData) => {
                    blog_data_input.value = JSON.stringify(savedData);
                    console.log(savedData)
                }).catch((error) => {
                    console.log("Error: " + error)
                });
            }
            
        });
    }
   
    
</script>