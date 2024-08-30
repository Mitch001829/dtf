
@php
    $services = [
        ['label' => 'Thermal Fogging', 'value' => 'Thermal Fogging'],
        ['label' => 'Misting', 'value' => 'Misting'],
        ['label' => 'Misting', 'value' => 'Misting'],
        ['label' => 'OVI Trapping', 'value' => 'OVI'],
        ['label' => 'Larviciding', 'value' => 'Larviciding'],
        ['label' => 'Cold Fogging', 'value' => 'Cold Fogging']
    ];
@endphp

 <div>
    <form action="{{ route('record.services.store') }}" method="POST">
        @csrf
        <input type="hidden" name="service_post" id="service-post-input" />

        <x-input-error :messages="$errors->get('name')" />
        <x-bladewind::select  name="name" label="Service Name" id="name-input" :data="$services" selected_value="{{old('name')}}" required="true" />   
        <x-input-error :messages="$errors->get('description')" />
        <x-bladewind::textarea type="text" name="description" label="Description" id="description-input" selected_value="{{old('description')}}" required="true" />
        <x-input-error :messages="$errors->get('service_post')" />
        <div class="border border-slate-600 overflow-y-auto scrollbar" style="height: 50vh;">
            <div id="editorjs"></div>
         </div>

        <x-bladewind::button icon="folder-minus" can_submit="true">
            Submit Form
        </x-bladewind::button>
    </form>
 </div>




<script>
    let image_upload_url = "/record/services/image-handler";
    var editor = new EditorJS({
        readOnly: false,
        holder: 'editorjs',

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
                    byFile: `${image_upload_url}`, 
                    byUrl:  `${image_upload_url}`,
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

        data: {
            blocks: [
                {
                    type: "header",
                    data: {
                        text: "Change content to save data",
                        level: 2
                    }
                },
                {
                    type : 'paragraph',
                    data : {
                        text : 'Hover or click the modal to make the Plus button(+) appear. Click the plus button to add element'
                    }
                },
            ]
        },

        onChange: function(api, event) {
            const blog_data_input = document.getElementById("service-post-input");
            
            editor.save()
            .then((savedData) => {
                blog_data_input.value = JSON.stringify(savedData);
                console.log(savedData)
            }).catch((error) => {
                console.log("Error: " + error)
            });
        }
        
    });


    
</script>