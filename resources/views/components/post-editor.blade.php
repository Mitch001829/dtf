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


 <div>
    <form action="{{ route('record.services.store') }}" method="POST">
        @csrf
        <input type="hidden" name="service_post" id="service-post-input" />
        <x-bladewind::input type="text" name="name" label="Service Name" id="name-input" />
        <x-bladewind::textarea  type="text" name="description" label="Description" id="description-input" />

        <div class="border border-slate-600 overflow-y-auto scrollbar" style="height: 50vh;">
            <div id="editorjs"></div>
         </div>

        <x-bladewind::button onclick="saveKnowledge()" icon="folder-minus" can_submit="true">
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
                        text: "Add knowledge Header",
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

    const saveKnowledge = ()=>{
        editor.save()
        .then((savedData) => {
            console.log(savedData["blocks"])
        })
        .catch((error) => {
            console.error('Saving error', error);
        });
    }
    
</script>